<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Codigo</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th>Precio</th>
        <th><i>Categorías</i></th>
        <th><i>Palabras clave</i></th>
        <th>Acciones</th>
    </tr>

    @foreach($logos as $logo)
        <tr data-id="{{ $logo->id  }}">
            <td>{{ $logo->id }}</td>
            <td>{{ $logo->name }}</td>
            <td>{{ $logo->code }}</td>
            <td>{{ $logo->date }}</td>
            <td>Undefined</td>
            <td>$ {{ $logo->price }}</td>
            <td>Categoría</td>
            <td>Palabras Clave</td>
            <td>
                <a href="{{ route('admin.logos.edit', $logo) }}">Editar</a>
                <a href="#!" class="btn-delete">Eliminar</a>
            </td>
        </tr>
    @endforeach
</table>