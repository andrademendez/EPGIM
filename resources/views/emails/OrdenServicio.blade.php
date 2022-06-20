<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Orden de servicios</title>
    <!-- Styles -->
    {{--
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <style>
        table,
        td,
        th {
            border: 1px solid;
            padding: 5px 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body class="antialiased">
    <div style="padding: 10px 15px;">
        <table>
            <thead>
                <tr class="">
                    <th colspan="2">Solicitud de permiso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Centro comercial: </td>
                    <td> {{ $orden->espacios($orden->ubicacion)->unidad->nombre }}</td>
                </tr>
                <tr>
                    <td>Actividad a Realizar: </td>
                    <td> {{ $orden->actividad->nombre }} </td>
                </tr>
                <tr>
                    <td>Marca o Cliente: </td>
                    <td> {{ $orden->campania->cliente->nombre }} </td>
                </tr>
                <tr>
                    <td>Ubicación: </td>
                    <td> {{ $orden->espacios($orden->ubicacion)->referencia }} </td>
                </tr>
                <tr>
                    <td>Fecha de ejecucion: </td>
                    <td>
                        <div>
                            <span>{{ $orden->fecha_inicio }} {{ $orden->fecha_fin }} </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Horario: </td>
                    <td> {{ $orden->horario_inicio }} - {{ $orden->horario_fin }} </td>
                </tr>
                <tr>
                    <td>Agencia: </td>
                    <td> {{ $orden->campania->user->name }} </td>
                </tr>
                <tr>
                    <td>Url recurso: </td>
                    <td> @if ($orden->tipo_orden_servicios_id == 1)
                        <a href="{{ $orden->url }}" target="_blank" rel="noopener noreferrer"
                            class="uppercase text-indigo-500">Descargar contenido
                        </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Responsable: </td>
                    <td>
                        @foreach ($orden->responsables($orden->actividad_id) as $activ)
                        @foreach ($activ->users as $user)
                        {{ $user->name }},
                        @endforeach
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>Comentarios: </td>
                    <td> {{ $orden->comentarios }} </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
