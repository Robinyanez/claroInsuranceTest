@extends('layouts.app')

@push('css')

{{-- Estilos para DataTable --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

<style>
    span.disable-links {
        pointer-events: none;
    }
</style>

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
                            <h5>Listado de Mensajes</h5>
                            <a href="{{ route("admin.createmsgadmin") }}" type="button" class="btn btn-primary float-sm-right">
                                Crear nuevo Correo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="table_user">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Asunto</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Remitente</th>
                                <th scope="col">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->asunto}}</td>
                                    <td>
                                        @if ($item->status==='A')
                                            <a class="btn btn-success">Enviado</a>
                                        @else
                                            <a class="btn btn-danger">No Enviado</a>
                                        @endif
                                    </td>
                                    <td>{{$item->users->name}}</td>
                                    <td>
                                        @if ($item->status==='A')
                                            <a type="button" href="{{ route("admin.showmsg", $item->id) }}" class="btn btn-outline-primary">Ver</a>
                                        @else
                                            <span class="disable-links"><a type="button" href="{{ route("user.showmsg", $item->id) }}" class="btn btn-outline-primary">Ver</a></span>
                                        @endif
                                    </td>
                                </tr>
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


