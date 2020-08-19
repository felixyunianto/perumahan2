<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;
use App\Block;

class ReportController extends Controller
{
    public function income(Request $request)
    {
        $incomes = Akunting::where('status', 1)->get();

        if($request->date_start){
            $incomes = Akunting::whereBetween('date',[$request->date_start, $request->date_end])->where('status',1)->get();
        }

        $total = $incomes->sum('price');

        return view('pages.report.income', compact('incomes','total'));
    }

    public function spending(Request $request){
        $spendings = Akunting::where('status', 0)->get();

        if($request->date_start){
            $spendings = Akunting::whereBetween('date',[$request->date_start, $request->date_end])->where('status',0)->get();
        }

        $total_spending = $spendings->sum('price');

        return view('pages.report.spending', compact('spendings','total_spending'));
    }

    public function house(Request $request){
        $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->get();
        if($request->block_id){
            $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->where('block_id', $request->block_id)->get();
        }
        
        $blocks = Block::all();        
        return view('pages.report.reporthouse', compact('reports','blocks'));
    }
}
