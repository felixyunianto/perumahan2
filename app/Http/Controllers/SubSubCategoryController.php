<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubSubCategory;
use App\SubCategoryAccounting;

class SubSubCategoryController extends Controller
{
    public function index(){
        $subSubCategories = SubSubCategory::orderBy('name', 'ASC')->get();
        $subCategories = SubCategoryAccounting::orderby('name', 'ASC')->get();

        return view('pages.sub_sub_category.index', compact('subSubCategories','subCategories'));
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required'
        ];

        $messages = [
            'required' => 'Bidang :attribute tidak boleh kosong!'
        ];

        // $this->validate($request, $rules, $messages);

        if($request->id == null){
            SubSubCategory::create([
                'name' => $request->name,
                'sub_category_id' => $request->sub_category_id
            ]);

            return redirect()->route('sub-sub-kategori-transaksi.index')->with('success', 'Data berhasil ditambahkan!');
        }else{
            $subSubCategory = SubSubCategory::findOrFail($request->id);
            $subSubCategory->update([
                'name' => $request->name,
                'sub_category_id' => $request->sub_category_id
            ]);

            return redirect()->route('sub-sub-kategori-transaksi.index')->with('success', 'Data berhasil diubah!');
        }
    }

    public function destroy($sub_sub_kategori_transaksi){
        $subSubCategory = SubSubCategory::findOrFail($sub_sub_kategori_transaksi);
        $subSubCategory->delete();

        return redirect()->route('sub-sub-kategori-transaksi.index')->with('success', 'Data berhasil dihapus!');
    }

    public function jsonSubCategory($keyword){
        $subCategories = SubSubCategory::where('sub_category_id', $keyword)->get();

        $results = [];

        foreach ($subCategories as $subCategory){
            $results[] = [
                'id' => $subCategory->id,
                'name' => $subCategory->name
            ];
        }

        return response()->json([
            'message' => 'success',
            'status' => true,
            'results' => $results
        ]);

    }
}
