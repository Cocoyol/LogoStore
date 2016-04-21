<section class="contact_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="title_contact">CONTACTO</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2">
                {!! Form::open(['method' => 'POST']) !!}
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            {!! Form::textarea('comments', null, ['class' => 'form-control', 'rows' => '6', 'placeholder' => 'Comentarios']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-success center-block">ENVIAR</button>
                    </div>
                    <p>&nbsp;</p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>