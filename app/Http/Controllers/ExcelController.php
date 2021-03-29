<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\TendersImport;
use App\Exports\TendersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class ExcelController extends Controller
{
    public function validateCSV(string $path)
    {
        // $arrayCSV = new \SplFixedArray(40000);
        $row = 0;
        if (($handle = fopen($path, 'r')) !== FALSE) {
            try {
                $header = fgetcsv($handle, 5000, ';');
                while (($data = fgetcsv($handle, 5000, ';')) !== FALSE) {
                    // yield \SplFixedArray::fromArray($data); // 2.96mb 2.74 sec
                    // yield $data; // 2.96mb 2.7 sec
                    yield &$data; // 2.95mb 2.6 sec
                }
            } finally {
                fclose($handle);
            }
        }
    }

    public function store(Request $request)
    {
        if ($request->hasFile('document')) {
            $fileName = $request->file('document')->store('tenders');
            $fullPath = Storage::disk('local')->path($fileName);
            $row = 1;
            $time_start = microtime(true);
            echo 'Используемая память: ' . (float)(memory_get_usage ($real_usage = false) / 1000000) . 'MB<br>';

            foreach($this->validateCSV($fullPath) as $row) {
                // echo '<pre>' . print_r($row, true) . '</pre>';
            }
            echo 'Используемая память: ' . (float)(memory_get_usage ($real_usage = false) / 1000000) . 'MB<br>';
            echo (microtime(true) - $time_start) . '<br>';
            // if( $this->validateCSV($fullPath)) {
            //     echo 'Используемая память: ' . (float)(memory_get_usage ($real_usage = false) / 1000000) . 'MB<br>';
            //     echo (microtime(true) - $time_start) . '<br>';
            // };
        }
    }

    public function chunkUpload(Request $request)
    {

        $data = $request->input(['success', 'chunk', 'start', 'path', 'load']);
        // $path = Storage::disk('local')->path($data['path']);
        // $array = Excel::toArray(new TendersImport((int)$data['chunk'], (int)$data['start']), $path);

        $response = [
            'success' => 1,
            'chunk' => 100,
            'start' => (int)$data['start'] + (int)$data['chunk'],
            'path' => $data['path'],
            'load' => 1,
            'array' => $array,
        ];

        return response()
                ->json(json_encode($response));

        // $filePath = $request->input('filepath');

        // $response = [
        //     'success' => 1,
        //     'data' => [
        //         $filePath,
        //     ],
        // ];
        // return response()->json(json_encode($response));


        // $path = Storage::disk('local')->path($filePath);
        // $array = Excel::toArray(new TendersImport(), $path);
        // return response()
        //         ->json(
        //             json_encode([
        //                 'success' => 1,
        //             ])
        //         );
    }
}
