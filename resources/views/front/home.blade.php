@extends('layouts.front')


@section('title')
    Logo Store - Home
@endsection

@section('content')

    <div class="container">
        @include('front.partials.filters')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">

                @foreach($logos as $logo)
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="img-wrapp-logo">
                            {{ Html::image('assets/images/product.jpg', 'product',['class' => 'img-responsive center-block']) }}
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="arrow-price">${{ $logo->price }}</span>
                            </div>
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="buy-now center-block"><a href="{{ route('detail', $logo) }}">COMPRAR</a></span>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {{ $logos->render() }}
            </div>
        </div>

    </div>

@endsection