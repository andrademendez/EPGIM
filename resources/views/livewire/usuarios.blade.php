<div class="py-3">
    @if ($open == true)
    @if ($action == 'Registrar')
    @include('pages.users.create')
    @elseif($action == 'Actualizar')
    @include('pages.users.create')
    @endif
    @endif
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="pb-3 flex items-center justify-between">
                    <div class="flex ">
                        <h1 class="text-lg font-normal uppercase">Usuarios</h1>
                        <button class="text-xs uppercase text-blue-700 ml-2 focus:outline-none " wire:click="openModal">Nuevo Usuario</button>
                    </div>
                    <div>
                        <x-input type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
                    </div>
                </div>
                <x-table.table>
                    <x-slot name="theader">
                        <x-table.th>Id</x-table.th>
                        <x-table.th>Nombre</x-table.th>
                        <x-table.th>Correo</x-table.th>
                        <x-table.th>Rol</x-table.th>
                        <x-table.th>Estatus</x-table.th>
                        <x-table.th></x-table.th>
                    </x-slot>
                    @forelse ($usuarios as $user)
                    <x-table.tr>
                        <x-table.td>{{ $user->id }}</x-table.td>
                        <x-table.td>{{ $user->name }}</x-table.td>
                        <x-table.td>{{ $user->email }}</x-table.td>
                        <x-table.td>{{ $user->rol->nombre }}</x-table.td>
                        <x-table.td>
                            @if ($user->status == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Enable
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Disable
                            </span>
                            @endif

                        </x-table.td>
                        <x-table.td>
                            @if ($user->id != auth()->user()->id)
                            <x-form.icon-option :id="$user->id" />
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
            </div>
        </div>
    </div>
</div>
