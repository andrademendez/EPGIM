<x-content>
    <x-slot name="import">
        @if ($open == true)
        @include('pages.users.create')
        @endif
    </x-slot>
    <div class="pb-3 flex items-center justify-between">
        <div>
            <x-input type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        </div>
        <div>
            <x-form.btn-primary wire:click="openModal">Nuevo Usuario</x-form.btn-primary>
        </div>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Correo</x-table.th>
            <x-table.th>Rol</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Interno</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($usuarios as $user)
        <x-table.tr>
            <x-table.td>{{ $user->id }}</x-table.td>
            <x-table.td>{{ $user->name }}</x-table.td>
            <x-table.td>{{ $user->email }}</x-table.td>
            <x-table.td>{{ $user->rol->nombre }}</x-table.td>
            <x-table.td>
                <button type="button" wire:click="updateStatus({{ $user->id }})">
                    @if ($user->status == 1)
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Enable
                    </span>
                    @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        Disable
                    </span>
                    @endif
                </button>


            </x-table.td>
            <x-table.td>
                @if ($user->interno)
                <span>Si</span>
                @else
                <span>No</span>
                @endif
            </x-table.td>

            <x-table.td>
                @if ($user->id != auth()->user()->id)
                <div>
                    <x-nav-link :href="route('user.edit', $user->id)">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </x-nav-link>
                </div>
                @endif
            </x-table.td>

        </x-table.tr>
        @empty
        <tr>
            <td colspan="6">
                <div class="text-center px-10 py-4 font-medium text-gray-600">
                    <span>No hay informacion que mostrar</span>
                </div>
            </td>
        </tr>

        @endforelse

    </x-table.table>

</x-content>
