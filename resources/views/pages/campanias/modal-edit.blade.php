<x-modal.modal-md>
    <x-slot name="modalhead"> Actualizar Campaña</x-slot>
    <div>

        <div class="grid grid-cols-5 gap-1">
            <div class="col-span-3 border border-purple-500 rounded-lg px-2 py-2">
                <form action="#" method="post">
                    <div class="pt-2">
                        <x-form.label for="nombre">Nombre</x-form.label>
                        <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre de la unidad" class="w-full" />
                    </div>
                    <div class="pt-2 grid grid-cols-2 gap-1">
                        <div>
                            <x-form.label for="start">Fecha Inicio</x-form.label>
                            <x-form.date-picker type="text" name="start" wire:model="start" placeholder="Fecha inicio" class="w-full" />
                        </div>
                        <div>
                            <x-form.label for="end">Fecha Fin</x-form.label>
                            <x-form.date-picker type="text" name="end" wire:model="end" placeholder="Fecha fin" class="w-full" />
                        </div>

                    </div>
                    <div class="pt-2 grid grid-cols-2 gap-1">
                        <div>
                            <x-form.label for="uestatus">Estatus</x-form.label>
                            <x-input wire:model="estatus" class="w-full" type="text" title="Estatus" disabled />
                        </div>
                        <div>
                            <x-form.label for="umedio">Medio de ingreso</x-form.label>
                            <x-form.select wire:model="cmedio" title="Medio" class="w-full">
                                @foreach ( $medios as $medio)
                                <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                @endforeach
                            </x-form.select>

                        </div>

                    </div>
                    <div class=" pt-2">
                        <x-form.label for="ucliente">Cliente</x-form.label>
                        <x-form.select wire:model="ccliente" class="w-full" name="cliente" title="Cliente">
                            <option selected>Selecione el cliente</option>
                            @foreach ( $clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </form>
            </div>
            <div class="col-span-2">
                <div class="px-2 border border-purple-500 rounded-lg bg-white ">
                    <div class="py-2 w-full">
                        <form method="post">
                            <x-form.label for="">Agregar Espacio</x-form.label>
                            <div class="flex items-center justify-between w-full">
                                <div class="w-full">
                                    <x-form.select name="" id="" wire:model="cespacio" class="w-full">
                                        <option selected>Selecione el cliente</option>
                                        @foreach ( $espacios as $espacio)
                                        <option value="{{ $espacio->id }}">{{ $espacio->nombre }}</option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                                <x-form.btn-icons class="pl-2" type="button" wire:click.prevent="agregarEspacio()">
                                    <box-icon name='add-to-queue' color='#182cd4'></box-icon>
                                </x-form.btn-icons>
                            </div>
                        </form>
                        <div class="mt-3">
                            <x-table.table>
                                <x-slot name="theader">
                                    <x-table.th colspan="2">Espacios</x-table.th>

                                </x-slot>
                                @foreach ($campania->espacios as $espacio)
                                <x-table.tr>
                                    <x-table.td>
                                        {{ $espacio->nombre }}
                                    </x-table.td>
                                    <x-table.td>
                                        <button id="comapUpdate" class="text-red-500" type="button" wire:click.prevent="eliminarEspacio({{ $espacio->id }})">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </x-table.td>
                                </x-table.tr>
                                @endforeach

                            </x-table.table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modal.modal-md>
