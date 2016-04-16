@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Logo</div>
                    <div class="panel-body">
                        {!! Form::model($logo, ['route' => ['admin.logos.update', $logo], 'method' => 'PUT']) !!}
                        @include('admin.logos.partials.fields')
                        <button type="submit" class="btn btn-default">Actulizar Logo</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection