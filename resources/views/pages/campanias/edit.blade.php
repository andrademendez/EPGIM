<div id="modalEventEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg rounded-2xl">
        <div class="modal-content relative px-2 bg-gray-50">
            <div class="mb-2 py-2 px-2 text-md text-center font-bold modalheader">
                <span class="text-md text-gray-700" id="modalEventEditar">Editar Evento</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                <div class="grid grid-cols-5  mb-2">
                    <div class="col-span-3 mx-2 border border-purple-500 rounded-2xl bg-white">
                        <div class="px-3 pt-2">
                            <form id="modificarEvento" method="POST">
                                @csrf
                                <input id="id_up" type="hidden" name="id" value="">
                                <div class="mt-2 mb-3">
                                    <div class="">
                                        <x-label for="unombre">Nombre</x-label>
                                        <input class="form-control" name="unombre" id="unombre" type="text" />
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 flex flex-inline">
                                    <div class="w-1/2">
                                        <x-label for="ustart">Fecha</x-label>
                                        <div class="form-group">
                                            <input class="form-control" name="udate-start" id="ustart" type="text" />
                                        </div>
                                    </div>
                                    <!-- Estado -->
                                    <div class="w-1/2 ml-2">
                                        <x-label for="uestatus">Estatus</x-label>
                                        <div class="form-group ">
                                            <select class="form-control selectpicker" id="uestatus" data-style="btn btn-link">
                                                <option value="Confirmado">Confirmado</option>
                                                <option value="Hold">Hold</option>
                                                {{-- <option value="Cancelado">Cancelado</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tipo Evento -->
                                <div class="mt-2 mb-3 ">
                                    <label class=" text-gray-800 text-sm mb-2" for="utevento">Tipo de Evento</label>
                                    {{-- <select class="form-control selectpicker" name="teventos" id="utevento" data-style="btn btn-link" data-size="7">
                                        @foreach ( $teventos as $tevento)
                                        <option value="{{ $tevento->id }}">{{ $tevento->nombre }}</option>
                                    @endforeach
                                    </select> --}}
                                </div>
                                <!-- Bottom -->
                                <div class="m-2">
                                    <div class="flex justify-between mt-3">
                                        <x-button id="udelete" type="button">
                                            <div class="flex items-center">
                                                {{-- <span class="iconify w-6 h-6" data-icon="ph:calendar-x-light" data-inline="false"></span> --}}
                                                <span class="pl-2">Eliminar</span>
                                            </div>
                                        </x-button>
                                        <x-form.btn-primary id="uguardar" type="button">
                                            <div class="flex items-center">
                                                {{-- <span class="iconify w-6 h-6" data-icon="fluent:calendar-arrow-down-24-filled" data-inline="false"></span> --}}
                                                <span class="pl-2">Guardar cambios</span>
                                            </div>
                                        </x-form.btn-primary>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- agregar espacio -->
                    <div class="col-span-2 px-2 border border-purple-500 rounded-2xl bg-white ">
                        <div class="pt-2 px-2">
                            <form id="agregarEspacios" method="POST">
                                @csrf
                                <input id="idEventEdit" type="hidden" name="event_id" value="">
                                <x-label for="uespacio">Agregar espacios</x-label>
                                <div class="flex flex-row items-center justify-center">
                                    <div class="w-full">

                                        {{-- <div class="">
                                            <select name="uespacio[]" class="selectpicker" id="espacioadd" multiple data-style="select-with-transition" data-size="7">
                                                @foreach ( $espacios as $espacio)
                                                <option value="{{ $espacio->id }}">{{ $espacio->nombre }}</option>
                                        @endforeach
                                        </select>
                                    </div> --}}
                                </div>
                                <div class="flex items-end">
                                    <x-form.btn-icons type="button" id="saveAddVenue">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </x-form.btn-icons>
                                </div>
                        </div>
                        </form>
                    </div>
                    <div class="pb-2">
                        <x-table.table>
                            <x-slot name="theader">
                                <tr>
                                    <x-table.th colspan="2">Espacios</x-table.th>
                                </tr>
                            </x-slot>
                            <tbody class="bg-white divide-y divide-gray-200" id="cargadatos">

                            </tbody>
                        </x-table.table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
