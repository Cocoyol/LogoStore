@extends('layouts.front')


@section('title')
    Logo Store - Registro
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step active"><!--active-->
                        <div class="bs-wizard-info text-center">DATOS DEL CLIENTE</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step disabled"><!-- complete -->
                        <div class="bs-wizard-info text-center">DATOS PARA EL LOGO</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step disabled"><!-- complete -->
                        <div class="bs-wizard-info text-center">ADICIONALES</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step disabled"><!-- complete -->
                        <div class="bs-wizard-info text-center">RESUMEN DE LA COMPRA</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>

        <div class="row">

            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                @include('front.partials.messages')

                {!! Form::open(['route' => 'register.preStore', 'method' => 'POST']) !!}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::text('name', Session::has('customer') ? Session::get('customer.name') : null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::email('email', Session::has('customer') ? Session::get('customer.email') : null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!! Form::tel('phone', Session::has('customer') ? Session::get('customer.phone') : null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-success center-block">CONTINUAR</button>
                </div>
                <p>&nbsp;</p>
                {!! Form::close() !!}

            </div>

        </div>

    </div>

@endsection