<div class="modal fade" id="uikit-create" tabindex="-1" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content  bg-white">
            <div class="mb-2 pb-2 pt-3 px-8 text-md font-bold modalheader">
                <span class="text-md text-gray-700" id="modaltitle">Nueva campaña</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="w-full">
                <form class="" id="crearEvento" method="POST">
                    @csrf
                    <!-- Nombre -->
                    <div class="w-full px-4 rounded-2xl bg-white">
                        <div class="p-2 grid grid-cols-4 gap-4">
                            <div class="col-span-4 pt-3">
                                <div class="flex items-center  space-x-4">
                                    <x-form.label for="nombre" class="text-sm mr-7 ">
                                        <div class="flex space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            <span>Titulo</span>
                                        </div>
                                    </x-form.label>
                                    <x-input id="nombre" class="w-full" name="nombre" title="Nombre completo"
                                        placeholder="Ingrese el nombre" type="text" required />
                                </div>
                            </div>
                            <div class="col-span-4 pt-2">
                                <div class="flex items-center  space-x-4">
                                    <x-form.label for="cliente" class="text-sm mr-3 ">
                                        <div class="flex space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <span>Cliente</span>
                                        </div>
                                    </x-form.label>
                                    <x-form.select id="cliente" class="w-full " name="cliente"
                                        title="Seleccione el Cliente">
                                        <option selected>Selecione el cliente</option>
                                        @foreach ( $clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <!-- Tipo evento -->
                            <div class="col-span-4 pt-2">
                                <div class="flex items-center  space-x-4">
                                    <x-form.label for="medio" class="text-sm mr-7">
                                        <div class="flex space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                            <span>Medio</span>
                                        </div>
                                    </x-form.label>
                                    <x-form.select id="medio" title="Medio" class="w-full">
                                        <option>Seleccione un medio</option>
                                        @foreach ( $medios as $medio)
                                        <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                            </div>
                            <div class="col-span-2 pt-2">
                                <x-form.label for="start" class="text-sm mr-4">
                                    <div class="flex space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Fecha inicio</span>
                                    </div>
                                </x-form.label>
                                <x-input id="start" name="start" type="text" class="mt-2 datepicker"
                                    title="Inicio de la campaña" />

                            </div>
                            <div class="col-span-2 pt-2">
                                <x-form.label for="end" class="text-sm mr-4">
                                    <div class="flex space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Fecha fin</span>
                                    </div>
                                </x-form.label>
                                <x-input id="end" name="end" type="text" class="mt-2 datepicker"
                                    title="Fin de la campaña" />
                            </div>

                            <div class="col-span-4 py-2">
                                <x-form.label for="espacio" class="text-sm mr-4">
                                    <div class="flex space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                                        </svg>
                                        <span>Espacios</span>
                                    </div>
                                </x-form.label>
                                <div class="dropdown bootstrap-select show" style="width: 100%">
                                    <select name="espacio[]" class="selectpicker form-control" id="espacio" multiple
                                        data-style="btn btn-link" data-size="7" title="Selecione un espacio">
                                        @foreach ( $espacios as $espacio)
                                        <option value="{{ $espacio->id }}">
                                            <span>{{ $espacio->nombre }}</span> -
                                            <span>{{ $espacio->referencia }}</span>
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fecha Inicio-->
                    <div class="mt-3 flex justify-between px-10 ">
                        <x-form.btn-secondary class="bg-gray-700 py-1.5" id="cancel" type="button" data-dismiss="modal">
                            Cerrar
                        </x-form.btn-secondary>
                        <x-form.btn-primary id="save" type="submit">Agregar</x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
