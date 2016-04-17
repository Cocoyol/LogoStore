@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Logos</div>
                    <div class="panel-body">
                        @if(Session::has('message'))

                            <p class="alert alert-success"><strong>{{ Session::get('message') }}</strong></p>

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

                    alert(result.message);

                }).fail(function(){
                    alert('El Logo no fue eliminado');
                    row.show();
                });

            });

        });

    </script>
@endsection