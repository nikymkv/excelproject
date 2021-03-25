<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\TendersImport;
use App\Exports\TendersExport;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('document')) {
            $time_start = microtime(true);
            $fileName = $request->file('document')->store('tenders');
            $fullPath = Storage::disk('local')->path($fileName);
            $array = Excel::toArray(new TendersImport(1000, 1), $fullPath);

            echo (microtime(true) - $time_start) . PHP_EOL;
            echo '<pre>' . print_r($array, true) . '</pre>';
            // return response()
            // ->json(json_encode([
                // 'success' => 1,
                // 'data' => $array,
            // ]));
        }




        //     return response()
        //             ->json(
        //                 json_encode([
        //                     'success' => 1,
        //                     'tenders' => $array,
        //                 ])
        //             );
            // return response()
            //         ->json(
            //             json_encode([
            //                 'success' => 1,
            //                 'path' => $fullPath,
            //             ])
            //         );
        // } else {
        //     return response()
        //             ->json(
        //                 json_encode([
        //                     'success' => 0,
        //                     'err_msg' => 'Error',
        //                 ])
        //             );
        // }
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
