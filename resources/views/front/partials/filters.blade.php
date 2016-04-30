<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-3 col-sm-offset-1 col-md-3">
            {!! Form::open(['method' => 'POST', 'class' => 'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('pp', 'VER') !!}
                {!! Form::select('pp', ['12' => '12', '24' => '24', '36' => '36', '48' => '48'], Request::get('pp'), ['id'=> 'perPage', 'class' => 'form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-1">
            {!! Form::open(['method' => 'POST', 'class' => 'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('o', 'ORDENAR POR') !!}
                {!! Form::select('o', ['1' => 'Disponibilidad primero', '2' => 'Mayor precio', '3' => 'Menor precio'], Request::get('o'), ['id'=> 'order', 'class' => 'form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3">
            <h5>LOGOS DISPONIBLES {{ $logos->total() }}</h5>
        </div>
    </div>
</div>