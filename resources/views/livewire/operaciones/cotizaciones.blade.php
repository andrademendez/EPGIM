<div class="bg-white m-2 rounded shadow-lg">
    {{-- Be like water. --}}
    <div class="px-3 py-5">
        <div class="flex justify-start mb-4">
            <div>
                <x-form.search />
            </div>
        </div>
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Id</x-table.th>
                <x-table.th>Folio</x-table.th>
                <x-table.th>Campaña</x-table.th>
                <x-table.th>Cliente</x-table.th>
                <x-table.th>Usuario</x-table.th>
                <x-table.th>Archivo</x-table.th>
                <x-table.th>Estatus</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @foreach ($cotizaciones as $cotizacion)
            <x-table.tr>
                <x-table.td>{{ $cotizacion->id }}</x-table.td>
                <x-table.td>{{ $cotizacion->folio }}</x-table.td>
                <x-table.td>{{ $cotizacion->campania->title }}</x-table.td>
                <x-table.td>{{ $cotizacion->campania->cliente->nombre }}</x-table.td>
                <x-table.td>{{ $cotizacion->campania->user->name }}</x-table.td>
                <x-table.td>
                    <a href="{{ $cotizacion->archivo }}" target="_blank" rel="noopener noreferrer">Archivo.pdf</a>
                </x-table.td>
                <x-table.td>
                    @if ($cotizacion->estatus == true)
                    <span class="text-xs text-green-600">Enviado</span>
                    @else
                    <span>Pendiente</span>
                    @endif
                </x-table.td>
                <x-table.td></x-table.td>
            </x-table.tr>
            @endforeach
        </x-table.table>
    </div>
</div>
