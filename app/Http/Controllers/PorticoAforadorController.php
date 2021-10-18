<?php

namespace App\Http\Controllers;

use App\Models\PorticoAforador;
use Illuminate\Http\Request;

class PorticoAforadorController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $registros = PorticoAforador::paginate(10);
        return view('home',compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PorticoAforador  $porticoAforador
     * @return \Illuminate\Http\Response
     */
    public function show(PorticoAforador $porticoAforador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PorticoAforador  $porticoAforador
     * @return \Illuminate\Http\Response
     */
    public function edit(PorticoAforador $porticoAforador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PorticoAforador  $porticoAforador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PorticoAforador $porticoAforador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PorticoAforador  $porticoAforador
     * @return \Illuminate\Http\Response
     */
    public function destroy(PorticoAforador $porticoAforador)
    {
        //
    }

    public function filteredPortico($data = null){

    }
}
