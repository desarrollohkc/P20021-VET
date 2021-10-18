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
                        Crear Usuario
                    </div>
                </div>

                <hr>

                <form method="POST" action="{{ route('configuracion.usuarios.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                               placeholder="Nombre del usuario" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                               placeholder="correo@ejemplo.com" value="{{ old('email') }}">
                        <small id="emailHelp" class="form-text text-muted">Tus datos están protegidos.</small>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role_id">Tipo de Usuario*</label>
                        <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" style="color: grey">
                            <option value="" selected>Selecciona el tipo de usuario</option>
                            @foreach($roles as $role)
                                @if($role->nombre != 'super_admin' or Auth::user()->rol->nombre == 'super_admin' )
                                    <option value="{{ $role->id }}" @if($role->id == old('role_id') ) selected @endif>{{ $role->descripcion }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password"
                               placeholder="Ingrese una contraseña" value="{{ old('password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-warning" href="{{ route('configuracion.usuarios') }}">Cancelar</a>
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
