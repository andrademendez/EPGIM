<div>
    <div class="mb-3">
        <x-form.select-sm wire:model="filterFecha">
            <option value="todo">Todo</option>
            <option value="activas">Activas</option>
            <option value="pendientes">Pendientes</option>
            <option value="vencidas">Vencidas</option>
        </x-form.select-sm>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Campaña</x-table.th>
            <x-table.th>Usuario</x-table.th>
            <x-table.th>Estatus</x-table.th>
        </x-slot>
        @foreach ($campanias as $campania)
        <x-table.tr>
            <x-table.td>{{ $campania->title }}</x-table.td>
            <x-table.td>{{ $campania->userName }}</x-table.td>
            <x-table.td>
                @if ($campania->status == 'Solicitud')
                <x-badge class="text-[#13bfec] bg-[#daf5fc]">{{ $campania->status }}</x-badge>
                @elseif ($campania->status == 'Challenge')
                <x-badge class="text-[#feff00] bg-yellow-500">{{ $campania->status }}</x-badge>
                @elseif ($campania->status == 'Confirmado')
                <x-badge class="text-[#f3a40c] bg-[#fcefd6]">{{ $campania->status }}</x-badge>
                @else
                <x-badge class="text-[#dfdbd4] bg-[#344c61]">{{ $campania->status }}</x-badge>
                @endif

            </x-table.td>
        </x-table.tr>
        @endforeach
    </x-table.table>
    <div>
        {{-- {{ $campaniasd->links() }} --}}
    </div>
</div>
