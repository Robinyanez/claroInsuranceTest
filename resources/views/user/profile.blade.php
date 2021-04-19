@extends('layouts.app')

@push('css')

{{-- Estilos para Datapicker --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

@endpush

@section('content')
    <div class="container">
        <div class="jumbotron">
            <div class="card">
                <div class="card-header">
                    <h5>Edición de Usuarios</h5>
                </div>
                <form action="{{ route('user.update', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{$users->name}}" required placeholder="Nombre...">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">E-mail:</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{$users->email}}" required placeholder="E-mail..." readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Contraseña:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password" required placeholder="Contraseña...">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Confirmar Contraseña:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                        name="password_confirmation" required placeholder="Contraseña...">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Teléfono:</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" value="{{$users->phone}}" required placeholder="Teléfono...">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Cédula:</label>
                                    <input type="text" class="form-control @error('identification_card') is-invalid @enderror" id="identification_card"
                                        name="identification_card" value="{{$users->identification_card}}" required placeholder="Cédula..." readonly>
                                        @error('identification_card')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento:</label>
                                    <input type="text" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth"
                                        name="date_of_birth" value="{{$users->date_of_birth}}" required placeholder="1994-04-12...">
                                        @error('date_of_birth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                    <select class="form-control @error('province') is-invalid @enderror" id="province" name="province">
                                        <option selected="selected" disabled>Elegir</option>
                                        @forelse($provinces as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                        @endforelse
                                    </select>
                                    @error('date_of_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Ciudad:</label>
                                    <select class="form-control @error('id_cities') is-invalid @enderror" id="id_cities" name="id_cities">
                                        <option selected="selected" disabled>Elegir</option>
                                        @forelse($cities as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')

{{-- Scripts para Datapicker --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script>
    $('#date_of_birth').datepicker({
        format: 'yyyy-mm-dd',
        languaje: 'es',
        autoclose: true
    });
</script>

@endpush
