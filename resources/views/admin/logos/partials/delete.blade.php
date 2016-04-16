{!! Form::open(['route' => ['admin.logos.destroy', $logo], 'method' => 'DELETE']) !!}

<button type="submit" onclick="return confirm('Seguro que desea eliminar?')" class="btn btn-danger">Eliminar logo</button>

{!! Form::close() !!}