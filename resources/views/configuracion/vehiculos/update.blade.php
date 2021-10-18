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
                        Editar Vehículo Exento
                    </div>
                </div>

                <hr>

                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarVehiculo">
                        Eliminar
                    </button>
                </div>

                <form method="POST" action="{{ route('configuracion.vehiculos.update') }}">
                    {{ method_field('PATCH') }}
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $vehiculo->id }}">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" id="marca"
                               placeholder="Marca del vehículo" value="{{ $vehiculo->marca }}" disabled>
                        <small>Ejemplo: Chevrolet</small>
                        @error('marca')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="submarca">Modelo</label>
                        <input type="text" class="form-control @error('submarca') is-invalid @enderror" name="submarca" id="submarca"
                               placeholder="Modelo del vehículo" value="{{ $vehiculo->submarca }}" disabled>
                        <small>Ejemplo: Aveo</small>
                        @error('submarca')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year" min="1960" max="{{ $max_year }}"
                               placeholder="Año del vehículo" value="{{ $vehiculo->year }}" disabled>
                        <small>Ejemplo: 2018</small>
                        @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero_de_serie">Número de serie</label>
                        <input type="text" class="form-control @error('numero_de_serie') is-invalid @enderror" name="numero_de_serie" id="numero_de_serie"
                               placeholder="Número de serie del vehículo" value="{{ $vehiculo->numero_de_serie }}" disabled>
                        <small>Ejemplo: LSGHD52H5JD000000</small>
                        @error('numero_de_serie')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="tag_id">TAG</label>
                        <input type="text" class="form-control @error('tag_id') is-invalid @enderror" name="tag_id" id="tag_id"
                               placeholder="TAG asociado" value="{{ $vehiculo->tag_id }}" disabled>
                        <small>Ejemplo: IMDM26390000</small>
                        @error('tag_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" id="placa"
                               placeholder="Placa del vehículo" value="{{ $vehiculo->placa }}">
                        <small>Ejemplo: MEX-206</small>
                        @error('placa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" id="color"
                               placeholder="Color del vehículo" value="{{ $vehiculo->color }}">
                        <small>Ejemplo: Rojo</small>
                        @error('color')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="descripcion_uso">Uso</label>
                        <input type="text" class="form-control @error('descripcion_uso') is-invalid @enderror" name="descripcion_uso" id="descripcion_uso"
                               placeholder="Uso del vehículo" value="{{ $vehiculo->descripcion_uso }}">
                        <small>Ejemplo: Servicio de ambulancia</small>
                        @error('descripcion_uso')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-warning" href="{{ route('configuracion.vehiculos') }}">Cancelar</a>
                        </div>

                        <div class="col-md-6">
                            <input type="submit" class="btn btn-info btn-block" value="Editar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal vehiculos --}}
    <div class="modal fade" id="eliminarVehiculo" tabindex="-1" role="dialog" aria-labelledby="eliminarVehiculoTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarVehiculoTitle">Eliminar el vehículo {{ $vehiculo->tag_id }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Esta seguro que desea eliminar el vehículo?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('configuracion.vehiculos.destroy',[$vehiculo]) }}">
                        {{ method_field('DELETE') }}
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin modal vehiculos --}}
@endsection
