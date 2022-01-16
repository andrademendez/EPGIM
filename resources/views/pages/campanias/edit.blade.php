<div id="modalEventEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg rounded-2xl">
        <div class="modal-content relative px-2">
            <div class="mb-2 py-2 px-2 text-md text-center font-bold modalheader">
                <span class="text-md text-gray-700" id="modalEventEditar">Editar Campaña</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-5 gap-1 ">
                    <div class="col-span-3 mb-1">
                        <div class="bg-white">
                            <form id="modificarEvento" method="POST" class="border border-gray-400 p-2 rounded-lg shadow-lg">
                                @csrf
                                <input id="id_up" type="hidden" name="id" value="">
                                <div class="mt-2 grid grid-cols-4 gap-2">
                                    <div class="col-span-4">
                                        <x-form.label for="unombre">Nombre Campaña</x-form.label>
                                        <x-input class="w-full" name="unombre" id="unombre" type="text" />
                                    </div>

                                    <div class="col-span-2 pt-2">
                                        <x-form.label for="ustart">Fecha Inicio</x-form.label>
                                        <x-input class="w-full" name="udate-start" id="ustart" type="text" />

                                    </div>
                                    <div class="col-span-2 pt-2">
                                        <x-form.label for="uend">Fecha Fin</x-form.label>
                                        <x-input class="w-full" name="udate-uend" id="uend" type="text" />

                                    </div>
                                    <!-- Estado -->
                                    <div class="col-span-2 pt-2">
                                        <x-form.label for="uestatus">Estatus</x-form.label>
                                        <x-input id="uestatus" class="w-full" type="text" title="Estatus" disabled />
                                    </div>
                                    <!-- Tipo evento -->
                                    <div class="col-span-2  pt-2">
                                        <x-form.label for="umedio">Medio de ingreso</x-form.label>
                                        <x-form.select id="umedio" title="Medio" class="w-full">
                                            @foreach ( $medios as $medio)
                                            <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                    <div class="col-span-2 pt-2">
                                        <x-form.label for="ucliente">Cliente</x-form.label>
                                        <x-form.select id="ucliente" class="w-full" name="cliente" title="Cliente">
                                            <option selected>Selecione el cliente</option>
                                            @foreach ( $clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                    <!-- Estado -->
                                    <div class="col-span-2  pt-2 flex items-end justify-end">
                                        <x-form.label for="ucliente" class="text-transparent">..</x-form.label>
                                        <x-button id="actualizar" type="button" class="bg-gray-700">
                                            Actualizar
                                        </x-button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- agregar espacio -->
                    <div class="col-span-2 px-2 mb-1 border border-purple-500 rounded-2xl bg-white ">
                        <div class="pt-4 px-2  w-full">
                            <form id="agregarEspacios" method="POST">
                                @csrf
                                <input id="idEventEdit" type="hidden" name="event_id" value="">
                                <x-form.label for="uespacio">Agregar espacios</x-form.label>
                                <div class="flex flex-cols items-center justify-center w-full">
                                    <div class="w-full">
                                        <select name="uespacio[]" class="w-full selectpicker" id="espacioadd" multiple data-style="select-with-transition" data-size="7" style="width: 100%">
                                            @foreach ( $espacios as $espacio)
                                            <option value="{{ $espacio->id }}">{{ $espacio->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex items-end">
                                        <x-form.btn-icons type="button" id="addEspacios">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </x-form.btn-icons>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="pb-2  w-full">
                            <x-table.table>
                                <x-slot name="theader">
                                    <x-table.th colspan="2">Espacios</x-table.th>
                                </x-slot>
                                <tbody id="cargadatos"> </tbody>
                            </x-table.table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
