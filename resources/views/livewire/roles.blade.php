<x-content>
    <x-slot name="import">
    </x-slot>
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
