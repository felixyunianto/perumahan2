<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Filing;
use App\House;
use App\DetailHouse;
use App\Akunting;
use App\Block;
use App\MoneySetting;
use Storage;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Customer = new Customer;
        $this->path = 'customer';
    }

    public function index(Request $request){
        $this->authorize('pelanggan');
        $blocks = Block::all();
        $selected = $request->block_id;

        $confirmed = Customer::where('file_status', 1)->where('transaction', 'Proses')->count();
        $not_yet_confirmed = Customer::where('file_status', 0)->count();
        $cash = Customer::where('transaction', 'Cash')->count();
        $process = Customer::where('transaction', 'Proses')->count();
        $customers = Customer::with('detail_house.house.block')->get();
        $akad = House::where('status_process', 'Akad')->get();
        $utj = House::where('status_process', 'Proses')->get();
        $sp3 = House::where('status_process', 'SP3')->get();
        $lpa = House::where('status_process', 'ACC')->get();
        // dd($customers);

        if($request->block_id){
            $customers = Customer::WhereHas('detail_house', function($query) use($request){
            return $query->whereHas('house.block', function($block)use($request){
                return $block->where('id', $request->block_id);
            });
        })->get();
        }

        
        // dd($grouping_customer);
        return view('pages.'.$this->path.'.index', compact('customers','confirmed', 'not_yet_confirmed','cash','process','akad','sp3','utj','lpa','blocks','selected'));
    }
    
    public function create()
    {
        $this->authorize('pelanggan');

        return view('pages.'.$this->path.'.create');

    }

    public function store(Request $request){
        $this->authorize('pelanggan');
        $rule = [
            'name' => 'required|min:3',
            'nik' => 'required|numeric|min:15',
            'address' => 'required|min:3',
            'email' => 'required|email',
            'no_hp' => 'required|numeric|min:10',
            'job_status' => 'required'
        ];

        $message = [
            'email' => 'Masukan email dengan benar.',
            'required' => 'Bidang ini harus diisi.',
            'alpha' => 'Bidang ini harus diisi hanya dengan huruf.',
            'numeric' => 'Bidang ini harus diisi hanya dengan angka.'
        ];

        $this->validate($request, $rule, $message);

        $customer = Customer::create([
            'name' => $request->name,
            'NIK' => $request->nik,
            'address' => $request->address,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'job_status' => $request->job_status,
            'user_id' => $request->user_id
        ]);

        $filing = Filing::create([
          'customer_id' => $customer->id,
        ]);
        return redirect()->route('customer.index')->with('success', 'Data berhasil ditambahkan!');;
    }

    public function edit($customer)
    {
        $this->authorize('pelanggan');

        $customers = Customer::find($customer);

        return view('pages.'.$this->path.'.edit', compact('customers'));
    }

    public function update(Request $request, $customer)
    {
        $this->authorize('pelanggan');
        $customers = Customer::findOrFail($customer);

        $rule = [
            'name' => 'required|min:3',
            'nik' => 'required|numeric|min:15',
            'address' => 'required|min:3',
            'email' => 'required|email',
            'no_hp' => 'required|numeric|min:10',
            'job_status' => 'required'
        ];

        $message = [
            'email' => 'Masukan email dengan benar.',
            'required' => 'Bidang ini harus diisi.',
            'numeric' => 'Bidang ini harus diisi hanya dengan angka.'
        ];

        $this->validate($request, $rule, $message);
        $customers->update([
            'name' => $request->name,
            'NIK' => $request->nik,
            'address' => $request->address,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'job_status' => $request->job_status
        ]);

        return redirect()->route('customer.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($customer)
    {
        $this->authorize('pelanggan');

        $customer = Customer::findOrFail($customer);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Data berhasil dihapus!');
    }

    public function choose($id){
        $this->authorize('pelanggan');
        $customer = Customer::find($id);
        // $houses = House::where('status', 0)->get();
        $houses = Block::with(['house' => function ($query){
            $query->where('status',0)->get();
        }])->get();
        
        $detail_house = DetailHouse::where('customer_id', $id)->get();
        return view('pages.filing.choose', compact('customer','houses','detail_house'));
    }

    public function store_house(Request $request){
        $this->authorize('pelanggan');

        $rule = [
            'house_id' => 'required',
            'customer_id' => 'required',
            'status_process' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);

        DetailHouse::create([
            'customer_id' => $request->customer_id,
            'house_id' => $request->house_id
        ]);
        $house = House::where('id', $request->house_id)->firstOrFail();
        
        if($request->status_process == 'Cash'){
            $house->update([
                'status' => 1,
                'status_process' => 'Cash',
            ]);

            $customer = Customer::where('id', $request->customer_id)->first();
            $customer->update([
                'file_status' => 1,
                'dp_status' => date('Y-m-d'),
                'sp3_status' => date('Y-m-d'),
                'lpa_status' => date('Y-m-d'),
                'transaction' => 'Cash'
            ]);

        }else{
            $house->update([
                'status' => 1,
                'status_process' => 'Proses'
            ]);

            $customer = Customer::where('id', $request->customer_id)->first();
            $customer->update([
                'transaction' => 'Proses'
            ]);
        }

        return redirect()->route('customer.index')->with('success', 'Rumah berhasil dipilih!');
    }


    public function payUtj(Request $request){
        $this->authorize('pelanggan');

        $current_date = date('Y-m-d');

        $rule = [
            'total-utj' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);

        $customer = Customer::where('id', $request->id_customer)->first();

        $price = (int)str_replace(".","",$request->input('total-utj'));
        if($price >= 7500000){
            $customer->update([
                'utj_status' => $current_date,
                'dp_status' => $current_date,
            ]);

            $utj = Akunting::create([
                'name' => 'UTJ atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran UTJ dan DP atas nama ' . $customer->name,
                'category_id' => 1,
                'sub_category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }else{
            $customer->update([
                'utj_status' => $current_date,
            ]);

            $utj = Akunting::create([
                'name' => 'UTJ atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran UTJ atas nama ' . $customer->name,
                'category_id' => 1,
                'sub_category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }

        

        return redirect()->route('customer.index')->with('success', 'Pembayaran UTJ telah berhasil');
    }

    public function payDP(Request $request){
        $this->authorize('pelanggan');
        $rule = [
            'total_dp' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);

        $priceDP = MoneySetting::where('name','DP')->first();

        $customer = Customer::where('id', $request->id_customer)->first();
        
        $statusDP = Akunting::select(
            \DB::raw('sum(price) as price')
        )->where('id_customer', $request->id_customer)->first();
        
        $price = (int)str_replace(".","",$request->input('total_dp'));
        
        $canFilling = $statusDP->price + $price;
        
        if((int)$canFilling >= $priceDP->price){
            $customer->update([
                'utj_status' => date('Y-m-d'),
                'dp_status' => date('Y-m-d'),
            ]);

            $dp = Akunting::create([
                'name' => 'DP atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pelunasan DP atas nama ' . $customer->name,
                'category_id' => 1,
                'sub_category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }else{
            $customer->update([
                'utj_status' => date('Y-m-d'),
            ]);

            $dp = Akunting::create([
                'name' => 'DP atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran DP atas nama ' . $customer->name,
                'category_id' => 1,
                'sub_category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }

        

        return redirect()->route('customer.index')->with('success', 'Pembayaran DP telah berhasil');
    }

    public function chooseBank(Request $request){
        $this->authorize('pelanggan');
        $rule = [
            'bank' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);

        $customer = Customer::where('id', $request->id_customer)->first();
        $customer->update([
            'bank' => $request->bank
        ]);
        return redirect()->route('customer.index')->with('success', 'Pemilihan Bank telah berhasil');
    }


    public function updateSP3(Request $request){
        $this->authorize('pelanggan');
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();
        $sp3 = (int)$request->sp3;
        
        if ($sp3 !== 0) {
            if($detail_house != null){
                $customer->update([
                    'sp3_status' => date('Y-m-d')
                ]);

                $detail_house->house->update([
                    'status_process' => 'SP3'
                ]);
                return redirect()->route('customer.index')->with('success', 'Sp3 telah berhasil');
            }else{
                return redirect()->route('customer.index')->with('warning', 'Pelanggan ini belum memilih rumah');
            }
            
        } else {
            $customer->update([
                'sp3_status' => NULL
            ]);

            $detail_house->house->update([
                'status_process' => 'Proses'
            ]);

            return redirect()->route('sp3')->with('success', 'Pembatalan Sp3 telah berhasil');
        }    
    }


    public function payLPA(Request $request){
        $this->authorize('pelanggan');
        $rule = [
            'total_lpa' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);
        
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();

        $priceLPA = MoneySetting::where('name','LPA')->first();

        $price = (int)str_replace(".","",$request->input('total_lpa'));

        if($price >= $priceLPA->price){
            $customer->update([
                'lpa_status' => date('Y-m-d'),
            ]);
    
            $detail_house->house->update([
                'status_process' => 'ACC'
            ]);
    
            $lpa = Akunting::create([
                'name' => 'LPA atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran LPA atas nama ' . $customer->name,
                'category_id' => 1,
                'sub_category_id' => 1,
                'id_customer' => $request->id_customer
            ]);

            return redirect()->route('customer.index')->with('success', 'Pembayaran LPA telah berhasil');
        }else{
            return redirect()->route('customer.index')->with('warning', 'Minimal pembayaran Rp. '. number_format($priceLPA->price,0,"","."));
        }
    }

    
    public function updateAkad(Request $request){
        $this->authorize('pelanggan');
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();
        $akad = (int)$request->akad;
        if ($akad !== 0) {
            $customer->update([
                'akad_status' => $request->date
            ]);

            if($customer->transaction == 'Cash'){
                $detail_house->house->update([
                    'status_process' => 'Cash'
                ]);
            }else{
                $detail_house->house->update([
                    'status_process' => 'Akad'
                ]);
            }

            

            return redirect()->route('customer.index')->with('success', 'Akad telah berhasil');
        } else {
            $customer->update([
                'akad_status' => NULL
            ]);

            if($customer->transaction == 'Cash'){
                $detail_house->house->update([
                    'status_process' => 'Cash'
                ]);
            }else{
                $detail_house->house->update([
                    'status_process' => 'ACC'
                ]);
            }

            

            return redirect()->route('customer.index')->with('success', 'Pembatalan Akad telah berhasil');
        }    
    }

    public function failProcess(Request $request){
        $this->authorize('pelanggan');
        $rule = [
            'total-fail' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        // $this->validate($request, $rule, $message);

        $customer = Customer::where('id', $request->id_customer)->first();
        $house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->where('house_id', $request->id_house)->first();
        
        
        $price = (int)str_replace(".","",$request->input('total-fail'));

        $filing = Filing::where('customer_id', $request->id_customer)->first();
        
        $photos = $filing->photos;

        if(Storage::exists($photos)){
            Storage::delete($photos);
        }

        $fc_id_card = $filing->fc_id_card;
        
        if(Storage::exists($fc_id_card)){
            Storage::delete($fc_id_card);
        }

        $fc_family_card = $filing->fc_family_card;

        if(Storage::exists($fc_family_card)){
            Storage::delete($fc_family_card);
        }

        $fc_marriage_certificate = $filing->fc_marriage_certificate;

        if(Storage::exists($fc_marriage_certificate)){
            Storage::delete($fc_marriage_certificate);
        }

        $fc_taxpayer_identification = $filing->fc_taxpayer_identification;

        if(Storage::exists($fc_taxpayer_identification)){
            Storage::delete($fc_taxpayer_identification);
        }

        $tax_status = $filing->tax_status;

        if(Storage::exists($tax_status)){
            Storage::delete($tax_status);
        }
        
        $income = $filing->income;

        if(Storage::exists($income)){
            Storage::delete($income);
        }

        $current_account = $filing->current_account;

        if(Storage::exists($current_account)){
            Storage::delete($current_account);
        }
        
        $ls_havent_house = $filing->ls_havent_house;

        if(Storage::exists($ls_havent_house)){
            Storage::delete($ls_havent_house);
        }

        $filing->update([
            'photos' => NULL,
            'fc_id_card' => NULL,
            'fc_family_card' => NULL,
            'fc_marriage_certificate' => NULL,
            'fc_taxpayer_identification' => NULL,
            'tax_status' => NULL,
            'income' => NULL,
            'current_account' => NULL,
            'saving' => NULL,
            'ls_havent_house' => NULL,
        ]);

        $utj = Akunting::create([
            'name' => 'Refund uang atas nama '. $customer->name,
            'price' => $price,
            'date' => date('Y-m-d'),
            'status' => 0,
            'description' => 'Refund uang karena gagal atas nama ' . $customer->name,
            'category_id' => 3,
            'sub_category_id' => 12,
            'id_customer' => $request->id_customer
        ]);

        $customer->update([
            'file_status' => 0,
            'utj_status' => NULL,
            'dp_status' => NULL,
            'sp3_status' => NULL,
            'lpa_status' => NULL,
        ]);

        if($house !== NULL){
            $house->house->update([
                'status' => 0,
                'status_process' => 'Kosong'
            ]);
            DetailHouse::where('customer_id', $request->id_customer)->where('house_id', $request->id_house)->delete();
        }
        return redirect()->route('customer.index')->with('success', 'Penggagalan customer telah berhasil');
    }
}