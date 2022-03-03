<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == 'Registrar')
        @include('pages.clientes.create')
        @elseif ($action == 'Eliminar')
        @include('pages.clientes.confirm')
        @endif
        @include('pages.clientes.create')
        @endif

    </x-slot>
    <div class="pb-3 flex items-center justify-between">
        <div>
            <x-form.search type="search" name="" id="" placeholder="Buscar..." />
        </div>

        <div class="flex flex-row items-center space-x-2">
            <div>
                <x-form.select wire:model="searchUser">
                    <option value="">Usuarios</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.btn-primary class="py-2 rounded" wire:click="openModal()">
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

        </div>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>ID</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Contácto</x-table.th>
            <x-table.th>Teléfono</x-table.th>
            <x-table.th>Correo</x-table.th>
            <x-table.th>Usuario</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($clientes as $client)
        <x-table.tr>
            <x-table.td>{{ $client->id }}</x-table.td>
            <x-table.td>{{ $client->nombre }}</x-table.td>
            <x-table.td>{{ $client->contacto }}</x-table.td>
            <x-table.td>{{ $client->telefono }}</x-table.td>
            <x-table.td>
                <a href="mailto:{{ $client->email  }}" target="_blank">{{ $client->email }}</a>
            </x-table.td>
            <x-table.td>
                {{ $client->user->name }}
            </x-table.td>
            <x-table.td>
                <x-form.icon-option :id="$client->id" />
            </x-table.td>
        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>

</x-content>
