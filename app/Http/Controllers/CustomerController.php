<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Filing;
use App\House;
use App\DetailHouse;
use App\Akunting;
use Storage;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->Customer = new Customer;
        $this->path = 'customer';
    }

    public function index(){
        $this->authorize('pelanggan');
        $confirmed = Customer::where('file_status', 1)->count();
        $not_yet_confirmed = Customer::where('file_status', 0)->count();
        $customers = Customer::all();
        return view('pages.'.$this->path.'.index', compact('customers','confirmed', 'not_yet_confirmed'));
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
          'customer_id' => $customer->id
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
        $houses = House::where('status', 0)->get();
        $detail_house = DetailHouse::where('customer_id', $id)->get();
        return view('pages.filing.choose', compact('customer','houses','detail_house'));
    }

    public function store_house(Request $request){
        $this->authorize('pelanggan');
        DetailHouse::create([
            'customer_id' => $request->customer_id,
            'house_id' => $request->house_id
        ]);
        $house = House::where('id', $request->house_id)->firstOrFail();
        
        if($request->status_process == 'Cash'){
            $house->update([
                'status' => 1,
                'status_process' => 'Cash'
            ]);
        }else{
            $house->update([
                'status' => 1,
                'status_process' => 'Proses'
            ]);
        }

        return redirect()->route('customer.index')->with('success', 'Rumah berhasil dipilih!');
    }


    public function payUtj(Request $request){
        $this->authorize('pelanggan');
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
                'utj_status' => 1,
                'dp_status' => 1,
            ]);

            $utj = Akunting::create([
                'name' => 'UTJ atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran UTJ dan DP atas nama ' . $customer->name,
                'category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }else{
            $customer->update([
                'utj_status' => 1,
            ]);

            $utj = Akunting::create([
                'name' => 'UTJ atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran UTJ atas nama ' . $customer->name,
                'category_id' => 1,
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

        $customer = Customer::where('id', $request->id_customer)->first();
        
        $statusDP = Akunting::select(
            \DB::raw('sum(price) as price')
        )->where('id_customer', $request->id_customer)->first();
        
        $price = (int)str_replace(".","",$request->input('total_dp'));
        
        $canFilling = $statusDP->price + $price;
        
        if((int)$canFilling >= 7500000){
            $customer->update([
                'utj_status' => 1,
                'dp_status' => 1
            ]);

            $dp = Akunting::create([
                'name' => 'DP atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pelunasan DP atas nama ' . $customer->name,
                'category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }else{
            $customer->update([
                'utj_status' => 1,
            ]);

            $dp = Akunting::create([
                'name' => 'DP atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayaran DP atas nama ' . $customer->name,
                'category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }

        

        return redirect()->route('pemberkasan.index')->with('success', 'Pembayaran DP telah berhasil');
    }

    public function sp3(){
        $customers = Customer::with('detail_house')->where('file_status',1)->where('utj_status',1)
        ->where('dp_status',1)->where('lpa_status',0)->get();
    
        return view('pages.bank.sp3', compact('customers'));
    }

    public function updateSP3(Request $request){
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();
        if ($request->sp3 == 1) {
            if($detail_house != null){
                $customer->update([
                    'sp3_status' => 1
                ]);

                $detail_house->house->update([
                    'status_process' => 'SP3'
                ]);
                return redirect()->route('sp3')->with('success', 'Sp3 telah berhasil');
            }else{
                return redirect()->route('sp3')->with('warning', 'Pelanggan ini belum memilih rumah');
            }
            
        } else {
            $customer->update([
                'sp3_status' => 0
            ]);
            return redirect()->route('sp3')->with('success', 'Pembatalan Sp3 telah berhasil');
        }    
    }


    public function payLPA(Request $request){
        $rule = [
            'total_lpa' => 'required'
        ];
        
        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $this->validate($request, $rule, $message);
        
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();

        $price = (int)str_replace(".","",$request->input('total_lpa'));

        $customer->update([
            'lpa_status' => 1,
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
            'id_customer' => $request->id_customer
        ]);

        return redirect()->route('pemberkasan.index')->with('success', 'Pembayaran LPA telah berhasil');
        
    }

    public function akad(){
        $customers = Customer::with('detail_house')->where('sp3_status',1)->where('lpa_status',1)->get();
    
        return view('pages.bank.akad', compact('customers'));
    }

    public function updateAkad(Request $request){
        $customer = Customer::where('id', $request->id_customer)->first();
        $detail_house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();
        if ($request->akad == 1) {
            $customer->update([
                'akad_status' => 1
            ]);

            $detail_house->house->update([
                'status_process' => 'Akad'
            ]);
            return redirect()->route('akad')->with('success', 'Akad telah berhasil');
        } else {
            $customer->update([
                'akad_status' => 0
            ]);
            return redirect()->route('akad')->with('success', 'Pembatalan Akad telah berhasil');
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

        $this->validate($request, $rule, $message);

        $customer = Customer::where('id', $request->id_customer)->first();
        $house = DetailHouse::with('house')->where('customer_id', $request->id_customer)->first();
        
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
            'status' => 1,
            'description' => 'Refund uang karena gagal atas nama ' . $customer->name,
            'category_id' => 1,
            'id_customer' => $request->id_customer
        ]);

        $customer->update([
            'file_status' => 0,
            'utj_status' => 0,
            'dp_status' => 0,
            'sp3_status' => 0,
            'lpa_status' => 0,
        ]);

        $house->house->update([
            'status' => 0,
            'status_process' => 'Kosong'
        ]);

        return redirect()->route('customer.index')->with('success', 'Penggagalan customer telah berhasil');
    }
}