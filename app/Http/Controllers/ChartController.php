<?php

namespace App\Http\Controllers;

use App\Models\Chart;
use App\Models\PorticoAforador;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\DeclareDeclare;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $month_label = [];
        $month = [];

        $start = Carbon::now()->subYear();

        for ($i = 0; $i <= 11; $i++){
            $date_array = $start->monthName.' '.$start->year;
            array_push($month_label,$date_array);
            array_push($month,$start->format('Y-m-d'));
            $start->addMonth();
        }

        $porticos = PorticoAforador::all();
        $portico = [];

        foreach ($month as $key => $value) {
            $fecha_fin = Carbon::parse($value)->addMonth();
            $portico[] = PorticoAforador::whereDate('fecha_ingreso','>=',$value)->whereDate('fecha_ingreso','<=',$fecha_fin)->count();
        }
        return view('chartjs.index')->with('month',json_encode($month_label,JSON_NUMERIC_CHECK))->with('portico',json_encode($portico,JSON_NUMERIC_CHECK));
    }

    public function getChartAforoDiario(){
        $dias_label = [];
        $dias = [];

        $start = Carbon::now()->subMonth();

        for ($i = 0; $i <= 28; $i++){
            $date_array = $start->monthName.' '.$start->day;
            array_push($dias_label,$date_array);
            array_push($dias,$start->format('Y-m-d'));
            $start->addDay();
        }

        $porticos = PorticoAforador::all();
        $portico = [];

        foreach ($dias as $key => $value) {
            $fecha_fin = Carbon::parse($value)->addDay();
            $portico[] = PorticoAforador::whereDate('fecha_ingreso','>=',$value)->whereDate('fecha_ingreso','<=',$fecha_fin)->count() * 147;
        }
        return view('chartjs.dias_chart')->with('dias',json_encode($dias_label,JSON_NUMERIC_CHECK))->with('portico',json_encode($portico,JSON_NUMERIC_CHECK));
    }

    public function getChartAforoHourly(){
        $hora_label = [];
        $horas = [];

        $golbal_start = $start = Carbon::parse('2021-03-22 00:00:00');

        $title = 'Aforo total del día '. $golbal_start->day. ' de ' . $golbal_start->monthName . ' del '.$golbal_start->year;

        for ($i = 0; $i <= 23; $i++){
            $date_array = $start->hour. ':00 horas' ;
            array_push($hora_label,$date_array);
            array_push($horas,$start->format('Y-m-d H:m:s'));
            $start->addHour();
        }

        $porticos = PorticoAforador::all();
        $portico = [];

        foreach ($horas as $key => $value) {
            $fecha_fin = Carbon::parse($value)->addHour();
            $portico[] = PorticoAforador::where('fecha_ingreso','>=',$value)->where('fecha_ingreso','<=',$fecha_fin)->count();
        }
        return view('chartjs.hourly')
            ->with('horas',json_encode($hora_label,JSON_NUMERIC_CHECK))
            ->with('portico',json_encode($portico,JSON_NUMERIC_CHECK))
            ->with('title',json_encode($title,JSON_NUMERIC_CHECK));
    }

}
