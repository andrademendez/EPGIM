<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} Departamento </x-slot>
    <div>
        <form method="post">
            <div class="grid grid-cols-4 gap-2">
                <div class="pt-2 col-span-4">
                    <x-form.label for="nombre">Nombre</x-form.label>
                    <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre del usuario"
                        class="w-full" required />
                    @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2 col-span-4">
                    <x-form.label for="descripcion">Descripción</x-form.label>
                    <x-form.textarea wire:model="descripcion" name="descripcion" id="" cols="30" rows="4">
                    </x-form.textarea>
                    @error('descripcion') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="pt-2 flex justify-end">
                <x-button wire:click.prevent="store()">Registrar</x-button>
            </div>
        </form>

    </div>
</x-modal.modal-sm>
