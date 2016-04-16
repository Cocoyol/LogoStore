@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar cliente {{ $customer->name }}</div>
                    <div class="panel-body">

                        @include('admin.customers.partials.messages')

                        {!! Form::model($customer, ['route' => ['admin.customers.update', $customer], 'method' => 'PUT']) !!}
                        @include('admin.customers.partials.fields')
                        <button type="submit" class="btn btn-default">Actulizar cliente</button>
                        <button type="button" class="btn  bg-danger pull-right" onclick="window.location='{{  URL::previous() }}'" >Cancelar</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection