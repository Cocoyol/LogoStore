<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    @foreach($keywords as $keyword)
        <tr data-id="{{ $keyword->id  }}">
            <td>{{ $keyword->id }}</td>
            <td>{{ $keyword->name }}</td>
            <td>
                <a href="{{ route('admin.keywords.edit', $keyword) }}">Editar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a href="#!" class="btn-delete">Eliminar <i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </td>
        </tr>
    @endforeach
</table>