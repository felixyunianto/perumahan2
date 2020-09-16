<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Excel;
use App\Exports\Report\SpendingExport;
use App\Exports\Report\IncomeExport;


class ExcelController extends Controller
{
    public function excelSpending($daterange){
        return Excel::download(new SpendingExport($daterange), 'laporan-pengeluaran.xlsx');
    }

    public function excelIncome($daterange){
        return Excel::download(new IncomeExport($daterange), 'laporan-pemasukan.xlsx');
    }
}
