<div class="py-2">
    @if ($open == true)
    @include('pages.ciudad.create')
    @endif
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200">
                <div class="pb-2">
                    <h1 class="text-lg font-normal uppercase">Ciudades</h1>
                </div>
                <div class="pb-3 flex items-center justify-between">
                    <div>
                        <x-input wire:model="buscar" type="search" name="buscar" id="buscar" placeholder="Buscar..." />
                    </div>
                    <div class="">
                        <x-form.btn-primary wire:click="openModal()">Registrar</x-form.btn-primary>
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
        </div>
    </div>
</div>
