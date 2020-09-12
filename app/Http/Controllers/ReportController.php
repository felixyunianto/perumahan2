<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;
use App\Block;
use App\CategoryTransaksi;

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


    public function category_transaction(){
        $income = Akunting::where('category_id' , 1)->sum('price');
        $cost_of_goods_sold = Akunting::where('category_id', 2)->sum('price');
        $business_expenses = Akunting::where('category_id', 3)->sum('price');
        $other_income = Akunting::where('category_id', 4)->sum('price');
        $other_expenses = Akunting::where('category_id', 5)->sum('price');
        $total_income_expenses = $other_income - $other_expenses;
        $estimated_income = Akunting::where('category_id',6)->sum('price');

        return view('pages.report.report_category', compact('income','cost_of_goods_sold','business_expenses','profit','other_income','other_expenses','total_income_expenses','profit_before_tax','estimated_income'));
    }
}
