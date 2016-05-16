@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar requerimiento adicional {{ $additional->id }}</div>
                    <div class="panel-body">

                        @include('admin.partials.messages')

                        {!! Form::model($additional, ['route' => ['admin.additional.update', $additional], 'method' => 'PUT']) !!}
                        @include('admin.additional.partials.fields')
                        <button type="submit" class="btn btn-default">Actulizar Requerimiento</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection