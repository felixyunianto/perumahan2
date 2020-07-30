<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;

class ChartController extends Controller
{
    public function incomeChart(){
        $chartAccounting = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as sums'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 1)->groupBy('months')->get();

        $month = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccounting as $key) {
            $month[$key->months-1] = $key->sums;
        }
        return response()->json($month);
    }

    public function outcomeChart(){
        $chartAccounting = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as sums'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 0)->groupBy('months')->get();

        $month = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccounting as $key) {
            $month[$key->months-1] = $key->sums;
        }
        return response()->json($month);
    }

    public function statusHouse(){
        $house = House::select(
            \DB::raw('count(status_process) as total'),
            \DB::raw('status_process')
        )->groupBy('status_process')->get();


        return response()->json($house);

        
    }
}
