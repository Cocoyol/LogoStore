@extends('layouts.front')

<?php
        $page = "Home";
        $result_name = $srch = "";
        if(isset($data)) {
            $type = $data[0];
            $obj = $data[1];
            switch ($type) {
                case 'category' :
                    $page = $obj->name;
                    $result_name = "Categor&iacute;a: $obj->name";
                    break;
                case 'search' :
                    $page = "B&uacute;squeda";
                    $result_name = "B&uacute;squeda: $obj";
                    $srch = $obj;
                    break;
            }
        }

?>

@section('title')
    Logo Store - {{ $page }}
@endsection

@section('content')

    <div class="container">
        <div class='row'><h3>{{ $result_name }}</h3></div>
        @include('front.partials.filters')
        <div class="clearfix"></div>
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
                                $tmpname = pathinfo($logo->images->first()->filename, PATHINFO_FILENAME);
                                $imageUrl = asset('storage/imagesLogos').'/'.$tmpname.'_thumb.jpg';
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
                {{ $logos->appends(Request::only(['search','pp','o']))->render() }}
            </div>
        </div>

    </div>

    {{ Form::open(['url' => Request::url(), 'method' => 'GET', 'id' => 'paginate']) }}
        {{ Form::hidden('search', null, ['id'=>'hSearchText']) }}
        {{ Form::hidden('pp', null, ['id'=>'hPerPage']) }}
        {{ Form::hidden('o', null, ['id'=>'hOrder']) }}
    {{ Form::close() }}

@endsection

@section('scripts')
    <script type="application/javascript">

        $(document).on('ready', function () {
            var search = $('#searchText');
            var ppage = $('#perPage');
            var order = $('#order');

            function assignHidden() {
                $('#hSearchText').val(search.val());
                $('#hPerPage').val(ppage.val());
                $('#hOrder').val(order.val());
            }

            $(document).on('submit', '#searchForm', function(e) {
                e.preventDefault();
                alert("submited");
                $('#paginate').attr("action",  $("#searchForm").attr("action"));
                assignHidden();
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