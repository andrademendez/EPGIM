<x-table.tr>
    <x-table.td class="pl-4">
        <div class="flex items-center">
            <h1 class="text-sm text-gray-700">{{ $os->actividad->nombre }}</h1>
        </div>

    </x-table.td>
    <x-table.td>
        <div>

            @if ($os->tipo_orden_servicios_id == 1)
            {{ $os->fecha_inicio }} - {{ $os->horario_inicio }}
            @else
            {{ $os->fecha_inicio }} - {{ $os->fecha_fin }} <br>
            {{ $os->horario_inicio }} - {{ $os->horario_fin }}
            @endif
        </div>
    </x-table.td>
    <x-table.td>{{ $os->campania->title }}</x-table.td>
    <x-table.td>{{ $os->espacios($os->ubicacion)->nombre }}</x-table.td>
    <x-table.td>{{ $os->campania->cliente->nombre }}</x-table.td>
    @if ($usuario->isAdmin() )
    <x-table.td>{{ $os->campania->user->name }}</x-table.td>
    @endif
    <x-table.td>
        <a href="{{ $os->archivo }}" target="_blank" rel="noopener noreferrer" class="text-indigo-500">Document.pdf</a>
    </x-table.td>
    <x-table.td>
        @if ($os->tipo_orden_servicios_id == 1)
        <a href="{{ $os->url }}" target="_blank" rel="noopener noreferrer" class="uppercase text-indigo-500">Abrir</a>
        @endif
    </x-table.td>
    <x-table.td> {{ $os->comentarios }}</x-table.td>
    <x-table.td>
        <div class="flex items-center space-x-2">
            <a href="{{ route('ordenes.show', $os->id) }}" class="text-indigo-600" type="button" title="Detalles">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
        </div>
    </x-table.td>
</x-table.tr>
