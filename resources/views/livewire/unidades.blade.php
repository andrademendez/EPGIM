<div class="py-3">
    @if ($open == true)
    @if ($action == 'Registrar')
    @include('pages.unidades.create')
    @endif
    @endif
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="pb-3">
                    <h1 class="text-lg font-normal uppercase">Unidades</h1>
                </div>
                <div class="pb-3 flex items-center justify-between">
                    <div>
                        <x-form.search type="search" name="buscar" wire:model="buscar" id="buscar" placeholder="Buscar..." />
                    </div>
                    <div>
                        <x-form.btn-primary wire:click="openModal()">Registrar</x-form.btn-primary>
                    </div>
                </div>

                <x-table.table>
                    <x-slot name="theader">
                        <x-table.th>ID</x-table.th>
                        <x-table.th>Nombre</x-table.th>
                        <x-table.th>Ciudad</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    @forelse ($unidades as $unidad)
                    <x-table.tr>
                        <x-table.td>{{ $unidad->id }}</x-table.td>
                        <x-table.td>{{ $unidad->nombre }}</x-table.td>
                        <x-table.td>{{ $unidad->ciudad->nombre }}</x-table.td>
                        <x-table.td>
                            <x-form.icon-option :id="$unidad->id" />
                        </x-table.td>
                    </x-table.tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <div class="text-center px-10 py-4 font-medium text-gray-600">
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
