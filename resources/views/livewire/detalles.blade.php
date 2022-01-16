<x-content>
    <x-slot name="import">
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search id="search" wire:model="search" placeholder="Buscar..." />
        <div>
            <x-form.btn-primary wire:click="openModal()">
                <span class="pl-1">Agregar</span>
            </x-form.btn-primary>
        </div>
    </div>

    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr>
            <x-table.td>
                <div class="">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $campania->title }}
                    </div>
                    <div class="text-xs text-gray-500 uppercase">
                        {{ $campania->cliente->nombre }}
                    </div>
                </div>
            </x-table.td>

            <x-table.td>{{ $campania->status }} - {{ $campania->hold }}</x-table.td>
            <x-table.td>
                <span class="text-sm">{{ $campania->dateFormato($campania->start) }} - {{ $campania->dateFormato($campania->end) }}</span>
            </x-table.td>
            <x-table.td>{{ $campania->medio->nombre }}</x-table.td>
            <x-table.td class="whitespace-normal">
                @forelse ($campania->espacios as $espacio)
                {{ $espacio->nombre }}
                @if ($loop->remaining)
                ,
                @endif
                @empty
                <span>No has asignado ningun espacio</span>
                @endforelse
            </x-table.td>

            <x-table.td>
                <x-form.icon-option :id="$campania->id">
                </x-form.icon-option>
            </x-table.td>

        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>

</x-content>
