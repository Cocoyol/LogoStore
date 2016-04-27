@extends('layouts.front')

@section('title')
    Logo Store - Resumen de la compra
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

                    <div class="col-xs-4 col-sm-4 col-md-4 bs-wizard-step complete"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum">2</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">DATOS PARA EL LOGO</div>
                    </div>

                    <div class="col-xs-4 col-sm-4 col-md-4 bs-wizard-step active"><!-- complete -->
                        <div class="text-center bs-wizard-stepnum">3</div>
                        <div class="progress"><div class="progress-bar"></div></div>
                        <a href="#" class="bs-wizard-dot"></a>
                        <div class="bs-wizard-info text-center">RESUMEN DE LA COMPRA</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="clearfix">&nbsp;</div>
        <section class="wrapp-detail-logo">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ajust-space-summary-page">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div style="border: 1px solid #e3e3e3;">
                            {{ Html::image('assets/images/summary_product.jpg', 'product',['class' => 'img-responsive center-block']) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <span style="font-size: 25px; text-transform: uppercase;">AFSE</span>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <span style="font-size: 15px; color: #00a2ff; line-height: 40px;">CÓDIGO: ein_234</span>
                            </div>
                        </div>

                        <hr>

                        <span class="detail-date">Fecha de carga: abr 19 2016</span>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <p class="detail-description"><span class="detail-title-category">DESCRIPCIÓN:</span> sadfasd asd fasdfasdfasdfasd a asdfasdfasd fasdfasdfasdfasdfasdf asdf</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="detail-categories"><span class="detail-title-category">CATEGORÍA:</span> Abstract </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div><span class="detail-title-category">PALABRAS CLAVE:</span>
                                        <span class="label label-info custom-label">sfgsdfgsdf</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-4 col-md-4">
                                <span class="arrow-price">$8000</span>
                            </div>
                            <div class="col-xs-6 col-sm-8 col-md-8">
                                <div style="line-height: 65px;">{!! Form::checkbox('terminos', 'true') !!} ACEPTO TÉRMINOS Y CONDICIONES</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <span class="btn-pay-cancel center-block"><a href="">CANCELAR</a></span>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6" style="text-align: center;">
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="C7GKHMX82CFH8">
                        <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                        <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection
