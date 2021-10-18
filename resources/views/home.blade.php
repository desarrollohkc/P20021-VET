@extends('layouts.app')

@section('content')

    <x-filter-portico/>

    <div class="container">
        <div class="h2">Portico Aforador</div>


        @php
            $cuerpo = isset($_GET['cuerpo']) ? $_GET['cuerpo'] : '';
            $carril = isset($_GET['carril']) ? $_GET['carril'] : '';
            $tag = isset($_GET['tag']) ? $_GET['tag'] : '';
            $placa = isset($_GET['placa']) ? $_GET['placa'] : '';
            $desde = isset($_GET['desde']) ? $_GET['desde'] : '';
            $hasta = isset($_GET['hasta']) ? $_GET['hasta'] : '';
        @endphp

        <div class="row my-3 ml-1">
            @if(isset($cuerpo) and $cuerpo != '')
                <div class="search_tag mx-auto"><strong>Cuerpo:</strong> {{ $cuerpo }}</div>
            @endif
            @if(isset($carril) and $carril != '')
                <div class="search_tag mx-auto"><strong>Carril:</strong> {{ $carril }}</div>
            @endif
            @if(isset($tag) and $tag != '')
                <div class="search_tag mx-auto"><strong>Tag:</strong> {{ $tag }}</div>
            @endif
            @if(isset($placa) and $placa != '')
                <div class="search_tag mx-auto"><strong>Placa:</strong> {{ $placa }}</div>
            @endif
            @if(isset($desde) and $desde != '')
                <div class="search_tag mx-auto"><strong>Fecha inicio:</strong> {{ $desde }}</div>
            @endif
            @if(isset($hasta) and $hasta != '')
                <div class="search_tag mx-auto"><strong>Fecha fin:</strong> {{ $hasta }}</div>
            @endif
        </div>

        <div class="d-flex flex-row-reverse mb-2">
            <a href="{{ route('portico-aforador.create_data') }}">
                <i class="fas fa-plus"> Cargar Datos</i>
            </a>
        </div>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th>Fecha de ingreso</th>
                    <th>Hora</th>
                    <th>Carril</th>
                    <th>Cuerpo</th>
                    <th>Tag</th>
                    <th>Foto</th>
                    <th>Video</th>
                </tr>
                </thead>
                <tbody>
                @forelse($registros as $registro)
                    <tr>
                        <td>
                            <a href="#">
                                {{ $registro->fecha_ingreso->format('Y-m-d') }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $registro->fecha_ingreso->format('H:s') }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $registro->carril }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $registro->cuerpo }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                {{ $registro->tag_id }}
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-camera"> {{ $registro->placa }}</i>
                            </a>
                        </td>
                        <td>
                            <a href="#">
                                <i class="fas fa-video"></i>
                            </a>
                        </td>
                        {{--@if(Auth::user()->role->code == 'admin')
                            <td>
                                <a href="{{ route('lots.user',$lot->user) }}">
                                    {{ $lot->user->email }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('lots.show',$lot) }}">
                                    <i class="fas fa-eye" style="color: green"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('lots.delete',$lot) }}">
                                    <i class="fas fa-trash-alt" style="color: red"></i>
                                </a>
                            </td>
                        @endif--}}
                    </tr>
                @empty
                    <h1>Sin información</h1>
                @endforelse
                </tbody>
            </table>
            <div class="text-center">
                {{ $registros->links() }}
            </div>
        </div>
    </div>
@endsection
