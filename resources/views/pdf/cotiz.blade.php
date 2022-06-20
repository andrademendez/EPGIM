<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotizacion - GIM</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div>
        <div class="flex items-center justify-between p-5 ">
            <div class="flex flex-col items-center">
                <img src="https://ep.grupogim.com.mx/images/share/logo.jpg" alt="" class="h-16">
            </div>
            <div class="space-y-3 flex flex-col justify-start">
                <div class="flex flex-row items-center space-x-3">
                    <h1 class="font-bold">No. Co:</h1>
                    @if ( isset($campanias->cotizacion->folio))
                    <span>{{ $campanias->cotizacion->folio }}</span>
                    @endif
                </div>
                <div class="flex flex-row items-center space-x-3">
                    <h1 class="font-bold">Fecha:</h1>
                    @if ( isset($campanias->cotizacion->created_at))

                    <span>{{ $campanias->dateFormato($campanias->cotizacion->created_at)}}</span>
                    @else
                    <span>
                        <?php $fechaActual = date('d M Y'); echo $fechaActual; ?>
                    </span>

                    @endif


                </div>
            </div>
        </div>
        <div class="space-y-3 px-5 pt-4">
            <div class="flex space-x-4 items-center">
                <h1 class="font-bold">Empresa: </h1>
                <span class="lowercase">{{ $campanias->cliente->nombre }}</span>
            </div>
            <div class="flex space-x-4 items-center">
                <h1 class="font-bold">Temporaridad:</h1>
                <span class="lowercase">{{ $campanias->formatoMx($campanias->start) }} - {{
                    $campanias->formatoMx($campanias->end) }} </span>
            </div>
        </div>
    </div>
    <div class=" px-5 py-3 mt-3">
        <table class="table-auto">
            <thead class="" col>
                <x-table.tr class="border-t">
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Municipio</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Unidad</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Medio</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Slot</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Clave</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Referencia</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Medida</th>
                    <th scope="col" class="py-3 px-3 text-gray-800 text-xs uppercase">Precio Lista</th>
                </x-table.tr>
            </thead>
            @foreach ($campanias->espacios as $espacio)
            <x-table.tr>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->unidad->ciudad->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase whitespace-nowrap">{{ $espacio->unidad->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $campanias->medio->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->cantidad }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase whitespace-nowrap">{{ $espacio->clave }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->referencia }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->medidas }}</x-table.td>
                <x-table.td class="text-sm">${{ number_format($espacio->diasCosto($espacio->id, $campanias->id), 2) }}
            </x-table.tr>
            @endforeach

            <x-table.tr>
                <x-table.td class="font-bold text-base text-right" colspan="6">Total</x-table.td>
                <x-table.td colspan="6" class="px-3 whitespace-nowrap">
                    <div class="text-right text-sm font-medium">
                        <span>${{ number_format($campanias->costoCampania($campanias->id), 2) }}</span>
                    </div>
                </x-table.td>
            </x-table.tr>
        </table>
    </div>
    <div class=" px-5 bottom-0 left-0 absolute text-sm text-gray-600">
        <span class="block ">Precios expresados en MN</span>
        <span class="block ">Precios al
            {{ $campanias->formatoMx($campanias->cotizacion->created_at) }}
        </span>
        <span class="block ">Tarifas mensuales</span>
        <span class="block ">El precio reflejado NO incluye IVA</span>
        <span class="block ">Se requiere anticipo del 50%</span>
    </div>
</body>

</html>
