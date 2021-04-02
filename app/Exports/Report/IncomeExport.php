<?php

namespace App\Exports\Report;

use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;
use App\Akunting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class IncomeExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($daterange){
        $this->daterange = $daterange;
    }

    public function collection()
    {
        $date = explode('+', $this->daterange);
        $start = Carbon::parse($date[0])->format('Y-m-d');
        $end = Carbon::parse($date[1])->format('Y-m-d');

        return Akunting::whereBetween('date', [$start, $end])->where('status', 1)->get();
    }

    public function map($incomes) : array {
        $no = 1;
        return [
            $no++,
            $incomes->name,
            Carbon::parse($incomes->date)->format('d F Y'),
            'Rp. '.number_format($incomes->price,0,'','.')
        ];
    }

    public function headings() : array {
        return [
            '#',
            'Uraian',
            'Tanggal',
            'Total'
        ] ;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
