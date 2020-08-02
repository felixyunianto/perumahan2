<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Filing;
use App\House;
use App\DetailHouse;
use App\Akunting;

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

        return redirect()->route('pemberkasan.index')->with('success', 'Rumah berhasil dipilih!');
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
                'status_dp' => 1,
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
                'status_dp' => 1
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
                'status_dp' => 1
            ]);

            $dp = Akunting::create([
                'name' => 'DP atas nama '. $customer->name,
                'price' => $price,
                'date' => date('Y-m-d'),
                'status' => 1,
                'description' => 'Pembayarab DP atas nama ' . $customer->name,
                'category_id' => 1,
                'id_customer' => $request->id_customer
            ]);
        }

        

        return redirect()->route('pemberkasan.index')->with('success', 'Pembayaran DP telah berhasil');
    }
}
