@if($errors->all())

    <div class="alert alert-danger" role="alert">
        <p>Por favor Corrige los errores </p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif