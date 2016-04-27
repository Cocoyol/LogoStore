@extends('layouts.front')

@section('title')
    Logo Store - Datos para el logo
@endsection

@section('content')
    <?php setlocale(LC_ALL, 'es-mx') ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div class="col-xs-4 col-sm-4 col-md-4 bs-wizard-step complete"><!--active-->
                        <div class="text-center bs-wizard-stepnum">1</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">DATOS DEL CLIENTE</div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 bs-wizard-step active"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum">2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">DATOS PARA EL LOGO</div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 bs-wizard-step disabled"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum">3</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">RESUMEN DE LA COMPRA</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1">

                {!! Form::open(['method' => 'POST']) !!}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group custom-form-group">
                            {!! Form::text('company', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la Empresa']) !!}
                        </div>
                        <div class="info-message">* Como quieres que aparezca en tu logo, puedes incluir mayúsculas, minúsculas, números y caracteres especiales.</div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group custom-form-group-textarea">
                            {!! Form::textarea('secondaryText', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario']) !!}
                        </div>
                        <div class="text-info-detail info-message">* Puede ser  tu slogan, descripción de servicios, o tus palabras clave (máximo 40 caracteres), puede incluir mayúsculas, minúsculas, números y caracteres especiales.</div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-success center-block">CONTINUAR</button>
                    </div>
                    <p>&nbsp;</p>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection