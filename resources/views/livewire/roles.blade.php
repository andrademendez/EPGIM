<x-content>
    <x-slot name="import">
        @if ($open == true)
        @include('pages.roles.create')
        @endif
    </x-slot>
    <div class="py-2 flex items-center justify-end">
        <x-form.btn-primary class="flex items-center" wire:click="openModal()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nuevo rol
        </x-form.btn-primary>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>ID</x-table.th>
            <x-table.th>NOMBRE</x-table.th>
            <x-table.th>DESCRIPCION</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($roles as $rol)
        <x-table.tr>
            <x-table.td>{{ $rol->id }}</x-table.td>
            <x-table.td>{{ $rol->nombre }}</x-table.td>
            <x-table.td>{{ $rol->descripcion }}</x-table.td>
            <x-table.td>
                <x-form.icon-option :id="$rol->id" />
            </x-table.td>
        </x-table.tr>

        @empty

        @endforelse

    </x-table.table>

</x-content>
