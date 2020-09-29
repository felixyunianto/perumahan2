<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MoneySetting;

class MoneySettingController extends Controller
{
    public function index(){
        $moneySettings = MoneySetting::all();
        return view('pages.money.index', compact('moneySettings'));
    }

    public function store(Request $request){
        $rule = [
            'name' => 'required',
            'price' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong'
        ];

        $this->validate($request, $rule, $message);

        $name = strtoupper($request->name);
        $price = (int)str_replace(".","",$request->price);

        MoneySetting::create([
            'name' => $name,
            'price' => $price
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    public function edit($money_setting){
        $moneySetting = MoneySetting::find($money_setting);

        $price = number_format($moneySetting->price,0,"",".");

        return view('pages.money.edit', compact('moneySetting','price'));
    }

    public function update($money_setting, Request $request){
        $rule = [
            'name' => 'required',
            'price' => 'required'
        ];

        $message = [
            'required' => 'Bidang :attribute tidak boleh kosong'
        ];

        $this->validate($request, $rule, $message);

        $name = strtoupper($request->name);
        $price = (int)str_replace(".","",$request->price);

        $moneySetting = MoneySetting::findOrFail($money_setting);

        $moneySetting->update([
            'name' => $name,
            'price' => $price
        ]);

        return redirect()->route('money-setting.index')->with('success','Berhasil mengubah data');
    }

    public function destroy($money_setting){
        $moneySetting = MoneySetting::findOrFail($money_setting);
        $moneySetting->delete();

        return redirect()->route('money-setting.index')->with('success','Berhasil menghapus data');        
    }
}
