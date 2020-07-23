<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;

class BlockController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $this->authorize('block');
        $blocks = Block::all();
  
        return view('pages.block.index', compact('blocks'));
      }
  
      public function store(Request $request){
        $this->authorize('block');
        $rules = [
          'block_name' => 'required'
        ];
  
        $message = [
          'required' => 'Bidang :attribute tidak boleh kosong!'
        ];
  
        $this->validate($request, $rules, $message);
  
        $blocks = Block::create([
          'name_block' => $request->block_name
        ]);
        return redirect()->route('blok.index')->with('success', 'Data berhasil ditambahkan!');
      }
  
  
      public function destroy($blok){
        $this->authorize('block');
        $block = Block::findOrFail($blok);
        $block->delete();
  
        return redirect()->route('blok.index')->with('success', 'Data berhasil dihapus!');
      }
  
      public function edit($blok){
        $this->authorize('block');
        $block = Block::find($blok);
  
        return view('pages.block.edit', compact('block'));
      }
  
      public function update(Request $request, $blok){
        $this->authorize('block');
        $this->validate($request,[
          'block_name' => 'required'
        ]);
  
        $block = Block::findOrFail($blok);
        $block->update([
          'name_block' => $request->block_name
        ]);
        return redirect()->route('blok.index')->with('success', 'Data berhasil diubah!');
      }
}
