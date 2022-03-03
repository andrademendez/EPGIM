<div>
    <x-table.table>
        <x-slot name=theader>
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Espacios</x-table.th>
        </x-slot>
        @foreach ($campanias as $campania)
        <x-table.tr>
            <x-table.td>
                {{ $campania->id }}
            </x-table.td>
            <x-table.td>
                <div class="flex flex-col">
                    <span class="text-gray-700">{{ $campania->title }}</span>
                    <span class="text-xs text-gray-500">{{ $campania->cliente->nombre }}</span>
                </div>
            </x-table.td>
            <x-table.td>{{ $campania->status }}</x-table.td>
            <x-table.td>
                <div class="flex flex-col">
                    <span>{{ $campania->formatoMx($campania->start) }}</span>
                    <span>{{ $campania->formatoMx($campania->end) }}</span>
                </div>
            </x-table.td>
            <x-table.td>
                @foreach ($campania->espacios as $espacio)
                <div class="flex flex-col">
                    <span class="text-gray-700">{{ $espacio->nombre }}</span>
                    <span class="text-xs text-gray-500">{{ $espacio->referencia }}</span>
                </div>

                @endforeach
            </x-table.td>
        </x-table.tr>
        @endforeach
    </x-table.table>
    <div>
        {{ $campanias->links() }}
    </div>
</div>
