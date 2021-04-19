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
                <form action="{{ route("admin.sendmsgadmin") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Asuston:</label>
                                    <input type="text" class="form-control @error('asunto') is-invalid @enderror" id="asunto" name="asunto" value="{{ old('asunto') }}">
                                    @error('asunto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Destimatario:</label>
                                    <select class="form-control @error('destinatario') is-invalid @enderror" id="destinatario" name="destinatario">
                                        <option selected="selected" disabled>Elegir</option>
                                        @forelse($users as $value)
                                            <option value="{{$value->email}}" @if(old('destinatario') == $value->email) selected="selected" @endif>{{$value->name}}</option>
                                        @empty
                                            <option value="">No existen datos</option>
                                        @endforelse
                                    </select>
                                    @error('destinatario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="">Mensaje:</label>
                                    <textarea class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" name="mensaje" cols="30" rows="10">{{ old('mensaje') }}</textarea>
                                    @error('mensaje')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')


@endpush
