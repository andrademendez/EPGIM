<x-modal.modal-sm>
    <x-slot name="modalhead">Crear Orden</x-slot>
    <div>
        <form method="post">
            @csrf
            <div class="grid grid-cols-4 gap-2">
                <div class="col-span-4 mt-2">
                    <div class="flex flex-col space-y-1 ">
                        <x-form.label for="">Espacios</x-form.label>
                        <x-form.select wire:model="espacio_asignado">
                            <option value="">Espacios</option>
                            @foreach ($espacios as $espacio)
                            <option value="{{ $espacio->nombre }}">{{ $espacio->referencia }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>

                <div class="col-span-2 mt-2">
                    <div class="flex flex-col space-y-1 ">
                        <x-form.label for="">Actividades</x-form.label>
                        <x-form.select wire:model="actividad">
                            <option value="">Actividades</option>
                            @foreach ($actividades as $actividad)
                            <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    @error('actividad') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 mt-2">
                    <div class="flex flex-col space-y-1 ">
                        <x-form.label for="">Tipo de Orden de servicio</x-form.label>
                        <x-form.select wire:model="tipoOrden">
                            <option value="">Tipo de orden</option>
                            @foreach ($ordenes as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    @error('tipoOrden') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 mt-2">
                    <x-form.label for=""> Fecha Inicio </x-form.label>
                    <x-input type="date" wire:model="fecha_inicio" placeholder="Fecha inicio" class="w-full" />
                    @error('fecha_inicio') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 mt-2">
                    <x-form.label for=""> Hora Inicio </x-form.label>
                    <x-input type="time" class="w-22" wire:model="hora_inicio" placeholder="Hora Entrada"
                        class="w-full" />
                </div>

                @if ($tipoOrden == 2)
                <div class="col-span-2 mt-2">
                    <x-form.label for=""> Fecha de Termino</x-form.label>
                    <x-input type="date" wire:model="fecha_fin" placeholder="Fecha término" class="w-full" />
                </div>

                <div class="col-span-2 mt-2">
                    <x-form.label for=""> Hora de termino </x-form.label>
                    <x-input type="time" class="w-full" wire:model="fecha_termino" placeholder="Hora Entrada" />
                </div>
                @endif

                @if ($tipoOrden == 1)
                <div class="col-span-4 mt-2">
                    <div>
                        <x-form.label for=""> URL </x-form.label>
                        <x-input type="text" wire:model="url" placeholder="Url del recurso" class="w-full" />
                    </div>

                </div>
                @endif
                <div class="col-span-4 mt-2">
                    <div class="flex flex-col ">
                        <x-form.label for=""> Comentarios </x-form.label>
                        <x-form.textarea name="" wire:model="comentarios" id="" cols="30" rows="3"
                            placeholder="Comentarios">

                        </x-form.textarea>
                    </div>

                </div>
                <div class="flex items-center mt-2 col-span-4">
                    <div class="w-full">
                        <x-form.btn-primary class="px-3 py-2.5 rounded w-full font-bold" wire:click.prevent="store">
                            Generar
                        </x-form.btn-primary>
                    </div>

                </div>
        </form>
    </div>
</x-modal.modal-sm>
