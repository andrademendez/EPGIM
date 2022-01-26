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
                <form class="px-2" id="crearEvento" method="POST">
                    @csrf
                    <!-- Nombre -->
                    <div class="w-full px-2 border border-purple-500 rounded-2xl bg-white">
                        <div class="p-2 grid grid-cols-4 gap-4">
                            <div class="col-span-4 pt-3">
                                <x-form.label for="nombre">Nombre de la campaña</x-form.label>
                                <x-input id="nombre" class="w-full" name="nombre" title="Nombre completo"
                                    placeholder="Ingrese el nombre" type="text" required />
                            </div>
                            <div class="col-span-2 pt-2">
                                <x-form.label for="cliente">Cliente</x-form.label>
                                <x-form.select id="cliente" class="w-full " name="cliente"
                                    title="Seleccione el Cliente">
                                    <option selected>Selecione el cliente</option>
                                    @foreach ( $clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                            <!-- Tipo evento -->
                            <div class="col-span-2  pt-2">
                                <x-form.label for="medio">Medio de ingreso</x-form.label>
                                <x-form.select id="medio" title="Medio" class="w-full">
                                    @foreach ( $medios as $medio)
                                    <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                            <div class="col-span-2 pt-2">
                                <x-form.label for="start">Fecha inicio</x-form.label>
                                <x-input id="start" name="start" type="text" title="Inicio de la campaña" />

                            </div>
                            {{-- <div class="col-span-2 pt-2">
                                <div class=" form-group ">
                                    <x-form.label for="start">Fecha inicio</x-form.label>
                                    <input id="start" class="form-control datepicker w-full mt-1"
                                        placeholder="Please select date" type="text">
                                </div>
                            </div> --}}

                            <div class="col-span-2 pt-2">
                                <x-form.label for="end">Fecha fin</x-form.label>
                                <x-input id="end" name="end" type="text" title="Fin de la campaña" />

                            </div>

                            <div class="col-span-2">
                                <x-form.label>Espacios</x-form.label>
                                <div class="form-group">
                                    <div class="dropdown bootstrap-select show" style="width: 100%">
                                        <select name="espacio[]" class="selectpicker form-control" id="espacio" multiple
                                            data-style="btn btn-link" data-size="7" title="Selecione un espacio">
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
                    <div class="pt-2 flex justify-between px-10 ">
                        <x-form.btn-secondary class="bg-gray-700" id="cancel" type="button" data-dismiss="modal">Cerrar
                        </x-form.btn-secondary>
                        <x-form.btn-primary id="save" type="submit">Agregar</x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
