@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Logos</div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div id="notyText" class="hidden"><strong>{{ Session::get('message') }}</strong></div>
                        @endif
                        <p><a class="btn btn-info" href="{{route('admin.logos.create')}}" role="button">Nuevo Logo</a></p>
                        <p>Hay {{ $logos->total() }} logos</p>
                        @include('admin.logos.partials.table')
                        {{ $logos->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['admin.logos.destroy', ':LOGO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')
    <script type="application/javascript">

        function Noty(msg, tp, to)
        {
            var n = noty({
                text: msg,
                type: tp,
                timeout: to
            });
        }

        $(document).ready(function(){

            $('.btn-delete').click(function(e){
                e.preventDefault();

                alert("CLickeado!!");

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $('#form-delete');


                var url =  form.attr('action').replace(':LOGO_ID', id);


                var data = form.serialize();

                row.fadeOut();

                $.post(url, data, function(result){
                    Noty(result.message, 'success', 3000)
                }).fail(function(){
                    Noty('El Logo no fue eliminado', 'success', 3000)
                    row.show();
                });

            });

            /*
                -*- NOTY -*-
             */
            if($('#notyText').length) {
                Noty($('#notyText').html(), 'success', 3000);
            }
        });

    </script>
@endsection