<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use carbon\Carbon;
use App\Akunting;
use App\House;
use App\Block;
use App\Customer;

class PdfController extends Controller
{
    public function pdfIncome($daterange){
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d');
        $end = Carbon::parse($date[1])->format('Y-m-d');
        
        $incomes = Akunting::whereBetween('date', [$start, $end])->where('status', 1)->get();
        $total = $incomes->sum('price');

        $pdf = PDF::loadView('pages.pdf.pdf_income', compact('incomes', 'date', 'total'));
        return $pdf->setPaper('A4')->stream();
    }

    public function pdfSpending($daterange){
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d');
        $end = Carbon::parse($date[1])->format('Y-m-d');
        
        $spendings = Akunting::whereBetween('date', [$start, $end])->where('status', 0)->get();
        $total = $spendings->sum('price');

        $pdf = PDF::loadView('pages.pdf.pdf_spending', compact('spendings', 'date', 'total'));
        return $pdf->stream();
    }

    public function pdfHouse($block_id){
        $reports = House::with('block','detail_house','detail_house.customer','detail_house.customer.filing')->where('block_id', $block_id)->get();
        $block = Block::where('id', $block_id)->first();
        $sp3 = House::where('status_process','SP3')->where('block_id', $block_id)->get();
        $akad = House::where('status_process','Akad')->where('block_id', $block_id)->get();
        $proses = House::where('status_process','Proses')->where('block_id', $block_id)->get();
        $cash = House::where('status_process','Cash')->where('block_id', $block_id)->get();
        $total = House::whereNotIn('status_process',['Kosong'])->where('block_id', $block_id)->get();
        $kosong = House::where('status_process','Kosong')->where('block_id', $block_id)->get();

        $pdf = PDF::loadview('pages.pdf.pdf_house', compact('reports','block','sp3','akad','proses','cash','total','kosong'));

        return $pdf->setPaper('A4','landscape')->stream();

    }

    public function pdfCategory($daterange){
        $date = explode('+', $daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d');
        $end = Carbon::parse($date[1])->format('Y-m-d');

        $income = Akunting::where('category_id' , 1)->whereBetween('date', [$start, $end])->sum('price');
        
        $cost_of_goods_sold = Akunting::where('category_id', 2)->whereBetween('date', [$start, $end])->sum('price');
        
        $business_expenses = Akunting::where('category_id', 3)->whereBetween('date', [$start, $end])->sum('price');
        
        $other_income = Akunting::where('category_id', 4)->whereBetween('date', [$start, $end])->sum('price');
        
        $other_expenses = Akunting::where('category_id', 5)->whereBetween('date', [$start, $end])->sum('price');
        
        $total_income_expenses = $other_income - $other_expenses;

        $estimated_income = Akunting::where('category_id',6)->whereBetween('date', [$start, $end])->sum('price');

        $pdf = PDF::loadview('pages.pdf.pdf_category', compact('income','cost_of_goods_sold','business_expenses','other_income','other_expenses','total_income_expenses','estimated_income'));
        
        return $pdf->stream();
    }

    public function pdfCustomer(){
        $customers = Customer::all();
        $totalCustomer = count($customers);
        $pdf = PDF::loadview('pages.pdf.pdf_customer', compact('customers', 'totalCustomer'));

        return $pdf->setPaper('A4')->stream();
    }
}
