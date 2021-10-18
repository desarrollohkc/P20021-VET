<?php

namespace App\Http\Controllers;

use App\Models\PorticoAforador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TableroDeControl extends Controller
{
    /**
     * Muestra el tablero de control.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tablero-de-control.index');
    }

    public function show($carril){

        $date = Carbon::now();
        $fecha = $date->day . ' de ' . $date->monthName . ' del ' . $date->year . ' a las '. $date->hour . ':' . $date->minute . ':' . $date->second;
        return view('tablero-de-control.show-info',compact('carril','fecha'));
    }
}
