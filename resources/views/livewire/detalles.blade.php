<x-content>
    <x-slot name="import">
    </x-slot>

    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Inicio</x-table.th>
            <x-table.th>Termino</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Hold</x-table.th>
            <x-table.th>Cliente</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr>
            <x-table.td>{{ $campania->title }}</x-table.td>
            <x-table.td class="whitespace-nowrap">{{ $campania->dateFormato($campania->start) }}</x-table.td>
            <x-table.td class="whitespace-nowrap">{{ $campania->dateFormato($campania->end) }}</x-table.td>
            <x-table.td>{{ $campania->status }}</x-table.td>
            <x-table.td>{{ $campania->hold }}</x-table.td>
            <x-table.td>{{ $campania->cliente->nombre }}</x-table.td>
            <x-table.td>{{ $campania->medio->nombre }}</x-table.td>
            <x-table.td class="whitespace-normal">

                @forelse ($campania->espacios as $espacio)
                {{ $espacio->nombre }}
                @if ($loop->remaining)
                ,
                @endif
                @empty

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
