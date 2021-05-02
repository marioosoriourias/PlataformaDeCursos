@extends('adminlte::page')

@section('title', 'CodersFree')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card body">
            <h2>Nombre</h2>
            <p>{{$user->name}}</p>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop