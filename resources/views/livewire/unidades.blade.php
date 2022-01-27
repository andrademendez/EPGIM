<div>
    <div>
        @if ($open == true)
        @include('pages.unidades.create')
        @endif
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
