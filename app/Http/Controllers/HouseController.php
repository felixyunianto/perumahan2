<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\House;

class HouseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('house');
        $blocks = Block::all();
        $houses = House::all();

        if($request->block_id){
            $houses = House::where('block_id', $request->block_id)->get();
        }

        $selected = $request->block_id;

        return view('pages.house.index', compact('houses','blocks','selected'));
    }

    public function create()
    {
        $this->authorize('house');
        $blocks = Block::all();
        return view('pages.house.create', compact('blocks'));
    }

    public function store(Request $request)
    {
        $this->authorize('house');
        $rules = [
            'name' => 'required|min:2',
            'address' => 'required',
            'price' => 'required|min:3',
            'block_id' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong',
            'min' => 'Bidang :attribute ini tidak boleh kurang dari :min'
        ];

        $this->validate($request, $rules, $message);

        $price = (int)str_replace(".","",$request->price);
        
        $houses = House::create([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $price,
            'block_id' => $request->block_id
        ]);

        return redirect()->route('rumah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy($rumah){
        $this->authorize('house');
        $house = House::findOrFail($rumah);
        if($house->status_process == 'Kosong' ){
            $house->delete();

            return redirect()->route('rumah.index')->with('success', 'Data berhasil dihapus!');
        }else{
            return redirect()->route('rumah.index')->with('warning', 'Maaf rumah sudah dipesan!');
        }
    }

    public function edit($rumah){
        $this->authorize('house');
        $house = House::find($rumah);
        
        $price = number_format($house->price, 0,"",".");
        $blocks = Block::all();
        return view('pages.house.edit', compact('house', 'blocks', 'price'));
    }

    public function update(Request $request,$rumah){
        $this->authorize('house');
        $rules = [
            'name' => 'required|min:2',
            'address' => 'required',
            'price' => 'required|min:3',
            'block_id' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong',
            'min' => 'Bidang :attribute ini tidak boleh kurang dari :min'
        ];

        $this->validate($request, $rules, $message);

        $house = House::findOrFail($rumah);
        $price = (int) str_replace(".","",$request->price);
        $house->update([
            'name' => $request->name,
            'address' => $request->address,
            'price' => $price,
            'block_id' => $request->block_id
        ]);
        return redirect()->route('rumah.index')->with('success', 'Data berhasil diubah!');
    }
}
