<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @if ($open == true)
    @if ($action != 'Usuario')
    @include('pages.departamentos.create')
    @else
    @include('pages.departamentos.add-user')
    @endif
    @endif
    <div class="px-3 py-5">
        <div class="mb-3 flex justify-end">
            <x-form.btn-primary class="py-2 px-4 rounded" wire:click="openModal">Registrar</x-form.btn-primary>
        </div>
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Usuarios</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @foreach ($departamentos as $depar)
            <x-table.tr>
                <x-table.td>{{ $depar->id }}</x-table.td>
                <x-table.td>
                    <div class="flex flex-col">
                        <div class="text-sm text-gray-800">
                            {{ $depar->nombre }}
                        </div>
                        <div class="text-xs text-gray-600 ">
                            {{ $depar->descripcion }}
                        </div>
                    </div>
                </x-table.td>
                <x-table.td>
                    <div class="w-full flex flex-row">
                        <ul class="list-none list-disc">
                            @foreach ($depar->users as $user)
                            <li>
                                <div class="flex flex-row justify-between items-center space-x-4 py-1">
                                    <span>
                                        {{ $user->name }}
                                    </span>
                                    <x-form.btn-icons wire:click="removeUser({{ $user->id }}, {{ $depar->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z" />
                                        </svg>
                                    </x-form.btn-icons>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </x-table.td>
                <x-table.td>
                    <div>
                        <x-form.btn-icons wire:click="openAddUser({{ $depar->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </x-form.btn-icons>
                    </div>
                </x-table.td>
            </x-table.tr>
            @endforeach

        </x-table.table>
    </div>
</div>
