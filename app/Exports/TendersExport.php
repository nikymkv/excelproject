<?php

namespace App\Exports;

use App\Tender;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\FromCollection;

class TendersExport implements FromCollection
{
    // protected $tenders;

    // public function __construct(array $tenders)
    // {
    //     $this->tenders = $tenders;
    // }

    // public function array(): array
    // {
    //     return array_map(function($row){
    //         return [
    //             'filial' => $row[0],
    //             '#' => $row[1],
    //             '№' => $row[2],
    //             'name_group' => $row[3],
    //             'code' => $row[4],
    //             'TMC' => $row[5],
    //             'edizm' => $row[6],
    //         ];
    //     }, $this->$tenders);
    // }

    public function collection()
    {   
        return SalesOrder::all();
    }
}
