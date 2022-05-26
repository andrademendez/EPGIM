<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if ($open == true)
    @include('pages.operaciones.create')
    @endif
    <div>
        <div class="mb-3 flex justify-end">
            <x-form.btn-primary class="px-4 py-2 rounded" wire:click="openModal">Registrar</x-form.btn-primary>
        </div>
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Id</x-table.th>
                <x-table.th>Nombre</x-table.th>
                <x-table.th>Registro</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @foreach ($ordenes as $act)
            <x-table.tr>
                <x-table.td>{{ $act->id }}</x-table.td>
                <x-table.td>{{ $act->nombre }}</x-table.td>
                <x-table.td>{{ $act->created_at }}</x-table.td>
                <x-table.td>
                    <x-form.icon-option :id=" $act->id " />
                </x-table.td>
            </x-table.tr>
            @endforeach
        </x-table.table>
    </div>
</div>
