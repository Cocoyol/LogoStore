<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Texto</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

    @foreach($additionals as $additional)
        <tr data-id="{{ $additional->id  }}">
            <td>{{ $additional->id }}</td>
            <td>{{ $additional->text }}</td>
            <td>{{ $additional->price }}</td>
            <td>
                <a href="{{ route('admin.additional.edit', $additional) }}">Editar</a>
            </td>
        </tr>
    @endforeach
</table>