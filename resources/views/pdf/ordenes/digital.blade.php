<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de servicio</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="p-10 shadow-lg rounded">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="border">
                        <th scope="col" colspan="2" class="px-6 py-3 text-center">
                            Solicitud de permiso
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Centro comercial:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->espacios($orden->ubicacion)->unidad->nombre }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r  whitespace-nowrap">
                            Actividad a Realizar:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->actividad->nombre }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Marca o Cliente:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->campania->cliente->nombre }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Ubicación:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->espacios($orden->ubicacion)->referencia }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Fecha de ejecucion:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->fecha_inicio }} {{ $orden->fecha_fin }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Horario:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->horario_inicio }} - {{ $orden->horario_fin }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Agencia:
                        </td>
                        <td class="px-6 py-4 border-r">
                            {{ $orden->campania->user->name }}
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            URL Recurso:
                        </td>
                        <td class="px-6 py-4 border-r">
                            @if ($orden->tipo_orden_servicios_id == 1)
                            <a href="{{ $orden->url }}" target="_blank" rel="noopener noreferrer"
                                class="uppercase text-indigo-500">Abrir
                                recurso</a>
                            @endif
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Responsable(s):
                        </td>
                        <td class="px-6 py-4 border-r">
                            @foreach ($orden->responsables($orden->actividad_id) as $activ)

                            @foreach ($activ->users as $user)
                            {{ $user->name }}
                            @if ($loop->remaining)
                            ,
                            @endif

                            @endforeach
                            @endforeach
                        </td>

                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border">
                        <td class="px-6 py-4 border-r whitespace-nowrap">
                            Comentarios:
                        </td>
                        <td class="px-6 py-4 border-r"> {{ $orden->comentarios }} </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
