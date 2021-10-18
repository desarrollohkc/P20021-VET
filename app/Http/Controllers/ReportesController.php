<?php

namespace App\Http\Controllers;

use App\Models\PorticoAforador;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index(){
        return view('reportes.index');
    }

    public function filterData(Request $request){
        $data = [
            'carril' => $request->carril,
            'cuerpo' => $request->cuerpo,
            'tag' => $request->tag,
            'placa' => $request->placa,
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ];

        $query = PorticoAforador::filterPortico($data)->get();


        $data = PorticoAforador::whereDate('fecha_ingreso','>=','2021-01-01')->get();
        $count = 0;
        $data->each(function ($record) use(&$count){
            $count += $record->cantidad;
        });

        dd($count);
        return response()->json($query);
    }
}
