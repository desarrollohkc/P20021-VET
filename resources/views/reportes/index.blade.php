@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Reportes</h1>
        </div>

        <form method="GET" action="{{ route('reportes.filterData') }}">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Fecha inicio:</label>
                        <input class="form-control" type="date" name="desde" id="desde" value="{{ old('desde') }}"/>
                        @error('desde')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Carril</label>

                        <select class="custom-select" aria-label="Selecciona carril" name="carril" id="carril">
                            <option selected value="">Selecciona carril</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>

                        @error('carril')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Cuerpo</label>


                        <select class="custom-select" aria-label="Selecciona cuerpo" name="cuerpo" id="cuerpo">
                            <option selected value="">Selecciona cuerpo</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                        </select>

                        @error('cuerpo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Tag</label>
                        <input type="text" class="form-control @error('tag') is-invalid @enderror" name="tag" id="tag"
                               placeholder="tag" value="{{ old('tag') }}">
                        @error('tag')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Fecha fin:</label>
                        <input class="form-control" type="date" name="hasta" id="hasta" value="{{ old('hasta') }}"/>
                        @error('hasta')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Placa</label>
                        <input type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" id="placa"
                               placeholder="placa" value="{{ old('placa') }}">
                        @error('placa')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="filtrar"></label>
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Filtrar">
                </div>
                <div class="col-md-3">
                    <label for="download"></label>
                    <button type="button" class="btn btn-secondary btn-lg btn-block" style="color: white; background-color: darkgreen;">Descargar consulta <i class="fas fa-file-csv 2x"></i></button>
                </div>
            </div>
        </form>


        <div class="row">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection
