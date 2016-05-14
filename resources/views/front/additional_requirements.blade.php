@extends('layouts.front')

@section('title')
    Logo Store - Requerimientos adicionales
@endsection

@section('content')
    <?php setlocale(LC_ALL, 'es-mx') ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row bs-wizard" style="border-bottom:0;">

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step complete"><!--active-->
                        <div class="bs-wizard-info text-center">DATOS DEL CLIENTE</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="{{ route('register') }}" class="bs-wizard-dot"></a>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step complete"><!-- complete -->
                        <div class="bs-wizard-info text-center">DATOS PARA EL LOGO</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step active"><!-- complete -->
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
        {!! Form::open(['route' => 'requirement.preStore', 'method' => 'POST', 'id' => 'frmAdditional'])!!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h2 style="text-align: center;">Requerimientos Adicionales</h2>
                    <p style="text-align: center;">Estos requerimientos adicionales no son obligatorios.</p>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Fuente</h3>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-5">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <h3>Quiero cambiar la tipografia</h3>

                            <div class="form-group custom-form-group">
                                {!! Form::textarea('question_1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('questions', '') !!}
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <h3>$ 150.00</h3>
                    </div>
                </div>
            </div>
            <div class="fildset" style="margin-bottom: 45px; padding-bottom: 60px; border-bottom: 2px solid #d5d5d5;"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Color</h3>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-5">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Quiero cambiar los colores</h3>

                            <div class="form-group custom-form-group">
                                {!! Form::textarea('question_1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario']) !!}
                            </div>
                            <p style="color: #9d9d9d;">* ¿Que colores quieres cambiar?</p>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('questions', '') !!}
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <h3>$ 150.00</h3>
                    </div>
                </div>
            </div>
            <div class="fildset" style="margin-bottom: 45px; padding-bottom: 60px; border-bottom: 2px solid #d5d5d5;"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Revisión</h3>
                    </div>
                    <div class="col-xs-12 col-sm-5 col-md-5">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Quiero agregar revisiones al logotipo</h3>

                                <div class="input-group spinner">
                                    <!--<input type="text" class="form-control" value="1" min="0" max="10">-->
                                    {!! Form::text('revision', 1, ['class' => 'form-control', 'min' => '1', 'max'=> '10']) !!}
                                    <div class="input-group-btn-vertical">
                                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                    </div>
                                </div>
                            <p style="color: #9d9d9d;">* Para estar 100% satisfecho del logotipo que voy a recibir</p>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('questions', '') !!}
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <h3>$ 150.00 c/u </h3>
                    </div>
                </div>
            </div>
        <div class="fildset" style="margin-bottom: 45px; padding-bottom: 60px; border-bottom: 2px solid #d5d5d5;"></div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-success center-block">CONTINUAR</button>
            </div>
            <p>&nbsp;</p>

        {!! Form::close() !!}
    </div>
    <div class="clearfix">&nbsp;</div>
@endsection
@section('scripts')
    <script>
        $(function(){

            $('.spinner .btn:first-of-type').on('click', function() {
                var btn = $(this);
                var input = btn.closest('.spinner').find('input');
                if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
                    input.val(parseInt(input.val(), 10) + 1);
                } else {
                    btn.next("disabled", true);
                }
            });
            $('.spinner .btn:last-of-type').on('click', function() {
                var btn = $(this);
                var input = btn.closest('.spinner').find('input');
                if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
                    input.val(parseInt(input.val(), 10) - 1);
                } else {
                    btn.prev("disabled", true);
                }
            });

        })
    </script>
@endsection