<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sp3 = House::where('status_process', 'SP3')->get();
        $akad = House::where('status_process', 'Akad')->get();
        $cash = House::where('status_process', 'Cash')->get();
        $acc = House::where('status_process', 'ACC')->get();
        $proses = House::where('status_process', 'Proses')->get();
        $kosong = House::where('status_process', 'Kosong')->get();
        $income = Akunting::where('status','1')->sum('price');
        $out = Akunting::where('status','0')->sum('price');

        $chartAccountingIn = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as sums'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 1)->groupBy('months')->get();

        $monthIn = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccountingIn as $key) {
            $monthIn[$key->months-1] = $key->sums;
        }

        $chartAccountingOut = Akunting::orderBy('date')->select(
            \DB::raw('sum(price) as sums'), 
            // \DB::raw("DATE_FORMAT(date,'%m') as months")
            \DB::raw('MONTH(date) as months')
        )
        ->where('status', 0)->groupBy('months')->get();

        $monthOut = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($chartAccountingOut as $key) {
            $monthOut[$key->months-1] = $key->sums;
        }

        $total = $income - $out;

        return view('home', compact('income', 'out','total','akad','cash','acc','proses','kosong','sp3','monthIn','monthtOut'));
    }
}
