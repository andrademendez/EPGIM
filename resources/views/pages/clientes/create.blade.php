<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} cliente </x-slot>
    <div>
        <form action="#" method="post">
            <div class="pt-2">
                <x-form.label for="nombre">Nombre</x-form.label>
                <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre del cliente" class="w-full" required />
                @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="pt-4">
                <x-form.label for="contacto">Contácto</x-form.label>
                <x-input type="text" wire:model="contacto" name="contacto" id="contacto" placeholder="Nombre del contacto" class="w-full" />
                @error('contacto') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div class="pt-4">
                    <x-form.label for="telefono">Teléfono</x-form.label>
                    <x-input type="tel" wire:model="telefono" name="telefono" id="telefono" placeholder="tel: 8110001111" class="w-full" />
                </div>
                <div class="pt-4">
                    <x-form.label for="email">Correo</x-form.label>
                    <x-input type="email" wire:model="email" name="email" id="email" placeholder="email: example@gmail.com" class="w-full" />
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <x-form.btn-primary wire:click.prevent="store()">Guardar</x-form.btn-primary>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
