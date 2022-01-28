<x-modal.modal-md>
    <x-slot name="modalhead"> Nuevo Espacio </x-slot>
    <div>
        <form action="#" method="post" class="flex flex-col">
            <div class="grid grid-cols-4 gap-2 ">
                <div class="mt-2 col-span-4">
                    <x-form.label for="nombre">Nombre</x-form.label>
                    <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre del espacio"
                        class="w-full" required />
                    @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mt-2 col-span-4">
                    <x-form.label for="referencia">Referencia</x-form.label>
                    <x-input type="text" wire:model="referencia" name="referencia" id="referencia"
                        placeholder="Referencia" class="w-full" />
                    @error('referencia') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-6 gap-2 ">
                <div class="mt-2 col-span-3">
                    <x-form.label for="medidas">Medidas</x-form.label>
                    <x-input type="text" wire:model="medidas" name="medidas" id="medidas" placeholder="Ancho x Alto "
                        class="w-full" />
                </div>
                <div class="mt-2 col-span-3">
                    <x-form.label for="clave">Clave</x-form.label>
                    <x-input type="text" wire:model="clave" name="clave" id="clave" placeholder="Clave"
                        class="w-full" />
                    @error('clave') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mt-2 col-span-2">
                    <x-form.label for="precio">Precio</x-form.label>
                    <x-input type="text" wire:model="precio" name="precio" id="precio" placeholder="$00"
                        class="w-full" />
                    @error('precio') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mt-2 col-span-2">
                    <x-form.label for="cantidad">Cantidad</x-form.label>
                    <x-input type="text" wire:model="cantidad" name="cantidad" id="cantidad" placeholder="00X"
                        class="w-full" />
                    @error('cantidad') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mt-2 col-span-2">
                    <x-form.label for="tipo">Tipo</x-form.label>
                    <x-form.select name="tipo" id="tipo" wire:model="id_tipo" class="w-full">
                        <option selected>UM</option>
                        @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </x-form.select>
                    @error('id_tipo') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="mt-1 col-span-3">
                    <x-form.label for="unidad">Unidad de Negocio</x-form.label>
                    <x-form.select name="unidad" id="unidad" wire:model="id_unidad" class="w-full">
                        <option selected>Selecione la Unidad</option>
                        @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </x-form.select>
                    @error('id_unidad') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

                <div class="mt-1 col-span-3">
                    <x-form.label for="ubicacion">Ubicación</x-form.label>
                    <x-form.select name="ubicacion" id="ubicacion" wire:model="id_ubicacion" class="w-full">
                        <option selected>Seleccione la ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                        @endforeach
                    </x-form.select>
                    @error('id_ubicacion') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="pt-4 flex justify-end">
                <x-button wire:click.prevent="store">Guardar</x-button>
            </div>
        </form>
    </div>
</x-modal.modal-md>
