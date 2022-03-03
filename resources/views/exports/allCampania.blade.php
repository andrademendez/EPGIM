<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Estatus</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Cliente</th>
            <th>Contácto</th>
            <th>Medio</th>
            <th>Espacio</th>
            <th>Referencia</th>
            <th>Clave</th>
            <th>Precio</th>
            <th>Unidad</th>
            <th>Tipo</th>
            <th>Ubicacion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->title }}</td>
            <td>{{ $invoice->status }}</td>
            <td>{{ $invoice->start }}</td>
            <td>{{ $invoice->end }}</td>
            <td>{{ $invoice->cliente }}</td>
            <td>{{ $invoice->contacto }}</td>
            <td>{{ $invoice->medio }}</td>
            <td>{{ $invoice->nombre }} </td>
            <td>{{ $invoice->referencia }}</td>
            <td>{{ $invoice->clave }}</td>
            <td>{{ $invoice->precio }}</td>
            <td>{{ $invoice->unidad }}</td>
            <td>{{ $invoice->tipo }}</td>
            <td>{{ $invoice->ubicacion }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
