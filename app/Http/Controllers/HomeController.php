<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;

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

        $income = Akunting::where('status','1')->sum('price');
        $out = Akunting::where('status','0')->sum('price');

        $total = $income - $out;

        return view('home', compact('income', 'out','total'));
    }
}
