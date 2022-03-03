<div>
    <div>
        @if ($open == true)
        @include('pages.tipoespacio.create.ciudad')
        @endif
    </div>
    <div class="pb-3 flex items-center justify-between">
        <div>
            <x-input wire:model="buscar" type="search" name="buscar" placeholder="Buscar..." />
        </div>
        <div class="">
            <x-form.btn-primary class="py-1.5" wire:click="openModal()">Registrar</x-form.btn-primary>
        </div>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>ID</x-table.th>
            <x-table.th>Clave</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($ciudades as $city)
        <x-table.tr>
            <x-table.td>{{ $city->id }}</x-table.td>
            <x-table.td>{{ $city->clave }}</x-table.td>
            <x-table.td>{{ $city->nombre }}</x-table.td>
            <x-table.td>
                <x-form.icon-option :id="$city->id" />
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
    <div class="">
        {{ $ciudades->links() }}
    </div>

</div>
