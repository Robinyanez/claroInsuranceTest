@extends('layouts.app')

@push('css')

@endpush

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header">
                    <h5>Vista de nuevos Usuarios</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Nombre:</label>
                                <input type="text" class="form-control" id="name" value="{{ $users->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">E-mail:</label>
                                <input type="text" class="form-control" id="email" value="{{ $users->email }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Teléfono:</label>
                                <input type="text" class="form-control" id="phone" value="{{ $users->phone }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Cédula:</label>
                                <input type="text" class="form-control" id="identification_card" value="{{ $users->identification_card }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Fecha de nacimiento:</label>
                                <input type="text" class="form-control" id="date_of_birth" value="{{ $users->date_of_birth }}" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Pais:</label>
                                <input type="text" class="form-control" value="{{ $countries->name }}" required placeholder="Cédula..." disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Provincia:</label>
                                <select class="form-control @error('province') is-invalid @enderror" id="province" name="province" disabled>
                                    <option selected="selected" disabled>Elegir</option>
                                    @forelse($provinces as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                        @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="">Ciudad:</label>
                                <select class="form-control @error('id_cities') is-invalid @enderror" id="id_cities" name="id_cities" disabled>
                                    @forelse($cities as $value)
                                        @if ($value->id == $users->id_cities)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endif
                                    @empty
                                        <option value="">No existen datos</option>
                                    @endforelse
                                </select>
                                @error('id_cities')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
