@extends('layouts.user')

@push('css')

{{-- Estilos para DataTable --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

@endpush

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h5>Bienvenido Lista de correos Públicos</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table"  id="table_user">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Remitente</th>
                            <th scope="col">Destinatario</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($response) as $key => $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->from_email}}</td>
                                <td>{{$item->to_email}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{\Carbon\Carbon::parse(strtotime($item->created_at))->formatLocalized('%d de %B de %Y, Hora: %H:%m') }}</td>
                                <td>
                                    <a type="button" href="{{ route("viewemail", $item->id) }}" class="btn btn-outline-primary">Ver Mensaje</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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


