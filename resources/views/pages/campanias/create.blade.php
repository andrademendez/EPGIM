<div class="modal fade" id="uikit-create" tabindex="-1" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content  bg-gray-50">
            <div class="mb-2 py-2 px-2 text-md text-center font-bold modalheader">
                <span class="text-md text-gray-700" id="modaltitle">Nueva campaña</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                {{-- <div class="mb-2 py-2 px-4 text-md text-center font-bold">
                    <span>Nuevo Evento</span>
                </div> --}}
                <form class="px-2" id="crearEvento" method="POST">
                    @csrf
                    <!-- Nombre -->
                    <div class="w-full px-2 border border-purple-500 rounded-2xl bg-white">
                        <div class="p-2 grid grid-cols-4 gap-4">
                            <div class="col-span-4 pt-3">
                                <x-form.label for="nombre">Nombre del evento</x-form.label>
                                <input id="nombre" class="form-control" name="title" placeholder="Ingrese el nombre" type="text" required>
                            </div>
                            <!-- Estado -->
                            <div class="col-span-2">
                                <x-form.label for="select-espacio">Estatus</x-form.label>
                                <select id="select-estatus" name="estatus" class="selectpicker form-control" data-style="btn btn-link" title="Estatus" required>
                                    <option value="Solicitudes">Solicitudes</option>
                                    <option value="Challenge">Challenge</option>
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Cerrado">Cerrado</option>
                                </select>
                            </div>
                            <!-- Tipo evento -->
                            <div class="col-span-2">
                                <x-form.label for="tevento">Medio de ingreso</x-form.label>
                                <select id="tevento" class="selectpicker form-control" name="tevento" data-style="btn btn-link" data-size="7" title="Tipo de evento">
                                    @foreach ( $medios as $medio)
                                    <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <x-form.label for="started">Fecha</x-form.label>
                                <div class="form-group">
                                    <input id="started" class="form-control" name="start" type="text" title="Inicio de la campaña">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <x-form.label for="end">Fecha</x-form.label>
                                <div class="form-group">
                                    <input id="end" class="form-control" name="end" type="text" title="Fin de la campaña">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <x-form.label for="cliente">Cliente</x-form.label>
                                <select id="cliente" class="selectpicker form-control" name="cliente" data-style="btn btn-link" data-size="7" title="Cliente">
                                    @foreach ( $clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <x-form.label>Espacios</x-form.label>
                                <div class="form-group">
                                    <div class="dropdown bootstrap-select show" style="width: 100%">
                                        <select name="espacio[]" class="selectpicker form-control" id="espacio" multiple data-style="btn btn-link" data-size="7" title="Selecione un espacio">
                                            @foreach ( $espacios as $espacio)
                                            <option value="{{ $espacio->id }}">{{ $espacio->nombre }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fecha Inicio-->
                    <div class="pt-2 flex justify-end ">
                        <x-form.btn-primary id="save" type="submit">Agregar</x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
