<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == 'registrar')
        @include('pages.users.create')
        @else
        @include('pages.users.delete')
        @endif
        @endif
    </x-slot>
    <div class="pb-3  flex items-center justify-between">
        <div>
            <x-input type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        </div>

        <div>
            <x-form.btn-primary wire:click="openModal" class="py-1.5">
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
                    <span class="p-1 inline-flex rounded-full bg-green-100 text-green-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                            </path>
                        </svg>
                    </span>
                    @else
                    <span class="p-1 inline-flex rounded-full bg-red-100 text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                    @endif
                </button>


            </x-table.td>
            <x-table.td>
                @if ($user->interno)
                <span class="p-1 inline-flex rounded-full bg-indigo-100 text-indigo-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </span>
                @else
                <span class="p-1 inline-flex rounded-full bg-red-100 text-red-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </span>
                @endif
            </x-table.td>

            <x-table.td>
                @if ($user->id != auth()->user()->id)
                <div class="flex items-center space-x-2">

                    <a href="{{ route('user.edit', $user->id) }}" title="Editar contenido" class="text-indigo-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </a>
                    <button wire:click="openDelete({{ $user->id }})" title="Eliminar" class="text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

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
    <div>
        {{ $usuarios->links() }}
    </div>
</x-content>
