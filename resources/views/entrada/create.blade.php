@extends('layouts.main')
@section('contenido')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>   
    @endif
    <form method="post" action="{{ route('entrada.store') }}">
        @csrf
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo') }}" placeholder="Título">
                </div>
                <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10">{{ old('contenido') }}</textarea>
                </div>
            </div>
            <div class="col-sm-7 text-center">
                <button class="btn btn-primary btn-block" type="submit">Enviar</button>
            </div>
        </div>
    </form>
@endsection