<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\CategoryTransaksi;

class AkuntingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('akuntan');
        $accountings = Akunting::all();
        $income = Akunting::where('status','1')->sum('price');
        $out = Akunting::where('status','0')->sum('price');

        $total = $income - $out;
        
        return view('pages.accounting.index', compact('accountings', 'income', 'out','total'));
    }

    public function create(){
        $this->authorize('akuntan');

        $category_transaction = CategoryTransaksi::all();

        return view('pages.accounting.create',compact('category_transaction'));
    }

    public function store(Request $request){
        $this->authorize('akuntan');
        $rule = [
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        $price = (int)str_replace(".","",$request->price);

        $this->validate($request, $rule, $message);
        $current_date = date('Y-m-d');

        $accounting = Akunting::create([
            'name' => $request->name,
            'price' => $price,
            'date' => $current_date,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'description' => $request->description
        ]);
        

        return redirect()->route('akunting.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($akunting){
        $this->authorize('akuntan');
        $akunting = Akunting::find($akunting);

        $price = number_format($akunting->price,0,"",".");

        return view('pages.accounting.edit', compact('akunting','price'));
    }

    public function update(Request $request, $akunting){
        $this->authorize('akuntan');
        $akunting = Akunting::findOrFail($akunting);
        $price = (int)str_replace(".","",$request->price);

        $akunting->update([
            'name' => $request->name,
            'price' => $price,
            'status' => $request->status,
            'description' => $request->description
        ]);
        
        return redirect()->route('akunting.index')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($akunting){
        $this->authorize('akuntan');
        $akunting = Akunting::findOrFail($akunting);
        $akunting->delete();

        return redirect()->route('akunting.index')->with('success', 'Data berhasil dihapus!');
    }
}
