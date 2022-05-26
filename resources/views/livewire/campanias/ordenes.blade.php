<div>
    <div class="m-3 py-2">

        <section class="">
            <div class="py-2 mb-3 flex justify-end">
                <x-form.btn-primary class="py-2 px-4 rounded" wire:click="openModal">
                    Registrar
                </x-form.btn-primary>
            </div>
            <x-table.table>
                <x-slot name="theader">
                    <x-table.th>Ubicacion</x-table.th>
                    <x-table.th>Actividad</x-table.th>
                    <x-table.th>Tipo de Orden</x-table.th>
                    <x-table.th>Fecha</x-table.th>
                    <x-table.th>Horario</x-table.th>
                    <x-table.th>URL</x-table.th>
                    <x-table.th>Archivo</x-table.th>
                    <x-table.th>Comentarios</x-table.th>
                    <x-table.th>Estatus</x-table.th>
                </x-slot>
                @foreach ($campanias as $orden)
                <x-table.tr>
                    <x-table.td>{{ $orden->ubicacion }}</x-table.td>
                    <x-table.td>{{ $orden->actividad->nombre }}</x-table.td>
                    <x-table.td>{{ $orden->tipo_orden->nombre }}</x-table.td>
                    <x-table.td>{{ $orden->fecha_inicio }}</x-table.td>
                    <x-table.td>{{ $orden->horario_inicio }}</x-table.td>
                    <x-table.td>
                        <a href="{{ $orden->url }}" target="_blank" rel="noopener noreferrer"
                            class="uppercase text-indigo-500">Ver material</a>
                    </x-table.td>
                    <x-table.td>{{ $orden->horario_inicio }}</x-table.td>
                </x-table.tr>
                @endforeach

            </x-table.table>

        </section>
    </div>
    @if ($open == true)
    @include('pages.campanias.detalles.create-orden')
    @endif
</div>
