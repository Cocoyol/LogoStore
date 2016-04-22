@extends('layouts.front')


@section('title')
    Logo Store - Detalles del logo
@endsection

@section('content')

    <div class="container">
        <section class="wrapp-detail-logo">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 ajust-space">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div style="border: 1px solid #e3e3e3;">
                            {{ Html::image('assets/images/detail_product.jpg', 'product',['class' => 'img-responsive center-block']) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <span style="font-size: 25px; text-transform: uppercase;">{{$logo->name}}</span>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <span style="font-size: 15px; color: #00a2ff; line-height: 40px;">CÓDIGO: {{$logo->code}}</span>
                            </div>
                        </div>

                        <hr>

                            <span class="detail-date">Fecha de carga: {{ date('M d Y', strtotime($logo->created_at)) }}</span>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <p class="detail-description"><span class="detail-title-category">DESCRIPCIÓN:</span> {{$logo->description}}</p>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="detail-categories"><span class="detail-title-category">CATEGORÍA:</span> {!! ($logo->category != null) ? $logo->category->name : "<em>Sin Categor&iacute;a</em>" !!} </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div><span class="detail-title-category">PALABRAS CLAVE:</span>
                                        @foreach($logo->keywords as $keyword)
                                            <span class="label label-info custom-label">{{ $keyword->name }}</span>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <span class="arrow-price">${{ $logo->price }}</span>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <span class="buy-now center-block"><a href="{{route('register')}}">COMPRAR</a></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row">

                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="img-wrapp-logo">
                            {{ Html::image('assets/images/product.jpg', 'product',['class' => 'img-responsive center-block']) }}
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="arrow-price center-block">${{ $logo->price }}</span>
                            </div>
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="buy-now center-block"><a href="{{ route('detail', $logo) }}">COMPRAR</a></span>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
@endsection