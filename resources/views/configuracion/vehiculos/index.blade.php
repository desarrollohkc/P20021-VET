@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-3 text-center" style="background-color: #243b5e; border-radius: 20px; padding: 20px;">
                @include('configuracion._configuracion-side-bar')
            </div>

            <div class="col-md-9 pl-3">
                <div class="row">
                    <div class="h1">
                        Administrar Vehículos Exentos
                    </div>
                </div>

                <hr>

                <div class="row justify-content-center user_table mt-3" id="tabla_vehiculos">
                    <div class="col-md-12 my-2">
                        <a href="{{ route('configuracion.vehiculos.create') }}"><i class="fas fa-plus" style="color: #243b5e"> Agregar vehículo exento</i></a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Placa</th>
                            <th>TAG</th>
                            <th>Uso</th>
                            <th>Creado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($excentos as $excento)
                            <tr>
                                <td>
                                    <a href="{{ route('configuracion.vehiculos.edit',[$excento]) }}">
                                        {{ $excento->placa }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.vehiculos.edit',[$excento]) }}">
                                        {{ $excento->tag_id }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.vehiculos.edit',[$excento]) }}">
                                        {{ $excento->descripcion_uso }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.vehiculos.edit',[$excento]) }}">
                                        {{ $excento->created_at->format('d-m-Y') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <h1>Sin información</h1>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $excentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
