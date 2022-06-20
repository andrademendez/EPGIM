<div class="py-4 m-2 bg-white" id="areaimpresion">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="px-5 flex justify-end">
        <a href="{{ route('campania.detalles') }}"
            class="px-1 py-2 border-b border-gray-300 hover:border-gray-400 flex space-x-2 items-center uppercase text-xs">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Volver a campañas</span>
        </a>
    </div>
    <div class="flex items-center justify-between p-5 ">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/gim-1.png') }}" alt="" class="h-16">
            <hr>
            <span class="font-serif uppercase">Grupo Inmobiliario Monterrey</span>
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
    <div class=" px-5 pt-4">
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Municipio</x-table.th>
                <x-table.th>Unidad</x-table.th>
                <x-table.th>Medio</x-table.th>
                <x-table.th>Slot</x-table.th>
                <x-table.th>Clave</x-table.th>
                <x-table.th>Referencia</x-table.th>
                <x-table.th>Medida</x-table.th>
                <x-table.th>Precio Lista</x-table.th>
            </x-slot>
            @foreach ($campanias->espacios as $espacio)
            <x-table.tr>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->unidad->ciudad->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->unidad->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $campanias->medio->nombre }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->cantidad }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->clave }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->referencia }}</x-table.td>
                <x-table.td class="text-xs py-3 uppercase">{{ $espacio->medidas }}</x-table.td>
                <x-table.td class="text-sm">${{ number_format($espacio->diasCosto($espacio->id, $campanias->id), 2) }}
                </x-table.td>
                {{-- <x-table.td class="text-sm">${{ number_format($espacio->precio) }}.00</x-table.td> --}}
            </x-table.tr>
            @endforeach

            <x-table.tr>
                <x-table.td class="font-bold text-base text-right" colspan="6">Total</x-table.td>
                <x-table.td colspan="6" class="px-4">
                    <div class="text-right text-sm font-medium">
                        <span>${{ number_format($campanias->costoCampania($campanias->id), 2) }}</span>

                    </div>
                </x-table.td>
            </x-table.tr>
        </x-table.table>
    </div>
    <div class="flex justify-end space-x-7 px-5 pt-4">

        @if (isset($campanias->cotizacion->folio))
        <div>
            <button wire:click="enviarEmail({{ $campanias->id }})"
                class="px-3 py-2 bg-gray-700 text-white flex space-x-3 items-center uppercase rounded" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                </svg>
                <span>Enviar a correo</span>
            </button>
        </div>
        @else
        <div>
            <button type="button" wire:click="store"
                class="px-3 py-2 bg-gray-800 text-white flex space-x-2 items-center uppercase rounded hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                </svg>
                <span>Guardar</span>
            </button>
        </div>
        @endif
    </div>
</div>
