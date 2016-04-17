<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del logo']) !!}
</div>

<div class="form-group">
    {!! Form::label('code', 'Codigo') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Codigo del logo']) !!}
</div>

<div class="form-group">
    {!! Form::label('date', 'Fecha') !!}
    {!! Form::date('date', null, ['class' => 'form-control', 'placeholder' => 'Fecha']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>

<div class="form-group">
    {!! Form::label('price', 'Precio') !!}
    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Precio']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Estatus') !!}
    {!! Form::select('status', ['' => 'Selecciona el estatus', 'disponible' => 'Disponible', 'vendido' => 'Vendido'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('category_id', 'Categorias') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
</div>
