@extends('layouts.front')

@section('title')
    Logo Store - Resumen de la compra
@endsection

@section('content')
    <?php
        setlocale(LC_ALL, 'es-mx');
        $totalPrice = $logo->price;
    ?>
    {!! Form::open(['route' => 'payment', 'method' => 'GET']) !!}
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row bs-wizard" style="border-bottom:0;">

                        <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step complete"><!--active-->
                            <div class="text-center bs-wizard-stepnum">1</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="{{ route('register') }}" class="bs-wizard-dot"></a>
                            <div class="bs-wizard-info text-center">DATOS DEL CLIENTE</div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step complete"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">2</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="{{ route('requirement') }}" class="bs-wizard-dot"></a>
                            <div class="bs-wizard-info text-center">DATOS PARA EL LOGO</div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step complete"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">3</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="{{ route('additional') }}" class="bs-wizard-dot"></a>
                            <div class="bs-wizard-info text-center">ADICIONALES</div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3 bs-wizard-step active"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">4</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="#" class="bs-wizard-dot"></a>
                            <div class="bs-wizard-info text-center">RESUMEN DE LA COMPRA</div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="clearfix">&nbsp;</div>
            @include('front.partials.messages')
            <section class="wrapp-detail-logo">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 ajust-space-summary-page">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div style="border: 1px solid #e3e3e3;">
                                <?php
                                    $imageUrl = asset('assets/images/detail_product.jpg');
                                    if($logo->images->count()){
                                        $filename = extractFilename($logo->images->first()->filename);
                                        $extension = extractExtension($logo->images->first()->filename);
                                        $imageUrl = asset('storage/imagesLogos').'/'.$filename.'_thumb3.'.$extension;
                                    }
                                ?>
                                {{ Html::image($imageUrl, 'product',['class' => 'img-responsive center-block']) }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <span style="font-size: 25px; text-transform: uppercase;">{{ $logo->name }}</span>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <span style="font-size: 15px; color: #00a2ff; line-height: 40px;">CÓDIGO: {{ $logo->code }}</span>
                                </div>
                            </div>

                            <hr>

                            <span class="detail-date">Fecha de carga: {{ ucfirst(strftime('%b %d %Y', strtotime($logo->created_at))) }}</span>
                            <div class="clearfix">&nbsp;</div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <p class="detail-description"><span class="detail-title-category">DESCRIPCIÓN:</span> {{ $logo->description }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="detail-categories"><span class="detail-title-category">CATEGORÍA:</span> {!! ($logo->category != null) ? $logo->category->name : "<em>Sin Categor&iacute;a</em>" !!} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div><span class="detail-title-category">PALABRAS CLAVE:</span>
                                        @foreach($logo->keywords as $keyword)
                                            &nbsp;
                                            <span class="label label-info custom-label">
                                                {{ $keyword->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div><span class="detail-title-category">PRECIO:</span>$ {{ $totalPrice }}</div>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                            <hr/>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="detail-categories"><span class="detail-title-category">DATOS DEL CLIENTE:</span>
                                        <dl>
                                            <dt>Nombre</dt>
                                            <dd>{{ Session::get('customer.name') }}</dd>
                                            <dt>Email</dt>
                                            <dd>{{ Session::get('customer.email') }}</dd>
                                            <dt>Tel&eacute;fono</dt>
                                            <dd>{{ Session::get('customer.phone') }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="detail-categories"><span class="detail-title-category">DATOS PARA EL LOGO:</span>
                                        <dl>
                                            <dt>Nombre de la empresa</dt>
                                            <dd>{{ Session::get('requirements.company') }}</dd>
                                            @if(Session::has('requirements.secondaryText'))
                                                <dt>Texto Secundario</dt>
                                                <dd>{{ Session::get('requirements.secondaryText') }}</dd>
                                            @endif
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            @if(count(Session::get('additionals')))
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="detail-categories"><span class="detail-title-category">DATOS ADICIONALES:</span>
                                        <ul>
                                            <?php
                                                $addPrices = LogoStore\AdditionalRequirementsLogoPrice::all();
                                            ?>
                                            @if(Session::has('additionals.1.q'))
                                                <li>Cambiar tipograf&iacute;a + ${{ $addPrices[0]->price }}</li>
                                                <?php $totalPrice += $addPrices[0]->price; ?>
                                            @endif
                                            @if(Session::has('additionals.2.q'))
                                                <li>Cambiar color + ${{ $addPrices[1]->price }}</li>
                                                    <?php $totalPrice += $addPrices[1]->price; ?>
                                            @endif
                                            @if(Session::has('additionals.3.q'))
                                                <li>{{ Session::get('additionals.3.data') }} Revisiones + ${{ Session::get('additionals.3.data')*$addPrices[2]->price }}</li>
                                                <?php $totalPrice += Session::get('additionals.3.data')*$addPrices[2]->price; ?>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-xs-6 col-sm-4 col-md-4">
                                    <span class="arrow-price">$ {{ $totalPrice }}</span>
                                </div>
                                <div class="col-xs-6 col-sm-8 col-md-8">
                                    <div style="line-height: 65px;">{!! Form::checkbox('terms', 'true') !!} ACEPTO TÉRMINOS Y CONDICIONES</div>
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
                    <div class="col-xs-12 col-sm-12 col-md-12" style="text-align: center;">
                        <button class="btn btn-pay-cancel center-block">Pagar ahora</button>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection
