<div class="row">
    @if(Auth::user()->rol->nombre == 'admin' or Auth::user()->rol->nombre == 'super_admin')
        <div class="col-md-12 my-3">
            <a style="color: #FFFFFF" href="{{ route('configuracion.usuarios') }}">
                Administrar Usuarios </a>
        </div>
        <div class="col-md-12 my-3">
            <a style="color: #FFFFFF" href="{{route('configuracion.tarifas')}}">
                Administrar Tarifas
            </a>
        </div>
        <div class="col-md-12 my-3" style="color: #FFFFFF">
            <a style="color: #FFFFFF" href="#">
                Administrar Operadores
            </a>
        </div>
        <div class="col-md-12 my-3" style="color: #FFFFFF">
            <a style="color: #FFFFFF" href="{{ route('portico-aforador.create_data') }}">
                Cargar Portico Aforador
            </a>
        </div>
    @endif
    <div class="col-md-12 my-3" style="color: #FFFFFF">
        <a style="color: #FFFFFF" href="{{route('configuracion.vehiculos')}}">
            Administrar Vehículos
        </a>
    </div>
</div>

