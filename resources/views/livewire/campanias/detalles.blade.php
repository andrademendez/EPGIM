<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == "Orden de Servicio")
        @include('pages.campanias.detalles.ordenes')
        @else
        @include('pages.campanias.detalles.challenge')
        @endif

        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search id="search" wire:model="search" placeholder="Buscar..." />
        <div class="flex items-center justify-center space-x-2">
            <div>
                <x-button class="space-x-2 rounded py-2 bg-indigo-600" type="button" wire:click="exportExcel">
                    <span>Descargar</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                </x-button>
            </div>

            <div>
                <x-form.select wire:model="searchStatus">
                    <option value="">Estatus</option>
                    <option value="Solicitud">Solicitud</option>
                    <option value="Challenge">Challenge</option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Cerrado">Cerrado</option>
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchUnidad">
                    <option value="">Unidades</option>
                    @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchMedio">
                    <option value="">Medios</option>
                    @foreach ($medios as $medio)
                    <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchUbicacion">
                    <option value="">Ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            @if ($searchStatus || $searchUnidad || $searchMedio || $searchUbicacion )
            <div>
                <x-form.btn-icons type="button" wire:click="resetear">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd"></path>
                    </svg>
                </x-form.btn-icons>
            </div>
            @endif
            <!-- medio, unidad de negocio, ubicacion -->
        </div>
    </div>

    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Costo</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            <x-table.th>Unidad</x-table.th>
            <x-table.th>Archivos</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr class="">
            <x-table.td class="">
                <div class="text-left">
                    <div class="text-xs font-medium text-gray-800">
                        {{ $campania->title }}
                    </div>
                    <div class=" text-xs text-gray-500 lowercase">
                        {{ $campania->cliente->nombre }}
                    </div>
                </div>
            </x-table.td>
            <x-table.td class="">${{ number_format($campania->costoCampania($campania->id), 2) }}</x-table.td>

            <x-table.td>
                @if ($campania->status == 'Confirmado')
                <span class="text-orange-700 bg-orange-100 py-1 px-2 rounded-md hover:text-orange-600 ">
                    {{ $campania->status }}
                </span>
                @elseif ($campania->status == 'Cerrado')
                <span class="text-green-700 bg-green-100 py-1 px-2 rounded-md hover:text-green-800 ">
                    {{ $campania->status }}
                </span>
                @else
                {{ $campania->status }} - {{ $campania->hold }}
                @endif
            </x-table.td>
            <x-table.td class="whitespace-nowrap">
                <div class="flex">
                    <span class="text-xs text-gray-700 font-medium">
                        {{ $campania->formatoMx($campania->start) }} -
                    </span>

                    <span class="text-xs text-gray-500">
                        {{ $campania->formatoMx($campania->end) }}
                    </span>
                </div>
            </x-table.td>

            <x-table.td>{{ $campania->medio->nombre }}</x-table.td>
            <x-table.td class="whitespace-normal">
                @foreach ($campania->espacios as $espacio)
                {{ $espacio->nombre }}
                @endforeach
            </x-table.td>

            <x-table.td class="whitespace-nowrap">
                <span class="text-xs text-gray-500 capitalize">
                    @foreach ($campania->espacios as $espacio)
                    {{ $espacio->unidad->nombre }}
                    ,<br>
                    @endforeach

                </span>
            </x-table.td>
            <x-table.td>
                @include('pages.campanias.detalles._solicitud')
            </x-table.td>

            <x-table.td>
                @include('pages.campanias.detalles._editar')
            </x-table.td>
        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>
    <div class="py-2 flex justify-end">
        {{ $campanias->links() }}
    </div>
</x-content>
