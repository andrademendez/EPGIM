<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="pb-3">
                    <h1 class="text-lg uppercase font-normal">Roles</h1>
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
            </div>
        </div>
    </div>
</div>
