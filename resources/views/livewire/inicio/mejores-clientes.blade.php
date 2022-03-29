<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="mb-3 py-2 flex items-center justify-between">
        <div class=" text-lg font-medium text-gray-700 uppercase">
            <span>Clientes frecuentes</span>
        </div>

    </div>
    <div>
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Cliente</x-table.th>
                <x-table.th>Acomulado</x-table.th>
                <x-table.th>Camp</x-table.th>
            </x-slot>
            @foreach ($clientes as $cliente)
            <x-table.tr>
                <x-table.td>{{ $cliente->cliente }}</x-table.td>
                <x-table.td>$ {{ number_format ($cliente->importe , 2)}}</x-table.td>
                <x-table.td>{{ $cliente->total }}</x-table.td>
            </x-table.tr>
            @endforeach
        </x-table.table>
    </div>
</div>
