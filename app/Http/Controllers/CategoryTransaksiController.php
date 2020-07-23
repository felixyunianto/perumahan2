<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryTransaksi;

class CategoryTransaksiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('akuntan');
        $category_transaction = CategoryTransaksi::all();

        return view('pages.category_transaction.index', compact('category_transaction'));
    }

    public function store(Request $request){
        $this->authorize('akuntan');
        $rule = ['name' => 'required'];
        $message = ['required' => 'Bidang :attribute tidak boleh kosong!'];
        $this->validate($request, $rule, $message);

        $ct = CategoryTransaksi::create([
            'name' => $request->name
        ]);

        return redirect()->route('kategori-transaksi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy($kategori_transaksi){
        $this->authorize('akuntan');
        $category_transaction = CategoryTransaksi::findOrFail($kategori_transaksi);
        $category_transaction->delete();

        return redirect()->route('kategori-transaksi.index')->with('success', 'Data berhasil dihapus!');
    }

    public function edit($kategori_transaksi){
        $this->authorize('akuntan');
        $category_transaction = CategoryTransaksi::find($kategori_transaksi);
        return view('pages.category_transaction.edit', compact('category_transaction'));
    }

    public function update(Request $request, $kategori_transaksi){
        $this->authorize('akuntan');
        $rule = ['name' => 'required'];
        $message = ['required' => 'Bidang :attribute tidak boleh kosong!'];
        $this->validate($request, $rule, $message);

        $category_transaction = CategoryTransaksi::findOrFail($kategori_transaksi);
        $category_transaction->update([
            'name' => $request->name
        ]);

        return redirect()->route('kategori-transaksi.index')->with('success', 'Data berhasil diubah!');
    }
}
