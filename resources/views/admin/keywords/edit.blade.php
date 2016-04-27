@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar palabra clave {{ $keyword->name }}</div>
                    <div class="panel-body">

                        @include('admin.keywords.partials.messages')

                        {!! Form::model($keyword, ['route' => ['admin.keywords.update', $keyword], 'method' => 'PUT']) !!}
                        @include('admin.keywords.partials.fields')
                        <button type="submit" class="btn btn-default">Actulizar palabra clave</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection