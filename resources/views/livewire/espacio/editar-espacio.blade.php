<div>

    <form method="post" class=" ">
        @csrf
        <div class="pb-2 text-xl text-gray-800 text-center uppercase ">
            <h1>Datos de la pantalla</h1>
        </div>
        <div class="grid grid-cols-6 gap-2 ">
            <div class="mt-2 col-span-6">
                <x-form.label for="nombre">Nombre</x-form.label>
                <x-input type="text" wire:model="nombre" class="w-full" />
                @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span>@enderror
            </div>

            <div class="mt-2 col-span-6">
                <x-form.label for="nombre">Referencia</x-form.label>
                <x-input type="text" wire:model="referencia" class="w-full" />
                @error('referencia') <span class="text-xs text-red-600">{{ $message }}</span>@enderror
            </div>
            <div class="pt-2 col-span-2">
                <x-form.label for="medidas">Medidas</x-form.label>
                <x-input type="text" wire:model="medidas" class="w-full" />
                @error('medidas') <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-span-2">
                <x-form.label for="precio">Precio</x-form.label>
                <x-input type="text" wire:model="precio" class="w-full" />
                @error('precio') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mt-2 col-span-2">
                <x-form.label for="clave">Clave</x-form.label>
                <x-input type="text" wire:model="clave" name="clave" id="clave" placeholder="Clave" class="w-full" />
                @error('clave') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mt-2 col-span-2">
                <x-form.label for="estatus">Estatus</x-form.label>
                <x-form.select name="estatus" id="estatus" wire:model="estatus" class="w-full">
                    <option value="">Estatus</option>
                    <option value="1">Activado</option>
                    <option value="0">Inactivo</option>
                </x-form.select>
            </div>
            <div class="pt-2 col-span-1">
                <x-form.label for="cantidad">Cantidad</x-form.label>
                <x-input type="text" wire:model="cantidad" class="w-full" />
                @error('cantidad') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="pt-2 col-span-3">
                <x-form.label for="id_tipo">Tipo de pantalla</x-form.label>
                <x-form.select name="id_tipo" id="id_tipo" wire:model="id_tipo" class="w-full">
                    <option value="">Slecciones tipo pantalla</option>
                    @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </x-form.select>
                @error('id_tipo') <span class="text-xs text-red-600">{{ $message }}</span> @enderror

            </div>
            <div class="pt-2 col-span-2">
                <x-form.label for="id_unidad">Unidad de Negocio</x-form.label>
                <x-form.select name="id_unidad" id="id_unidad" wire:model="id_unidad" class="w-full">
                    <option value="">Slecciones la unidad</option>
                    @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </x-form.select>
                @error('id_unidad') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="pt-2 col-span-2">
                <x-form.label for="id_ubicacion">Ubicación</x-form.label>
                <x-form.select name="id_ubicacion" id="id_ubicacion" class="w-full" wire:model="id_ubicacion">
                    <option value="">Slecciones la ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                    @endforeach
                    @error('id_ubicacion') <span class="text-xs text-red-600">{{ $message }}</span>
                    @enderror
                </x-form.select>
            </div>
        </div>

        <div class="pt-4 flex justify-end ">
            <x-button class="" wire:click.prevent="update()">Guardar</x-button>
        </div>
    </form>
    <div>
        <x-button wire:click="deshabilitar({{ $id_espacio }})">Deshabilitar</x-button>
    </div>
</div>
