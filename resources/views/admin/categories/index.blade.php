@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Categorías</div>
                    <div class="panel-body">
                        @if(Session::has('message'))

                            <p class="alert alert-success"><strong>{{ Session::get('message') }}</strong></p>

                        @endif
                        <p><a class="btn btn-info" href="{{route('admin.categories.create')}}" role="button">Nueva categoría</a></p>
                        <p>Hay {{ $categories->total() }} categorias</p>
                        @include('admin.categories.partials.table')
                        {{ $categories->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['admin.categories.destroy', ':CATEGORY_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
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
            var url  = form.attr('action').replace(':CATEGORY_ID', id);
            var data = form.serialize();

            row.fadeOut();

            $.post(url, data, function(result){
                alert(result.message);
            }).fail(function(){
                alert('La categoria no fue eliminada');
                row.show();
            });

        });

    });

</script>

@endsection