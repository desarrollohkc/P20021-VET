@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-md-12">
                <div class="h2">Información de los componentes - Carril {{ $carril }}</div>
            </div>
        </div>

        <div class="row">
            <div class="escalaColor">
                <div class="row">
                    <div class="col-md-12"><i class="fas fa-circle" style="color: #32CD32"> Servicio Activo</i></div>
                    <div class="col-md-12"><i class="fas fa-circle" style="color: #DC143C"> Servicio Inactivo</i></div>
                </div>
            </div>

            <div class="escalaColor mx-2" style="width: 320px !important;">
                <div class="h6">Último monitoreo</div>
                <div class="h6">{{ $fecha }}</div>
            </div>
        </div>


        <div class="row my-2">
            <div class="col-md-6">
                <div class="h3">Bucle</div>
                <img src="{{ asset('images/simbolo-de-bucle-automatico-de-grafico_green.svg') }}" alt="Bucle" class="iconSVG">
            </div>
            <div class="col-md-6">
                <div class="h3">Cámara de monitoreo</div>
                <img src="{{ asset('images/cctv_red.svg') }}" alt="Cámara de monitoreo" class="iconSVG">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-6">
                <div class="h3">Monitor de placas</div>
                <img src="{{ asset('images/license-plate_green.svg') }}" alt="Monitor de placas" class="iconSVG">
            </div>
            <div class="col-md-6">
                <div class="h3">ANPR</div>
                <img src="{{ asset('images/camcorder_red.svg') }}" alt="ANPR" class="iconSVG">
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-6">
                <div class="h3">Cortína fotoeléctrica</div>
                <img src="{{ asset('images/escalera_green.svg') }}" alt="Cortína fotoeléctrica" class="iconSVG">
            </div>
        </div>
@endsection
