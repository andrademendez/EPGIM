<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Referencia</th>
            <th>Medidas</th>
            <th>Cantidad</th>
            <th>Clave</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Unidad</th>
            <th>Tipo</th>
            <th>Ubicación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($espacios as $key => $espacio)
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $espacio->nombre }}</td>
            <td>{{ $espacio->referencia }}</td>
            <td>{{ $espacio->medidas }}</td>
            <td>{{ $espacio->cantidad }}</td>
            <td>{{ $espacio->clave }}</td>
            <td>{{ $espacio->precio }}</td>
            <td>{{ $espacio->estatus }}</td>
            <td>{{ $espacio->unidad->nombre}}</td>
            <td>{{ $espacio->tipo->nombre }}</td>
            <td>{{ $espacio->ubicacion->nombre }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
