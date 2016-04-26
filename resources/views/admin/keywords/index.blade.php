@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Palabras Clave</div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div id="notyText" class="hidden"><strong>{{ Session::get('message') }}</strong></div>
                        @endif
                        <p><a class="btn btn-info" href="{{route('admin.keywords.create')}}" role="button">Nueva palabra clave</a></p>
                        <p>Hay {{ $keywords->total() }} palabras clave</p>
                        @include('admin.keywords.partials.table')
                        {{ $keywords->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['admin.keywords.destroy', ':KEYWORD_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}
@endsection

@section('scripts')

    <script type="application/javascript">

        $(document).ready(function(){

            $('.btn-delete').click(function(e){
                e.preventDefault();

                var row  = $(this).parents('tr');
                var id   = row.data('id');
                var form = $('#form-delete');
                var url  = form.attr('action').replace(':KEYWORD_ID', id);
                var data = form.serialize();

                row.fadeOut();

                $.post(url, data, function(result){
                    Noty(result.message, 'success', 3000)
                }).fail(function(){
                    Noty('La palabra clave no fue eliminada', 'error', 3000)
                    row.show();
                });
            });

            if($('#notyText').length) {
                Noty($('#notyText').html(), 'success', 3000);
            }

        });

    </script>

@endsection