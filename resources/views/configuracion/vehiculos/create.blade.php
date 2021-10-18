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
                        Agregar Vehículo Exento
                    </div>
                </div>

                <hr>

                <form method="POST" action="{{ route('configuracion.vehiculos.store') }}" class="mb-3">
                    @csrf
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control @error('marca') is-invalid @enderror" name="marca" id="marca"
                               placeholder="Marca del vehículo" value="{{ old('marca') }}">
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
                               placeholder="Modelo del vehículo" value="{{ old('submarca') }}">
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
                               placeholder="Año del vehículo" value="{{ old('year') }}">
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
                               placeholder="Número de serie del vehículo" value="{{ old('numero_de_serie') }}">
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
                               placeholder="TAG asociado" value="{{ old('tag_id') }}">
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
                               placeholder="Placa del vehículo" value="{{ old('placa') }}">
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
                               placeholder="Color del vehículo" value="{{ old('color') }}">
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
                               placeholder="Uso del vehículo" value="{{ old('descripcion_uso') }}">
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
                            <input type="submit" class="btn btn-info btn-block" value="Crear">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
