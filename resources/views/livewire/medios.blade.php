<div class="py-3">
    <x-slot name="title">Medios</x-slot>
    <x-slot name="titlePage">Medios </x-slot>

    @if ($open == true)
    @include('pages.medios.create')
    @endif
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200 max-w-2xl w-full">
                <div class="pb-3 flex items-center justify-between">
                    <div>
                        <x-form.search type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
                    </div>
                    <div class="">
                        <x-form.btn-primary wire:click="openModal">Registrar</x-form.btn-primary>
                    </div>
                </div>

                <x-table.table>
                    <x-slot name="theader">
                        <x-table.th>ID</x-table.th>
                        <x-table.th>NOMBRE</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    @forelse ($medios as $medio)
                    <x-table.tr>
                        <x-table.td>{{ $medio->id }}</x-table.td>
                        <x-table.td>{{ $medio->nombre }}</x-table.td>
                        <x-table.td>
                            <x-form.icon-option :id="$medio->id" />
                        </x-table.td>
                    </x-table.tr>
                    @empty
                    <tr>
                        <td colspan="3">
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
