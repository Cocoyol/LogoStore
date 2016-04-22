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
            <td>{{ $logo->status }}</td>
            <td>$ {{ $logo->price }}</td>
            <td>{!! ($logo->category != null) ? $logo->category->name : "<em>Sin Categor&iacute;a</em>" !!} </td>
            <td>
                @foreach($logo->keywords as $keyword)
                    <span class="label label-info">{{ $keyword->name }}</span>
                @endforeach</td>
            <td>
                <a href="{{ route('admin.logos.edit', $logo) }}">Editar</a>
                {!! ($logo->requirements != null) ? '<a href="'.route('logos.requirements', $logo).'">Requerimientos</a>' : '' !!}
                <a href="#!">{{ $logo->images->count() ? "Modificar Im&aacute;genes" : "Agregar Im&aacute;genes" }}</a>
                <a href="#!" class="btn-delete">Eliminar</a>
            </td>
        </tr>
    @endforeach
</table>