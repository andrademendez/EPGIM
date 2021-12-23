<x-content>
    <x-slot name="import">
        @if ($open == true)
        @include('pages.espacios.create')
        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        <div>
            <x-form.btn-primary wire:click="openModal()">
                <span class="pl-1">Agregar</span>
            </x-form.btn-primary>
        </div>

    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Referencia</x-table.th>
            <x-table.th>Medidas</x-table.th>
            <x-table.th>Cantidad</x-table.th>
            <x-table.th>Precio</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Unidad</x-table.th>
            <x-table.th>Tipo</x-table.th>
            <x-table.th>Ubicación</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($espacios as $espacio)
        <x-table.tr>
            <x-table.td>{{ $espacio->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->referencia }}</x-table.td>
            <x-table.td>{{ $espacio->medidas }}</x-table.td>
            <x-table.td>{{ $espacio->cantidad }}</x-table.td>
            <x-table.td>{{ $espacio->precio }}</x-table.td>
            <x-table.td>{{ $espacio->estatus }}</x-table.td>
            <x-table.td>{{ $espacio->unidad->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->tipo->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->ubicacion->nombre }}</x-table.td>
            <x-table.td>
                <div>
                    <x-nav-link :href="route('espacios.edit', $espacio->id)">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </x-nav-link>
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

</x-content>
