@extends('layouts.front')


@section('title')
    Logo Store - Detalles del logo
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <p>Detalle Logo</p>
            <p>{{ $logo->name }}</p>
        </div>
    </div>
@endsection