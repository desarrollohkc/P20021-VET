@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="h2">Estatus y Monitoreo</div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>Cuerpo</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Información</th>
            </tr>
            </thead>
            <tbody>
            @forelse(range(0, 1) as $item)
                @if($loop->index == 1)
                    @php
                        $carril = 'B';
                    @endphp
                @else
                    @php
                        $carril = 'A';
                    @endphp
                @endif
                <tr>
                    <td>
                        <a href="{{route('tablero-de-control.show',[$carril])}}">
                            {{ $carril }}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('tablero-de-control.show',[$carril])}}">
                            @if($loop->index == 1)
                                activo
                            @else
                                inactivo
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{route('tablero-de-control.show',[$carril])}}">
                            {{ $loop->index }}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('tablero-de-control.show',[$carril])}}">
                            {{ $loop->index }}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('tablero-de-control.show',[$carril])}}">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <h1>Sin información</h1>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
