<div class="sm:p-2">
    @if ($open == true)
    @if ($action == 'Registrar')
    @include('pages.clientes.create')
    @endif
    @endif
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <div class="pb-3">
                    <h1 class="text-lg font-normal uppercase">Clientes</h1>
                </div>
                <div class="pb-3 flex items-center justify-between">
                    <div>
                        <x-form.search type="search" name="" id="" placeholder="Buscar..." />
                    </div>
                    <div class="flex ">
                        <x-form.btn-primary wire:click="openModal()">Registrar</x-form.btn-primary>
                    </div>
                </div>
                <x-table.table>
                    <x-slot name="theader">
                        <x-table.th>ID</x-table.th>
                        <x-table.th>Nombre</x-table.th>
                        <x-table.th>Contácto</x-table.th>
                        <x-table.th>Teléfono</x-table.th>
                        <x-table.th>Correo</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    @forelse ($clientes as $client)
                    <x-table.tr>
                        <x-table.td>{{ $client->id }}</x-table.td>
                        <x-table.td>{{ $client->nombre }}</x-table.td>
                        <x-table.td>{{ $client->contacto }}</x-table.td>
                        <x-table.td>{{ $client->telefono }}</x-table.td>
                        <x-table.td>{{ $client->email }}</x-table.td>
                        <x-table.td>
                            <x-form.icon-option :id="$client->id">
                                <button type="button" class="focus:outline-none focus:ring-offset-transparent px-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                </button>
                            </x-form.icon-option>
                        </x-table.td>
                    </x-table.tr>
                    @empty

                    @endforelse
                </x-table.table>
            </div>
        </div>
    </div>
</div>