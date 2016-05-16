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
                        <a href="{{ route('requirement') }}" class="bs-wizard-dot"></a>
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
        {!! Form::open(['route' => 'additional.preStore', 'method' => 'POST', 'id' => 'frmAdditional'])!!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h2 style="text-align: center;">Requerimientos Adicionales</h2>
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

                            <div class="form-group custom-form-group hidden" id="q1">
                                <?php
                                    $value = Session::has('additionals.1')&&Session::get('additionals.1.q') ? Session::get('additionals.1.data') : null;
                                    $checked = Session::has('additionals.1')&&Session::get('additionals.1.q') ? ['checked' => 'checked'] : [];
                                ?>
                                {!! Form::textarea('questions[1]', $value, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario', 'style' => 'resize:none']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('additional1', '1', $checked) !!}
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

                            <div class="form-group custom-form-group hidden" id="q2">
                                <?php
                                    $value = Session::has('additionals.2')&&Session::get('additionals.2.q') ? Session::get('additionals.2.data') : null;
                                    $checked = Session::has('additionals.2')&&Session::get('additionals.2.q') ? ['checked' => 'checked'] : [];
                                ?>
                                {!! Form::textarea('questions[2]', $value, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario', 'style' => 'resize:none']) !!}
                            </div>
                            <p style="color: #9d9d9d;">* ¿Que colores quieres cambiar?</p>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('additional2', '2', $checked) !!}
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
                                <div class="input-group spinner hidden" id="q3">
                                    <?php
                                        $value = Session::has('additionals.3')&&Session::get('additionals.3.q') ? Session::get('additionals.3.data') : 1;
                                        $checked = Session::has('additionals.3')&&Session::get('additionals.3.q') ? ['checked' => 'checked'] : [];
                                    ?>
                                    {!! Form::text('questions[3]', $value, ['class' => 'form-control', 'min' => '1', 'max'=> '10']) !!}
                                    <div class="input-group-btn-vertical">
                                        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                    </div>
                                </div>
                            <p style="color: #9d9d9d;">* Para estar 100% satisfecho del logotipo que voy a recibir</p>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-1 col-md-1">
                        {!! Form::checkbox('additional3', '3', $checked) !!}
                    </div>
                    <div class="col-xs-12 col-sm-2 col-md-2">
                        <h3>$ 150.00 c/u </h3>
                    </div>
                </div>
            </div>
        <div class="fildset" style="margin-bottom: 45px; padding-bottom: 60px; border-bottom: 2px solid #d5d5d5;"></div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="button" class="btn btn-success center-block" data-toggle="modal" data-target="#myModal">CONTINUAR</button>
            </div>
            <p>&nbsp;</p>

        {!! Form::close() !!}
    </div>
    <div class="clearfix">&nbsp;</div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Instrucciones adicionales</h4>
                </div>
                <div class="modal-body">
                    <h3>¿SON CORRECTOS TUS DATOS?</h3>
                    <p>
                        Verifica que tu informaci&oacute;n est&eacute; correctamente escrita
                        ya que as&iacute; es como aparecer&aacute; en tu logo. Cualquier cambio
                        adicional, generar&aacute; un costo extra.<br/>
                        Cada opci&oacute;n seleccionada tiene un costo adicional.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">NO, QUIERO EDITAR LOS DATOS</button>
                    <button type="button" id="submitForm" class="btn btn-primary">SI, LOS DATOS SON CORRECTOS</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function toggleDiv(obj, $val) {
            if($val){
                obj.removeClass('hidden');
            } else {
                obj.addClass('hidden');
            }
        }

        $(document).on('ready', function() {

            $(document).on('click', '#submitForm', function(e) {
                $('#frmAdditional').submit();
            });

            i1 = $('input[name=additional1]');
            q1 = $('#q1');
            toggleDiv(q1,i1.is(':checked'));
            i1.on('change', function(){
                toggleDiv(q1,$(this).is(':checked'));
            });

            i2 = $('input[name=additional2]');
            q2 = $('#q2');
            toggleDiv(q2,i2.is(':checked'));
            i2.on('change', function(){
                toggleDiv(q2,$(this).is(':checked'));
            });

            i3 = $('input[name=additional3]');
            q3 = $('#q3');
            toggleDiv(q3,i3.is(':checked'));
            i3.on('change', function(){
                toggleDiv(q3,$(this).is(':checked'));
            });

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