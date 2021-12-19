<div class="sm:p-2">
    @if ($open == true)
    @if ($action == 'Registrar')
    @include('pages.espacios.create')
    @endif
    @endif

    <div class=" mx-auto ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <div class="pb-3">
                    <h1 class="text-lg uppercase font-medium">Espacios</h1>
                </div>
                <div class="my-2 flex items-center justify-between">
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
                            <x-form.icon-option :id="$espacio->id">
                                <button type="button" class="hover:bg-indigo-300 hover:text-purple-800 py-1 rounded focus:outline-none focus:ring-offset-transparent px-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                            </x-form.icon-option>
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
            </div>
        </div>
    </div>
</div>
