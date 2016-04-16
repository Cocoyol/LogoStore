{!! Form::open(['route' => ['admin.customers.destroy', $customer], 'method' => 'DELETE']) !!}

<button type="submit" onclick="return confirm('Seguro que desea eliminar?')" class="btn btn-danger">Eliminar Cliente</button>

{!! Form::close() !!}