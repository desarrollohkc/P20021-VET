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
                        Cargar Portico
                    </div>
                </div>

                <hr>

                <form method="POST" action="{{ route('portico-aforador.documents.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Agregar CSV</label>

                        <div class="input-group">
                            <div class="custom-file" lang="es">
                                <input type="file" class="custom-file-input" id="csv_url" name="csv_url"
                                       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                <label class="custom-file-label" for="csv_url">Seleccionar CSV</label>
                            </div>
                        </div>
                        @error('csv_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 offset-9">
                                <input type="submit" class="btn btn-primary btn-block" value="Subir">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
