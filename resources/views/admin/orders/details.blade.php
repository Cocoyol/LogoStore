@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">&Oacute;rdenes</div>
                    <div class="panel-body">
                        @include('admin.partials.messages')
                        <h2>Logo</h2>
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#!">Informaci&oacute;n</a></li>
                        </ul>
                            <table class="table table-striped">
                                <tr>
                                    <td colspan="2">{{ $order->logo->images->count() ? $order->logo->images->first() : " - " }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $order->logo->name }}</td>
                                </tr>
                                <tr>
                                    <td>C&oacute;digo</td>
                                    <td>{{ $order->logo->code }}</td>
                                </tr>
                                <tr>
                                    <td>Fecha</td>
                                    <td>{{ $order->logo->date }}</td>
                                </tr>
                                <tr>
                                    <td>Descripci&oacute;n</td>
                                    <td>{{ $order->logo->description }}</td>
                                </tr>
                                <tr>
                                    <td>Estatus del logo</td>
                                    <td>{{ $order->logo->status }}</td>
                                </tr>
                                <tr>
                                    <td>Categor&iacute;a</td>
                                    <td>{{ $order->logo->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Precio</td>
                                    <td>{{ $order->logo->price }}</td>
                                </tr>
                            </table>
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#!">Requerimientos</a></li>
                        </ul>
                        <table class="table table-striped">
                            <tr>
                                <td>Compa&ntilde;&iacute;a</td>
                                <td>{{ $order->requirements->company }}</td>
                            </tr>
                            <tr>
                                <td>Texto Secundario</td>
                                <td>{{ $order->requirements->secondaryText }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="panel-body">
                        <h2>Cliente</h2>
                        <table class="table table-striped">
                            <tr>
                                <td>Nombre</td>
                                <td>{{ $order->customer->name }}</td>
                            </tr>
                            <tr>
                                <td>Correo electr&oacute;nico</td>
                                <td>{{ $order->customer->email }}</td>
                            </tr>
                            <tr>
                                <td>Tel&eacute;fono</td>
                                <td>{{ $order->customer->phone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="panel-body">
                        <h2>Orden</h2>
                        {{ Form::model($order, ['route' => ['admin.orders.update', $order], 'method' => 'PUT']) }}
                        <div class="form-group">
                            {!! Form::label('details', 'Detalles') !!}
                            {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Estatus') !!}
                            {!! Form::select('status', ['pendiente' => 'Pendiente', 'cancelada' => 'Cancelada', 'completa' => 'Completa'], null, ['class' => 'form-control', 'placeholder' => 'Estatus de la orden...']) !!}
                        </div>
                        <button type="submit" class="btn btn-default">Actulizar </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection