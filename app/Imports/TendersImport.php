<?php

namespace App\Imports;

use App\Models\Tender;

use Maatwebsite\Excel\Concerns\ToArray;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TendersImport implements ToArray, WithChunkReading, WithStartRow
{
    public $chunk;
    public $start;

    public function __construct($chunk = 10, $start = 1)
    {
        $this->chunk = $chunk;
        $this->start = $start;
    }

    public function array(array $array)
    {
        // return array_map(function($row){
        //     return [
        //         'filial' => $row[0],
        //         '#' => $row[1],
        //         '№' => $row[2],
        //         'name_group' => $row[3],
        //         'code' => $row[4],
        //         'TMC' => $row[5],
        //         'edizm' => $row[6],
        //     ];
        // }, $array);
    }

    public function chunkSize(): int
    {
        return $this->chunk;
    }

    public function startRow(): int
    {
        return $this->start;
    }

    public function limit(): int
    {
        return 50;
    }

}
