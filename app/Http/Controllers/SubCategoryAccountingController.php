<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategoryAccounting;
use App\CategoryTransaksi;

class SubCategoryAccountingController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('jsonCategory');
    }

    public function index(){
        $this->authorize('akuntan');
        $sub_category_accountings = SubCategoryAccounting::with('category')->orderBy('id','asc')->get();
        $categories = CategoryTransaksi::with('subCategory')->get();
        // dd($categories);

        return view('pages.sub_category.index', compact('sub_category_accountings','categories'));
    }

    public function store(Request $request){
        $rule = [
            'name' => 'required',
            'category_id' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong'
        ];

        $this->validate($request, $rule, $message);

        if ($request->id == null) {
            
            SubCategoryAccounting::create([
                'name' => $request->name,
                'category_id' => $request->category_id
            ]);
    
            return redirect()->route('sub-kategori-transaksi.index')->with('success', 'Berhasil ditambahkan');
        }else{
            $sub_category_accountings = SubCategoryAccounting::where('id', $request->id)->firstOrFail();
            $sub_category_accountings->update([
                'name' => $request->name,
                'category_id' => $request->category_id
            ]);
            
            return redirect()->route('sub-kategori-transaksi.index')->with('success', 'Berhasil diubah');
        }
    }

    public function destroy($sub_kategori_transaksi){
        $sub_category_accountings = SubCategoryAccounting::findOrFail($sub_kategori_transaksi);
        $sub_category_accountings->delete();

        return redirect()->route('sub-kategori-transaksi.index')->with('success', 'Berhasil dihapus');
    }

    public function jsonCategory($keyword){
        $categories = SubCategoryAccounting::where('category_id', $keyword)->get();

        $results = [];

        foreach($categories as $category){
            $results[] = [
                'id' => $category->id,
                'name' => $category->name
            ];
        }

        return response()->json([
            'message' => 'success',
            'status' => true,
            'results' => $results
        ]);
    }
}
