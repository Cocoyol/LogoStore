@extends('layouts.front')

<?php
        $page = "Home";
        $result_name = "";
        if(isset($data)) {
            $type = $data[0];
            $obj = $data[1];
            switch ($type) {
                case 'category' :
                    $page = $obj->name;
                    $result_name = '
                    <ol class="breadcrumb">
                    <li>Categor&iacute;a</li>
                    <li class="active">'.$obj->name.'</li>
                </ol>
                    ';
                    break;
                case 'search' :
                    $page = "B&uacute;squeda";
                    $result_name = "B&uacute;squeda: $obj";
                    break;
            }
        }

?>

@section('title')
    Logo Store - {{ $page }}
@endsection

@section('content')

    <div class="container">
        @include('front.partials.filters')
        <div class="clearfix">&nbsp;</div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {!! $result_name !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">

                <?php $default = asset('assets/images/product.jpg'); ?>
                @foreach($logos as $logo)
                        <?php
                        $bn    = "buy-now-disable";
                        $route = "javascript:;";
                        $solid = "icon-sell";
                        if($logo->status == "disponible") { $bn = "buy-now";  $route = route('detail', $logo); $solid = ""; }
                        ?>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="{{ $solid }}"></div>
                        <div class="img-wrapp-logo">
                            <?php
                                $imageUrl = $default;
                                if($logo->images->count()){
                                    $tmpname = pathinfo($logo->images->first()->filename, PATHINFO_FILENAME);
                                    $imageUrl = asset('storage/imagesLogos').'/'.$tmpname.'_thumb.jpg';
                                }
                            ?>
                            {{ Html::image($imageUrl, 'product',['class' => 'img-responsive center-block']) }}
                    </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="arrow-price center-block">${{ $logo->price }}</span>
                            </div>
                            <div class="col-xs-6 col-sm-12 col-md-6">
                                <span class="{{ $bn }} center-block"><a href="{{ $route }}">COMPRAR</a></span>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="row" align="center">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {{ $logos->render() }}
            </div>
        </div>

    </div>

@endsection