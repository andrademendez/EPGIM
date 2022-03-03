<div id="modalEventEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg rounded-2xl bg-white">
        <div class="modal-content relative px-2">
            <div class="mb-2 pt-3 pb-2 px-4 text-md font-bold modalheader">
                <span class="text-md text-gray-700" id="modalEventEditar">Editar Campaña</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-5 gap-1 ">
                    <div class="col-span-3  px-3 ">
                        <div class="bg-white">
                            <form id="modificarEvento" method="POST" class="">
                                @csrf
                                <input id="id_up" type="hidden" name="id" value="">
                                <div class="mt-2 grid grid-cols-4 gap-2">
                                    <div class="col-span-4">
                                        <x-form.label for="unombre" class="text-sm mr-7 ">
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                                <span>Nombre Campaña</span>
                                            </div>
                                        </x-form.label>
                                        <x-input class="w-full" name="unombre" id="unombre" type="text" />
                                    </div>

                                    <div class="col-span-2 mt-3">
                                        <x-form.label for="ustart" class="text-sm mr-7">
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Fecha Inicio</span>
                                            </div>
                                        </x-form.label>
                                        <x-input class="w-full datepicker" name="udate-start" id="ustart" type="text" />

                                    </div>
                                    <div class="col-span-2 mt-3">
                                        <x-form.label for="uend" class="text-sm mr-7">
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>Fecha Fin</span>
                                            </div>
                                        </x-form.label>
                                        <x-input class="w-full datepicker" name="udate-uend" id="uend" type="text" />

                                    </div>
                                    <!-- Estado -->
                                    <div class="col-span-2 mt-3">
                                        <x-form.label for="uestatus" class="text-sm mr-7">
                                            <div class="flex space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                                    </path>
                                                </svg>
                                                <span>Estatus</span>
                                            </div>
                                        </x-form.label>
                                        <x-input id="uestatus" class="w-full" type="text" title="Estatus" disabled />
                                    </div>
                                    <!-- Tipo evento -->
                                    <div class="col-span-2  mt-3">
                                        <x-form.label for="umedio" class="text-sm mr-7">
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                                <span>Medio de Ingreso</span>
                                            </div>
                                        </x-form.label>
                                        <x-form.select id="umedio" title="Medio" class="w-full">
                                            @foreach ( $medios as $medio)
                                            <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                    <div class="col-span-2 mt-3">
                                        <x-form.label for="ucliente" class="text-sm mr-7">
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                                <span>Cliente</span>
                                            </div>
                                        </x-form.label>
                                        <x-form.select id="ucliente" class="w-full" name="cliente" title="Cliente">
                                            <option selected>Selecione el cliente</option>
                                            @foreach ( $clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>

                                </div>
                                <div class="mt-3 flex items-center justify-between ">
                                    <x-form.btn-primary id="delete" type="button" class="py-1.5 bg-red-500"
                                        title="Eliminar campaña">
                                        Eliminar
                                    </x-form.btn-primary>
                                    <x-form.btn-primary id="actualizar" type="button" class="py-1.5">
                                        Actualizar
                                    </x-form.btn-primary>

                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- agregar espacio -->
                    <div class="col-span-2 shadow-xl rounded-md">
                        <div class=" px-3 pt-3 ">
                            <div class="px-2">
                                <form id="agregarEspacios" method="POST">
                                    @csrf
                                    <input id="idEventEdit" type="hidden" name="event_id" value="">
                                    <x-form.label for="uespacio" class="text-black text-md font-medium">Agregar espacios
                                    </x-form.label>
                                    <div class="flex flex-cols items-center justify-center w-full">
                                        <div class="w-full">
                                            <select name="uespacio[]" class="w-full selectpicker" id="espacioadd"
                                                multiple data-style="select-with-transition" data-size="7"
                                                style="width: 100%">
                                                @foreach ( $espacios as $espacio)
                                                <option value="{{ $espacio->id }}">
                                                    <span>{{ $espacio->nombre }}</span> -
                                                    <span>{{ $espacio->referencia }}</span>
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex items-end">
                                            <x-form.btn-icons type="button" id="addEspacios">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </x-form.btn-icons>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="pb-2 ">
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
</div>
