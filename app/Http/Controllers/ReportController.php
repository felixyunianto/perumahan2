<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Akunting;
use App\House;
use App\Block;
use App\CategoryTransaksi;
use App\Customer;
use Carbon\Carbon;

class ReportController extends Controller
{
    
    public function income(Request $request){
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

        $sp3 = House::where('status_process','SP3')->get();
        $akad = House::where('status_process','Akad')->get();
        $proses = House::where('status_process','Proses')->get();
        $cash = House::where('status_process','Cash')->get();
        $total = House::whereNotIn('status_process',['Kosong'])->get();
        $kosong = House::where('status_process','Kosong')->get();

        if($request->block_id){
            $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->where('block_id', $request->block_id)->get();

            $sp3 = House::where('status_process','SP3')->where('block_id', $request->block_id)->get();
            $akad = House::where('status_process','Akad')->where('block_id', $request->block_id)->get();
            $proses = House::where('status_process','Proses')->where('block_id', $request->block_id)->get();
            $cash = House::where('status_process','Cash')->where('block_id', $request->block_id)->get();
            $total = House::whereNotIn('status_process',['Kosong'])->where('block_id', $request->block_id)->get();
            $kosong = House::where('status_process','Kosong')->where('block_id', $request->block_id)->get();
        }

        $selected = $request->block_id;
        
        $blocks = Block::all();        
        return view('pages.report.reporthouse', compact('reports','blocks','selected','sp3','akad','proses','cash','total','kosong'));
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

    public function totalCustomer(Request $request){
        $blocks = Block::all();
        $customers = Customer::with('akunting')->get();

        if($request->block_id){
            $customers = Customer::with('akunting')->whereHas('detail_house', function ($query) use($request){
                return $query->whereHas('house.block', function ($house) use($request){
                    return $house->where('id', $request->block_id);
                });
            })->get();
        }

        $selected = $request->block_id;
        
        return view('pages.report.total_customer', compact('customers', 'blocks', 'selected'));
    }

    public function weekProfit(){
        $now = Carbon::now();

        $startWeek = $now->startOfWeek()->format('Y-m-d');
        $endWeek = $now->endOfWeek()->format('Y-m-d');

        $order_house = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 1)->where('sub_category_id', 1)->sum('price');

        $land_price = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 2)->where('sub_sub_category_id', 1)->sum('price');
        
        $bphtb = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 2)->where('sub_sub_category_id', 2)->sum('price');

        $measurement = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 2)->where('sub_sub_category_id', 3)->sum('price');

        $official_license = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 3)->where('sub_sub_category_id', 4)->sum('price');

        $bpn_license = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 3)->where('sub_sub_category_id', 5)->sum('price');

        $dropping = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 4)->where('sub_sub_category_id', 6)->sum('price');

        $road = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 5)->where('sub_sub_category_id', 7)->sum('price');

        $channel = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 5)->where('sub_sub_category_id', 8)->sum('price');

        $fasum = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 5)->where('sub_sub_category_id', 9)->sum('price');

        $split = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 6)->where('sub_sub_category_id', 10)->sum('price');

        $imb = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 6)->where('sub_sub_category_id', 11)->sum('price');

        $listrik_kwh = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 2)->where('sub_category_id', 8)->where('sub_sub_category_id', 13)->sum('price');

        $marketing = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 3)->where('sub_category_id', 10)->sum('price');

        $employee = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 3)->where('sub_category_id', 11)->sum('price');

        $office_tools = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 3)->where('sub_category_id', 12)->where('sub_sub_category_id', 14)->sum('price');

        $office_supplies = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 3)->where('sub_category_id', 12)->where('sub_sub_category_id', 15)->sum('price');

        $office_operational = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 3)->where('sub_category_id', 12)->where('sub_sub_category_id', 16)->sum('price');

        $bank_interest = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 4)->where('sub_category_id', 13)->sum('price');

        $debt = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 4)->where('sub_category_id', 14)->sum('price');

        $loan_interest = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 5)->where('sub_category_id', 15)->sum('price');

        $pay_debt = Akunting::whereBetween('date', [$startWeek, $endWeek])
        ->where('category_id', 5)->where('sub_category_id', 16)->sum('price');


        return view('pages.report.profit', 
            compact(
                'order_house','land_price','bphtb','measurement','official_license','bpn_license',
                'dropping','road','channel','fasum','split', 'imb','listrik_kwh', 'marketing',
                'employee','office_tools','office_supplies','office_operational', 'bank_interest',
                'debt','loan_interest','pay_debt'
            )
        );
    }
}
