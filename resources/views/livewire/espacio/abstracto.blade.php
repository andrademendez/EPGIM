<div>
    <div class="px-3 ">
        <div class="flex items-center justify-between mb-2">
            <div>
                <x-form.search wire:model="search" />
            </div>
            <div class="flex flex-row space-x-2">
                <div>
                    <x-button class="space-x-2 rounded py-2 bg-purple-600" type="button" wire:click="exportExcel">
                        <span>Descargar</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                        </svg>
                    </x-button>
                </div>
                <div>
                    <x-form.select wire:model="searchUbicacion">
                        <option value="">Ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div>
                    <x-form.select wire:model="searchUnidad">
                        <option value="">Unidad</option>
                        @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div>
                    <x-form.select wire:model="searchTipo">
                        <option value="">Tipo</option>
                        @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                @if ($searchUnidad || $searchTipo )
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
            </div>
        </div>
        <div>
            <x-table.table>
                <x-slot name="theader">
                    <tr>
                        <x-table.th>Nombre</x-table.th>
                        <x-table.th>Referencia</x-table.th>
                        <x-table.th>Clave</x-table.th>
                        <x-table.th>Ubicacion</x-table.th>
                        <x-table.th>Unidad</x-table.th>
                        <x-table.th>Tipo</x-table.th>
                        <x-table.th>Precio</x-table.th>
                        <x-table.th>Cant</x-table.th>
                        <x-table.th>Ocupacion</x-table.th>
                    </tr>
                </x-slot>
                @foreach ($espacios as $espacio)
                <x-table.tr>
                    <x-table.td>{{ $espacio->nombre }}</x-table.td>
                    <x-table.td>{{ $espacio->referencia }}</x-table.td>
                    <x-table.td>{{ $espacio->clave }}</x-table.td>
                    <x-table.td>{{ $espacio->ubicacion }}</x-table.td>
                    <x-table.td>{{ $espacio->unidad }}</x-table.td>
                    <x-table.td>{{ $espacio->tipo }}</x-table.td>
                    <x-table.td>${{ number_format($espacio->precio,2 )}}</x-table.td>
                    <x-table.td>
                        <div class="flex items-center">
                            <button title="Ver eventos" class=" text-indigo-700 px-1 font-medium border-b border-blue-500 hover:bg-indigo-200
                            bg-blue-50 rounded-full" type="button">
                                {{ $espacio->cantidad}}
                            </button>
                        </div>


                    </x-table.td>
                    <x-table.td>
                        @if ($espacio->tipo == "Pantalla digital")
                        {{ round($espacio->total * 100 /12, 2) }} %
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{
                            round($espacio->total * 100 /12, 2) }}%"></div>
                        </div>
                        @elseif ($espacio->total == 1)
                        100 %
                        <progress id="file" max="100" value="1"> 100% </progress>
                        @else
                        0 %
                        @endif
                    </x-table.td>
                </x-table.tr>
                @endforeach
            </x-table.table>
            <div>
                {{ $espacios->links() }}
            </div>
        </div>
    </div>
</div>
