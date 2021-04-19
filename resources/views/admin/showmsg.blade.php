@extends('layouts.app')

@push('css')

@endpush

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header">
                    <h5>Descripción de Mensaje</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Asuston:</label>
                                <input type="text" class="form-control" id="name" value="{{$users->asunto}}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Remitente:</label>
                                <input type="text" class="form-control" id="id_users" value="{{$users->users->name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Mensaje:</label>
                                <textarea  class="form-control" id="mensaje" cols="30" rows="10" readonly>{{$users->mensaje}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


@endpush
