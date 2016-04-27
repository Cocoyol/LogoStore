<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Cliente</th>
        <th>Logo</th>
        <th>Detalles</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>

    @foreach($orders as $order)
        <tr data-id="{{ $order->id  }}">
            <td>{{ $order->id }}</td>
            <td>{{ $order->logo->name }}</td>
            <td>{{ $order->customer->name }}</td>
            <td>{{ $order->details }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
                <a href="{{ route('admin.orders.show', $order) }}">Detalles</a>
                <a href="#!" class="btn-delete">Eliminar</a>
            </td>
        </tr>
    @endforeach
</table>