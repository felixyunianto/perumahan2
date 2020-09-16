<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;
use App\Block;
use App\CategoryTransaksi;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function income(Request $request)
    {
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if(request()->date != ''){
            $date = explode('-', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
            $oldValue = $request->date;
        }


        $incomes = Akunting::whereBetween('date', [$start, $end])->where('status', 1)->get();

        $total = $incomes->sum('price');
        
        return view('pages.report.income', compact('incomes','total','oldValue'));
    }

    public function spending(Request $request){
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if(request()->date != ''){
            $date = explode('-', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');

        }

        $spendings = Akunting::whereBetween('date', [$start, $end])->where('status', 0)->get();

        $total_spending = $spendings->sum('price');

        return view('pages.report.spending', compact('spendings','total_spending'));
    }

    public function house(Request $request){
        $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->get();
        if($request->block_id){
            $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->where('block_id', $request->block_id)->get();
        }

        $selected = $request->block_id;
        
        $blocks = Block::all();        
        return view('pages.report.reporthouse', compact('reports','blocks','selected'));
    }


    public function category_transaction(Request $request){
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        if(request()->date != ''){
            $date = explode('-', request()->date);
            $start = Carbon::parse($date[0])->format('Y-m-d');
            $end = Carbon::parse($date[1])->format('Y-m-d');
            
        }

        $income = Akunting::where('category_id' , 1)->whereBetween('date', [$start, $end])->sum('price');
        
        $cost_of_goods_sold = Akunting::where('category_id', 2)->whereBetween('date', [$start, $end])->sum('price');
        
        $business_expenses = Akunting::where('category_id', 3)->whereBetween('date', [$start, $end])->sum('price');
        
        $other_income = Akunting::where('category_id', 4)->whereBetween('date', [$start, $end])->sum('price');
        
        $other_expenses = Akunting::where('category_id', 5)->whereBetween('date', [$start, $end])->sum('price');
        
        $total_income_expenses = $other_income - $other_expenses;

        $estimated_income = Akunting::where('category_id',6)->whereBetween('date', [$start, $end])->sum('price');
        
        return view('pages.report.report_category', compact('income','cost_of_goods_sold','business_expenses','profit','other_income','other_expenses','total_income_expenses','profit_before_tax','estimated_income'));
    }
}
