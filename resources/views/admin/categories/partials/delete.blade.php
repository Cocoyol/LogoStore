{!! Form::open(['route' => ['admin.catogiries.destroy', $category], 'method' => 'DELETE']) !!}

<button type="submit" onclick="return confirm('Seguro que desea eliminar?')" class="btn btn-danger">Eliminar Categoría</button>

{!! Form::close() !!}