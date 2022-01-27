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
