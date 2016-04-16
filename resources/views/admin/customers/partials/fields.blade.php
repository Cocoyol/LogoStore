<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Correo electrónico']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', 'Teléfono') !!}
    {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
</div>

