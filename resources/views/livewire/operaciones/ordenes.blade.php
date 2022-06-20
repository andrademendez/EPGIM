<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="m-2 px-2 py-4 bg-white shadow-sm rounded ">
        <div class="flex justify-between items-center mb-3">
            <div>
                <x-form.search />
            </div>
            <div>
                <div class="flex space-x-2">
                    <div>
                        <x-form.select-sm name="" id="">
                            <option value="">Clientes</option>
                            <option value="">Pendientes</option>
                            <option value="">Confirmados</option>
                        </x-form.select-sm>
                    </div>
                    <div>
                        <x-form.select-sm name="" id="">
                            <option value="">Actividad</option>
                            <option value="">Pendientes</option>
                            <option value="">Confirmados</option>
                        </x-form.select-sm>
                    </div>
                    <div>
                        <x-form.select-sm name="" id="">
                            <option value="">Estatus</option>
                            <option value="">Pendientes</option>
                            <option value="">Confirmados</option>
                        </x-form.select-sm>
                    </div>
                </div>
            </div>
        </div>

        <x-table.table>
            <x-slot name="theader">
                <x-table.th class="pl-4">Actividad</x-table.th>
                <x-table.th>Fecha</x-table.th>
                <x-table.th>Campaña</x-table.th>
                <x-table.th>Ubicación</x-table.th>
                <x-table.th>Cliente</x-table.th>
                @if ($usuario->isAdmin() )
                <x-table.th>Usuario</x-table.th>
                @endif
                <x-table.th>Archivo</x-table.th>
                <x-table.th>Url</x-table.th>
                <x-table.th>Comentarios</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @if ($usuario->isAdmin() || $usuario->isAdminSO() )
            @foreach ($ordenes as $os)
            @include('pages.ordenes._table')
            @endforeach
            @else

            @foreach ($ordenes as $os)
            @if ($os->campania->id_user == auth()->user()->id)
            @include('pages.ordenes._table')
            @endif
            @endforeach
            @endif

        </x-table.table>
        <div class="mt-3">
            {{ $ordenes->links() }}
        </div>
    </div>
</div>
