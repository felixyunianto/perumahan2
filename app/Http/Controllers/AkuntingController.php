<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\CategoryTransaksi;
use App\Block;

class AkuntingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('akuntan');
        $accountings = Akunting::with('ct', 'subCategory')->orderBy('date','DESC')->get();
        $income = Akunting::where('status','1')->sum('price');
        $out = Akunting::where('status','0')->sum('price');

        $total = $income - $out;
        
        return view('pages.accounting.index', compact('accountings', 'income', 'out','total'));
    }

    public function create(){
        $this->authorize('akuntan');

        $category_transaction = CategoryTransaksi::all();
        $blocks = Block::all();

        return view('pages.accounting.create',compact('category_transaction','blocks'));
    }

    public function store(Request $request){
        $this->authorize('akuntan');
        $rule = [
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'block_id' => 'required'
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
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'description' => $request->description,
            'block_id' => $request->block_id
        ]);
        

        return redirect()->route('akunting.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($akunting){
        $this->authorize('akuntan');
        $akunting = Akunting::find($akunting);
        $category_transaction = CategoryTransaksi::all();

        $price = number_format($akunting->price,0,"",".");

        return view('pages.accounting.edit', compact('akunting','price','category_transaction'));
    }

    public function update(Request $request, $akunting){
        $this->authorize('akuntan');
        $akunting = Akunting::findOrFail($akunting);
        $price = (int)str_replace(".","",$request->price);

        $akunting->update([
            'name' => $request->name,
            'price' => $price,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
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
