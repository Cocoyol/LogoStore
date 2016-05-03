@extends('layouts.front')

<?php
    $page = "Home";
    $result_name = "";
    $isCategory = false;
    if(!empty($data)) {
        $type = $data[0];
        $obj = $data[1];
        switch ($type) {
            case 'category' :
                $c = \LogoStore\Category::find($obj);
                if($c != null) {
                    $page = $c->name;
                    $result_name = $c->name;
                    $isCategory = true;
                }
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
                @if($isCategory)
                    <ol class="breadcrumb">
                        <li>Categor&iacute;a</li>
                        <li class="active">{{ $result_name }}</li>
                    </ol>
                @else
                    <h3>{{ $result_name }}</h3>
                @endif
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

                            $imageUrl = $default;
                            if($logo->images->count()){
                                $filename = extractFilename($logo->images->first()->filename);
                                $extension = extractExtension($logo->images->first()->filename);
                                $imageUrl = asset('storage/imagesLogos').'/'.$filename.'_thumb.'.$extension;
                            }
                        ?>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="{{ $solid }}"></div>
                        <div class="img-wrapp-logo">
                            {{ Html::image($imageUrl, 'product',['class' => 'img-responsive center-block']) }}
                        </div>
                        {{ $logo->name }}
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
                {{ $logos->appends(Request::only(['type','search','pp','o']))->render() }}
            </div>
        </div>

    </div>

    {{ Form::open(['route' => 'index', 'method' => 'GET', 'id' => 'paginate']) }}
        {{ Form::hidden('type', Request::get('type'), ['id'=>'hType']) }}
        {{ Form::hidden('search', Request::get('search'), ['id'=>'hSearchText']) }}
        {{ Form::hidden('pp', null, ['id'=>'hPerPage']) }}
        {{ Form::hidden('o', null, ['id'=>'hOrder']) }}
    {{ Form::close() }}

@endsection

@section('scripts')
    <script type="application/javascript">

        $(document).on('ready', function () {
            //var search = $('#searchText');
            var ppage = $('#perPage');
            var order = $('#order');

            function assignHidden() {
                $('#hPerPage').val(ppage.val());
                $('#hOrder').val(order.val());
            }

            $(document).on('submit', '#searchForm', function(e) {
                e.preventDefault();
                assignHidden();
                $('#hSearchText').val($('#searchText').val());
                $('#hType').val("2");
                $('#paginate').submit();
            });

            $(document).on('change', '#perPage', function() {
                assignHidden();
                $('#paginate').submit();
            });

            $(document).on('change', '#order', function() {
                assignHidden();
                $('#paginate').submit();
            });

        });
    </script>
@endsection