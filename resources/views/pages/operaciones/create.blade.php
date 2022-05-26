<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} </x-slot>
    <div>
        <form method="post">
            <x-form.label for="nombre">Nombre</x-form.label>
            <div class="flex justify-between items-center mt-1 w-full">
                <div class="w-full">
                    <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre"
                        class="w-full" required />
                    @error('nombre') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <x-form.btn-primary class="px-3 py-2 rounded " wire:click.prevent="store()">{{ $action }}
                    </x-form.btn-primary>
                </div>
            </div>

        </form>

    </div>
</x-modal.modal-sm>
