<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == 'Registrar')
        @include('pages.espacios.create')
        @else
        @include('pages.roles.delete')
        @endif

        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        <div class="flex items-center justify-between space-x-2">
            <div>
                <x-button class="space-x-2 rounded py-2 bg-indigo-600" type="button" wire:click="exportExcel">
                    <span>Exportar</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                </x-button>
            </div>
            <div>
                <x-form.select name="" id="searchTipo" wire:model="searchTipo">
                    <option value="">Tipo</option>
                    @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select name="" id="" wire:model="search_unidad">
                    <option value="">Unidades</option>
                    @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select name="" id="searchUbicacion" wire:model="searchUbicacion">
                    <option value="">Ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            @if ($search_unidad || $searchTipo || $searchUbicacion)
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
            <x-form.btn-primary class="py-2 rounded" wire:click="openModal()">
                <div class="flex items-center space-x-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Registrar</span>
                </div>
            </x-form.btn-primary>

        </div>

    </div>

    <x-table.table>

        <x-slot name="theader">
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Referencia</x-table.th>
            <x-table.th>Medidas</x-table.th>
            <x-table.th>Cant</x-table.th>
            <x-table.th>Clave</x-table.th>
            <x-table.th>Precio</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Unidad</x-table.th>
            <x-table.th>Tipo</x-table.th>
            <x-table.th>Ubicación</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($espacios as $espacio)
        <x-table.tr>
            <x-table.td>{{ $espacio->id }}</x-table.td>
            <x-table.td>{{ $espacio->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->referencia }}</x-table.td>
            <x-table.td>{{ $espacio->medidas }}</x-table.td>
            <x-table.td>{{ $espacio->cantidad }}</x-table.td>
            <x-table.td>{{ $espacio->clave }}</x-table.td>
            <x-table.td>${{ number_format($espacio->precio) }}.00</x-table.td>
            <x-table.td>
                @if ($espacio->estatus)
                <button type="button" wire:click="deshabilitar({{ $espacio->id }})"
                    class="text-green-700 bg-green-100  hover:text-green-600 rounded-full p-1 text-xs">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                @else
                <button type="button" wire:click="deshabilitar({{ $espacio->id }})"
                    class="text-red-700 bg-red-100 hover:text-red-600 p-1 rounded-full text-xs">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                @endif
            </x-table.td>
            <x-table.td>{{ $espacio->unidad->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->tipo->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->ubicacion->nombre }}</x-table.td>
            <x-table.td>
                <div class="flex items-center justify-center">
                    <x-nav-link :href="route('espacios.edit', $espacio->id)" class="text-indigo-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </x-nav-link>
                    <button class="mx-2  text-red-500 focus:outline-none focus:ring-offset-transparent"
                        wire:click="openDelete( {{ $espacio->id }})">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </x-table.td>
        </x-table.tr>
        @empty
        <tr>
            <td colspan="9">
                <div class="text-center px-10 py-3 font-medium text-gray-500">
                    <span>No hay informacion que mostrar</span>
                </div>
            </td>
        </tr>
        @endforelse
    </x-table.table>

    <div class="">
        {{ $espacios->links() }}
    </div>
</x-content>
