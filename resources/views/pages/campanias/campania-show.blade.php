<div id="modalEventEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog rounded-2xl bg-white">
        <div class="modal-content relative px-2">
            <div class="mb-2 pt-3 pb-2 px-4 text-md font-bold modalheader">
                <span class="text-md text-gray-700" id="modalEventEditar">informacion de la Campaña</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                <form id="modificarEvento" method="POST" class="">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div class="mt-2">
                            <label>Campaña:</label>
                            <x-input class="w-full" name="unombre" id="unombre" type="text" disabled />
                        </div>
                        <div class="mt-2">
                            <label for="">Cliente</label>
                            <x-form.select id="ucliente" class="w-full" name="cliente" title="Cliente" disabled>
                            </x-form.select>
                        </div>
                        <div class="mt-2">
                            <label for="">Fecha Inicio</label>
                            <x-input class="w-full datepicker" name="udate-start" id="ustart" type="text" disabled />
                        </div>
                        <div class="mt-2">
                            <label for="">Fecha Fin</label>
                            <x-input class="w-full datepicker" name="udate-uend" id="uend" type="text" disabled />
                        </div>
                        <div class="mt-2">
                            <label for="">Estatus</label>
                            <x-input id="uestatus" class="w-full" type="text" title="Estatus" disabled />
                        </div>
                        <div class="mt-2">
                            <label for="">Medio</label>
                            <x-form.select id="umedio" title="Medio" class="w-full" disabled>
                            </x-form.select>
                        </div>

                        <div class="col-span-2 mt-3">
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
                </form>
            </div>
        </div>
    </div>
</div>
