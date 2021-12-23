<div class="py-2">
    <x-slot name="title">Espacio</x-slot>
    <x-slot name="titlePage">Editar Espacio - {{ $nombre }}</x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200">
                <div class="pb-4 flex justify-end">
                    <a href="{{ route('espacios.index') }}">Volver a list</a>
                </div>
                <div class="px-5">
                    <form method="post" class="lg:w-2/3 w-full shadow-xl p-4">
                        @csrf
                        <div class="pb-2 text-lg text-center uppercase font-thin">
                            <h1>Datos de la pantalla</h1>
                        </div>

                        <div class="grid grid-cols-4 gap-4 ">
                            <div class="pt-4 col-span-2">
                                <x-form.label for="nombre">Nombre</x-form.label>
                                <x-input type="text" wire:model="nombre" class="w-full" />

                            </div>
                            <div class="pt-4 col-span-2">
                                <x-form.label for="nombre">Referencia</x-form.label>
                                <x-input type="text" wire:model="referencia" class="w-full" />
                            </div>
                            <div class="pt-2 col-span-1">
                                <x-form.label for="medidas">Medidas</x-form.label>
                                <x-input type="text" wire:model="medidas" class="w-full" />
                            </div>

                            <div class="pt-2 col-span-1">
                                <x-form.label for="cantidad">Cantidad</x-form.label>
                                <x-input type="text" wire:model="cantidad" class="w-full" />
                            </div>
                            <div class="pt-2 col-span-1">
                                <x-form.label for="precio">Precio</x-form.label>
                                <x-input type="text" wire:model="precio" class="w-full" />
                            </div>
                            <div class="pt-2 col-span-1">
                                <x-form.label for="estatus">Estatus</x-form.label>
                                <label for="toggle-example-checked" class="flex relative items-center mb-4 cursor-pointer">
                                    <input type="checkbox" id="toggle-example-checked" wire:model="estatus" class=" sr-only">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
                                    @if ($estatus == 1)
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Disponible</span>
                                    @else
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Ocupado</span>
                                    @endif

                                </label>
                            </div>
                            <div class="pt-2 col-span-2">
                                <x-form.label for="id_unidad">Unidad de Negocio</x-form.label>
                                <x-form.select name="id_unidad" id="id_unidad" wire:model="id_unidad" class="w-full">
                                    <option value="">Slecciones la unidad</option>
                                    @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                            <div class="pt-2 col-span-2">
                                <x-form.label for="id_tipo">Tipo de pantalla</x-form.label>
                                <x-form.select name="id_tipo" id="id_tipo" wire:model="id_tipo" class="w-full">
                                    <option value="">Slecciones tipo pantalla</option>
                                    @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </x-form.select>

                            </div>
                            <div class="pt-2 col-span-2">
                                <x-form.label for="id_ubicacion">Precio</x-form.label>
                                <x-form.select name="id_ubicacion" id="id_ubicacion" class="w-full" wire:model="id_ubicacion">
                                    <option value="">Slecciones tipo pantalla</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </x-form.select>
                            </div>
                        </div>
                        <div class="pt-4 flex justify-end ">
                            <x-button class="bg-purple-700">Guardar</x-button>
                        </div>
                    </form>
                    <div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
