@extends('layouts.front')

@section('title')
    Logo Store - Su compra
@endsection

@section('content')
    <pre>
        {{ print_r(Session::all()) }}
    </pre>
    {{ dd(Session::get('message')) }}

@endsection