<x-modal.modal-sm>
    <x-slot name="modalhead">Validar orden de servicio</x-slot>
    <div class="">
        <form method="post">
            <div class="w-full mt-2">
                <x-form.select class="w-full" wire:model="estatus">
                    <option value="">Seleccione el estatus</option>
                    <option value="Validado">Validar Orden</option>
                    <option value="Rechazado">Rechazar Orden</option>
                </x-form.select>
                @error('estatus') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mt-3">
                <x-form.textarea wire:model="comentarios" cols="30" rows="5" placeholder="Comentarios">
                </x-form.textarea>
                @error('comentarios') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="mt-3 w-full flex justify-center">
                <x-form.btn-primary wire:click.prevent="store" class="px-4 py-2 rounded-none w-full text-sm">
                    Guardar Cambios
                </x-form.btn-primary>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
