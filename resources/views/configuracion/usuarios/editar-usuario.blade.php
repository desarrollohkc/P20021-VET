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
                        Editar Usuario
                    </div>
                </div>

                <hr>

                <!-- Button trigger modal -->
                @if(Auth::user()->rol->nombre == 'admin' or Auth::user()->rol->nombre == 'super_admin')
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarUsuario">
                            Eliminar
                        </button>
                    </div>
                @endif

                <form method="POST" action="{{ route('configuracion.usuarios.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                               placeholder="Nombre del usuario" value="{{ $user->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                               placeholder="correo@ejemplo.com" value="{{ $user->email }}">
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
                                    <option value="{{ $role->id }}" @if($role->id == $user->rol->id ) selected @endif>{{ $role->descripcion }}</option>
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
                               placeholder="Ingrese una contraseña" value="">
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
                            <input type="submit" class="btn btn-info btn-block" value="Actualizar">
                        </div>
                    </div>
                </form>

                <!-- Modal -->
                <div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="eliminarUsuarioTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminarUsuarioTitle">Eliminar el usuario {{ $user->email }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Esta seguro que desea eliminar al usuario?
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{ route('configuracion.usuarios.delete',[$user]) }}">
                                    {{ method_field('DELETE') }}
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
