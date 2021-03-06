<div>
    <div>
        @if ($open == true)
        @include('pages.tipoespacio.create.tipo')
        @endif
    </div>
    <div class="pb-3 flex items-center justify-between ">
        <div>
            <x-form.search type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        </div>
        <div class="">
            <x-form.btn-primary class="text-xs uppercase text-blue-700 ml-2 py-1.5 focus:outline-none"
                wire:click="openModal()">Registrar</x-form.btn-primary>
        </div>

    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>ID</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($tipos as $tipo)
        <x-table.tr>
            <x-table.td>{{ $tipo->id }}</x-table.td>
            <x-table.td>{{ $tipo->nombre }}</x-table.td>
            <x-table.td>
                <x-form.icon-option :id="$tipo->id" />
            </x-table.td>
        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>
    <div class="py-2 flex justify-end">
        {{ $tipos->links() }}
    </div>
</div>
