@extends('layouts.app')

@section('styles')
    @include('admin.logos.partials.keywordsStyles')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Logo</div>
                    <div class="panel-body">

                        @include('admin.partials.messages')

                        {!! Form::open(['route' => 'admin.logos.store', 'method' => 'POST']) !!}
                        @include('admin.logos.partials.fields')
                        <button type="submit" class="btn btn-default">Crear Logo</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('admin.logos.partials.keywordsScripts')
@endsection