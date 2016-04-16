@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nueva categoría</div>
                    <div class="panel-body">

                        @include('admin.categories.partials.messages')

                        {!! Form::open(['route' => 'admin.categories.store', 'method' => 'POST']) !!}
                        @include('admin.categories.partials.fields')
                        <button type="submit" class="btn btn-default">Crear categoría</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection