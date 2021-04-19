@extends('layouts.app')

@push('css')

{{-- Estilos para DataTable --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

@endpush

@section('content')
    <div class="container">

        @if(Session::has('success'))
            <div class="alert alert-info alert-outline alert-dismissible" role="alert">
                <div class="alert-icon">
                    <i class="far fa-fw fa-bell"></i>
                </div>
                <div class="alert-message">
                    {{Session::get('success')}}
                </div>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        {{-- <div class="jumbotron"> --}}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <h5>Listado de Usuarios</h5>
                            <a href="{{ route("admin.createmsgadmin") }}" type="button" class="btn btn-primary float-sm-right ml-2">
                                Crear nuevo Correo
                            </a>
                            <a href="{{ route("admin.create") }}" type="button" class="btn btn-primary float-sm-right ml-2">
                                Registrar nuevo Usuario
                            </a>
                            <a href="{{ route("admin.sendqueues") }}" type="button" class="btn btn-primary float-sm-right ml-2">
                                Enviar Correos en Colas
                            </a>
                            <a href="{{ route("admin.listmsg") }}" type="button" class="btn btn-primary float-sm-right">
                                Ver Correos
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="table_user">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cédula</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->identification_card}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->city->name}}</td>
                                    <td colspan="3">
                                        <a type="button" href="{{ route("admin.show", $item->id) }}" class="btn btn-outline-primary">Ver</a>
                                        <a type="button" href="{{ route("admin.edit", $item->id) }}" class="btn btn-outline-warning">Editar</a>
                                        <a href="" type="button" class="btn btn-outline-danger" data-toggle="modal" data-backdrop="static" data-target="#exampleModal-{{$item->id}}">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>

                                {{-- Modal --}}
                                <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Eliminar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <p>Esta seguro que desea eliminar el registro <strong>{{$item->name}}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Si</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal --}}

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        {{-- </div> --}}
    </div>


@push('js')

{{-- Script para DataTable --}}
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#table_user').DataTable();
</script>

@endpush

@endsection


