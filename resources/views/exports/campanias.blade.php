<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Cliente</th>
            <th>Contácto</th>
            <th>Costo</th>
            <th>Medio</th>
            <th>Estatus</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Espacios</th>
            <th>Referencia</th>
            <th>Clave</th>
            <th>Unidad</th>
            <th>Tipo</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->title }}</td>
            <td>{{ $invoice->cliente->nombre }}</td>
            <td>{{ $invoice->cliente->contacto }}</td>
            <td>{{ $invoice->costoCampania($invoice->id) }}</td>
            <td>{{ $invoice->medio->nombre }}</td>
            <td>{{ $invoice->status }}</td>
            <td>{{ $invoice->formatoMx($invoice->start) }}</td>
            <td>{{ $invoice->formatoMx($invoice->end) }}</td>
            @foreach ($invoice->espacios as $espacio)
            <td>

                {{ $espacio->nombre }}
                @if ($loop->remaining)
                ,
                @endif

            </td>
            <td>{{ $espacio->referencia }}</td>
            <td>{{ $espacio->clave }}</td>
            <td>{{ $espacio->unidad->nombre }}</td>
            <td>{{ $espacio->tipo->nombre }}</td>
            <td>{{ $espacio->ubicacion->nombre }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
