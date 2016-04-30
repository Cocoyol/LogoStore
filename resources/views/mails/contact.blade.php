
<table>
    <tr>
        <th>Nombre</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Comentarios</th>
    </tr>
    <tr>
        @foreach($user_contact as $k => $v)

            <td> {{ $v }} </td>

        @endforeach
    </tr>
</table>
