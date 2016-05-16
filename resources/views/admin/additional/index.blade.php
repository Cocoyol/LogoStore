@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Requerimientos Adicionales</div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div id="notyText" class="hidden"><strong>{{ Session::get('message') }}</strong></div>
                        @endif
                        <p>&nbsp;</p>
                        <p>Hay {{ $additionals->total() }} Requerimientos Adicionales posibles.</p>
                        @include('admin.additional.partials.table')
                        {{ $additionals->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="application/javascript">

        $(document).ready(function(){

            if($('#notyText').length) {
                Noty($('#notyText').html(), 'success', 3000);
            }

        });

    </script>
@endsection