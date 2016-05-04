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
                        <a href="{{ route('register') }}" class="bs-wizard-dot"></a>
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

                @include('front.partials.messages')

                {!! Form::open(['route' => 'requirement.preStore', 'method' => 'POST', 'id' => 'frmRequirements'])!!}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group custom-form-group">
                            {!! Form::text('company', Session::has('requirements') ? Session::get('requirements.company') : null, ['class' => 'form-control', 'placeholder' => 'Nombre de la Empresa']) !!}
                        </div>
                        <div class="info-message">* Como quieres que aparezca en tu logo, puedes incluir may&uacute;sculas, min&uacute;sculas, n&uacute;meros y caracteres especiales.</div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group custom-form-group-textarea">
                            {!! Form::textarea('secondaryText', Session::has('requirements') ? Session::get('requirements.secondaryText') : null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Texto Secundario']) !!}
                        </div>
                        <div class="text-info-detail info-message">* Puede ser  tu slogan, descripci&oacute;n de servicios, o tus palabras clave (m&aacute;ximo 40 caracteres), puede incluir may&uacute;sculas, min&uacute;sculas, n&uacute;meros y caracteres especiales.</div>
                    </div>
                    <p>&nbsp;</p>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn btn-success center-block" data-toggle="modal" data-target="#myModal">CONTINUAR</button>
                    </div>
                    <p>&nbsp;</p>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <h3>¿SON CORRECTOS TUS DATOS?</h3>
                    <p>Verifica que tu informaci&oacute;n est&eacute; correctamente escrita
                        ya que as&iacute; es como aparecer&aacute; en tu logo. Cualquier cambio
                        adicional, generar&aacute; un costo extra.</p>
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
    <script type="application/javascript">
        $(document).on('ready', function() {
            $(document).on('click', '#submitForm', function(e) {
                $('#frmRequirements').submit();
            });
        });
    </script>
@endsection
