<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == 'Eliminar')
        @include('pages.roles.delete')
        @else
        @include('pages.roles.create')
        @endif

        @endif
    </x-slot>
    <div class="py-2 flex items-center justify-end">
        <x-form.btn-primary class="py-1.5" wire:click="openModal()">
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
