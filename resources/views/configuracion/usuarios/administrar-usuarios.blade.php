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
                        Administrar Usuarios
                    </div>
                </div>

                <hr>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="h3 mb-2">
                            ¿Qué acción desdea realizar?
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="my-2">
                            <small>Esta acción administra los roles</small>
                        </div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDefinirTarifa">
                            Administrar Roles
                        </button>
                    </div>
                    <div class="col-md-6">
                        <div class="my-2">
                            <small>Esta sección administra los usuarios</small>
                        </div>
                        <button type="button" class="btn btn-info" onclick="showUsersTable()">
                            Administrar Usuarios
                        </button>
                    </div>
                </div>

                <div class="row justify-content-center user_table mt-3 invisible" id="tabla_usuarios">
                    <div class="col-md-12 my-2">
                        <a href="{{ route('configuracion.usuarios.create') }}"><i class="fas fa-plus" style="color: #243b5e"> Nuevo usuario</i></a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Creado</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <a href="{{ route('configuracion.usuarios.edit',[$user]) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.usuarios.edit',[$user]) }}">
                                        {{ $user->email }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.usuarios.edit',[$user]) }}">
                                        {{ $user->rol->descripcion }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.usuarios.edit',[$user]) }}">
                                        {{ $user->created_at->format('d-m-Y') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('configuracion.usuarios.edit',[$user]) }}">
                                        <i class="far fa-edit 2x"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <h1>Sin información</h1>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showUsersTable() {
            var tabla = document.getElementById("tabla_usuarios");
            tabla.classList.remove("invisible");
        }
    </script>
@endsection
