<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Clave</th>
            <th>Unidad</th>
            <th>Importe</th>
            <th>Campaña Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($espacios as $key => $espacio)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $espacio->nombre }}</td>
            <td>{{ $espacio->clave }}</td>
            <td>{{ $espacio->unidad}}</td>
            <td>{{ $espacio->importe}}</td>
            <td>{{ $espacio->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
