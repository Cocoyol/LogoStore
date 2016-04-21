<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-12 col-sm-3 col-sm-offset-1 col-md-3">
            {!! Form::open(['method' => 'POST', 'class' => 'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('filter', 'VER') !!}
                {!! Form::select('filter', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'name' => 'filter']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-1">
            {!! Form::open(['method' => 'POST', 'class' => 'form-inline']) !!}
            <div class="form-group">
                {!! Form::label('filter', 'ORDENAR POR') !!}
                {!! Form::select('filter', ['L' => 'Disponibilidad primero', 'S' => 'Small'], null, ['class' => 'form-control', 'name' => 'filter']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3">
            <h5>LOGOS DISPONIBLES {{ $logos->total() }}</h5>
        </div>
    </div>
</div>