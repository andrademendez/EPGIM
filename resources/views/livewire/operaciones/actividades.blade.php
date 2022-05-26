<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    @if ($open == true)
    @if ($action == "Departamento")
    @include('pages.operaciones.actividades.agregar-depa')
    @elseif($action == "Eliminar")
    @include('pages.operaciones.actividades.confirm')
    @else
    @include('pages.operaciones.create')
    @endif
    @endif
    <div class="mb-3 flex justify-end">
        <x-form.btn-primary class="px-4 py-2 rounded" wire:click="openModal">Registrar</x-form.btn-primary>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Departamentos</x-table.th>

            <x-table.th></x-table.th>
        </x-slot>
        @foreach ($actividades as $act)
        <x-table.tr>
            <x-table.td>{{ $act->id }}</x-table.td>
            <x-table.td class="text-sm">{{ $act->nombre }}</x-table.td>
            <x-table.td>
                <ul class="list-none text-sm">
                    @foreach ($act->departamentos as $depart)
                    <li>
                        <div class="flex items-center justify-between space-y-1 ">
                            <span>{{ $depart->nombre }}</span>
                            <button type="button" wire:click="quitarDepartamento({{ $act->id }}, {{ $depart->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </x-table.td>
            <x-table.td class="flex justify-end px-5">
                <x-form.icon-option :id=" $act->id ">
                    <x-form.btn-icons wire:click="openAddDepa({{ $act->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                        </svg>
                    </x-form.btn-icons>
                </x-form.icon-option>
            </x-table.td>
        </x-table.tr>
        @endforeach
    </x-table.table>
</div>
