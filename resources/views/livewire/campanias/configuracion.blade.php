<div class="px-3">

    <div class="flex justify-between">
        <div>
            <x-form.search wire:model="search" />
        </div>
        <div class="flex items-center space-x-2">
            <div>
                <x-button class="space-x-2 rounded py-2 bg-green-600" type="button" wire:click="exportExcel">
                    <span>Descargar</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                </x-button>
            </div>
            <x-form.select wire:model="estatus">
                <option value="">Campañas</option>
                <option value="activo">Activos</option>
                <option value="pendiente">Pendientes</option>
                <option value="terminado">Vencidos</option>
            </x-form.select>
        </div>
    </div>
    <div class=" pt-2 ">
        <x-table.table>
            <x-slot name="theader">
                <tr>
                    <x-table.th>Titulo</x-table.th>
                    <x-table.th>Fecha</x-table.th>
                    <x-table.th>Estatus</x-table.th>
                    <x-table.th>Medio</x-table.th>
                    <x-table.th>Usuario</x-table.th>
                    <x-table.th>Costo</x-table.th>
                    <x-table.th>Espacios</x-table.th>
                </tr>
            </x-slot>
            @foreach ($campanias as $campania)
            <x-table.tr>
                <x-table.td>{{ $campania->title }}</x-table.td>
                <x-table.td>
                    <div class="flex flex-col ">
                        <span class="text-xs text-gray-700 font-medium">
                            {{ $campania->formatoMx($campania->start) }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $campania->formatoMx($campania->end) }}
                        </span>
                    </div>
                </x-table.td>
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
                <x-table.td>
                    {{ $campania->medio->nombre }}
                </x-table.td>
                <x-table.td>
                    <div class="flex flex-col">
                        <span class="text-gray-800 font-medium  lowercase">{{ $campania->user->email }}</span>
                        <span>{{ $campania->user->name }}</span>
                    </div>

                </x-table.td>
                <x-table.td>
                    {{ number_format($campania->costoCampania($campania->id), 2) }}
                </x-table.td>
                <x-table.td>
                    @foreach ($campania->espacios as $espacio)
                    <div class="flex flex-col mb-1">
                        <span class="text-xs font-medium text-gray-700">
                            {{ $espacio->nombre }}
                        </span>
                        <span class="text-xs text-gray-500 capitalize">
                            {{ $espacio->unidad->nombre }}
                        </span>
                    </div>
                    @endforeach
                </x-table.td>
            </x-table.tr>
            @endforeach
        </x-table.table>
        <div>
            {{ $campanias->links() }}
        </div>
    </div>

</div>
