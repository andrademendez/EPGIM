<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="mb-3 py-2 flex items-center justify-between">
        <div class=" text-lg font-medium text-gray-700 uppercase">
            <span>Espacios más rentados</span>
        </div>
        <div>

            <button wire:click="exportExcel"
                class="flex items-center text-xs focus:outline-none font-medium justify-between space-x-2 bg-indigo-600 text-gray-700 rounded py-1 px-2 hover:bg-indigo-700 text-white"
                title="Exportar datos">
                <span>Descargar</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="">
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Clave</x-table.th>
                <x-table.th class="">
                    <div class="flex items-center space-x-1">
                        <select wire:model="searchUnidad"
                            class="py-1 pl-2 pr-5 border-none uppercase font-medium rounded focus:outline-none focus:border-none sm:text-xs">
                            <option value="">Unidad</option>
                            @foreach ($unidades as $uds)
                            <option value="{{ $uds->nombre }}">{{ $uds->nombre }}</option>
                            @endforeach
                        </select>

                        @if ($searchUnidad)
                        <button class="text-indigo-700" wire:click="all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                        @endif

                    </div>
                </x-table.th>
                <x-table.th>Importe</x-table.th>
                <x-table.th title="Campaña Total">Camp. T</x-table.th>
            </x-slot>
            @foreach ($espacios as $espacio)
            <x-table.tr>
                <x-table.td>{{ $espacio->nombre }}</x-table.td>
                <x-table.td>{{ $espacio->clave }}</x-table.td>
                <x-table.td class="">{{ $espacio->unidad }}</x-table.td>
                <x-table.td>$ {{ number_format($espacio->importe, 2) }}</x-table.td>
                <x-table.td>{{ $espacio->total }}</x-table.td>

            </x-table.tr>

            @endforeach
        </x-table.table>
    </div>
</div>
