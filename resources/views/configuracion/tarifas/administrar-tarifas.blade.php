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
                        Administrar Tarifas
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="h3">
                            Tarifa Actual:
                            <div class="color-green mt-2" >$ {{ $tarifa->cantidad }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="h3 mb-2">
                            ¿Qué acción desdea realizar?
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <small>Esta acción modifica las tarifas históricas sobre los registros del Portico Aforador.</small>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalActualizarTarifa">
                            Actualizar tarifa
                        </button>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <small>Esta acción define la nueva tarifa para los todos los registros nuevos del Portifo Aforador.</small>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDefinirTarifa">
                            Aplicar nueva tarifa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Actualizar --}}
    <div class="modal fade" id="modalActualizarTarifa" tabindex="-1" role="dialog" aria-labelledby="modalActualizarTarifaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalActualizarTarifaLabel">Actualizar Tarifa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('configuracion.tarifas.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="delivery_date">Fecha inicio</label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio"
                                   placeholder="Desde: fecha" value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="delivery_date">Fecha fin</label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin" id="fecha_fin"
                                   placeholder="Hasta: fecha" value="{{ old('fecha_fin') }}">
                            @error('fecha_fin')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nueva Cantidad</label>
                            <input type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" id="cantidad"
                                   placeholder="$000.00" value="{{ old('cantidad') }}">
                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Actualizar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--fin modal actualizar--}}

    {{-- Modal Definir Tarifa --}}
    <div class="modal fade" id="modalDefinirTarifa" tabindex="-1" role="dialog" aria-labelledby="modalDefinirTarifaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDefinirTarifaLabel">Aplicar nueva tarifa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('configuracion.tarifas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nueva Cantidad</label>
                            <input type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad" id="cantidad"
                                   placeholder="$000.00" value="{{ old('cantidad') }}">
                            @error('cantidad')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info btn-block" value="Aplicar nueva tarifa">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- fin Modal Definir Tarifa --}}

@endsection
