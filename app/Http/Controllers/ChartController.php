<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;

class ChartController extends Controller
{
    public function incomeChart(){
    
        $current_year = date('Y');

        $chartAccounting = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as income'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 1)->whereYear('date', $current_year)->groupBy('months')->get();
        
        
        $chartAccounting1 = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as outcome'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 0)->whereYear('date', $current_year)->groupBy('months')->get();

        $month = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccounting as $key) {
            $month[$key->months-1] = $key->income;
        }

        $month1 = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccounting1 as $key) {
            $month1[$key->months-1] = $key->outcome;
        }

        $profit = $chartAccounting->sum('income') - $chartAccounting1->sum('outcome');
        return response()->json([$month, $month1, $profit]);
    }

    public function statusHouse(Request $request){
        $house = House::select(
            \DB::raw('count(status_process) as total'),
            \DB::raw('status_process')
        )->groupBy('status_process')->get();

        if($request->block_id){
            $house = House::select(
                \DB::raw('count(status_process) as total'),
                \DB::raw('status_process')
            )->groupBy('status_process')->where('block_id', $request->get('block_id'))->get();

            // return view('home');
        }


        return response()->json($house);
    }

    
}
