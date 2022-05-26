<div>
    @if ($open == true)
    @include('pages.clientes.razon.create')
    @endif
    <div class="m-2 px-3 py-4 rounded-lg shadow-lg">
        <div class="pb-4 flex justify-end">
            <x-form.btn-primary class="py-2 rounded" wire:click="openModal()">Registrar</x-form.btn-primary>
        </div>
        <div>
            <x-table.table>
                <x-slot name="theader">
                    <x-table.th>ID</x-table.th>
                    <x-table.th>Razón Social</x-table.th>
                    <x-table.th>Dirección</x-table.th>
                    <x-table.th>Estado</x-table.th>
                    <x-table.th>Municipio</x-table.th>
                    <x-table.th>CP</x-table.th>
                    <x-table.th>Teléfono</x-table.th>
                    <x-table.th>Régimen Fiscal</x-table.th>
                    <x-table.th></x-table.th>
                </x-slot>
            </x-table.table>
        </div>
    </div>
</div>
