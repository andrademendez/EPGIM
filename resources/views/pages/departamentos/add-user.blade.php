<x-modal.modal-sm>
    <x-slot name="modalhead"> Agregar Usuario </x-slot>
    <div>
        <form method="post">
            <div class="grid grid-cols-4 gap-2">
                <div class="pt-2 col-span-4">
                    <x-form.label for="usuario">Usuarios</x-form.label>
                    <x-form.select wire:model="usuario" class="w-full" required>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </x-form.select>
                    @error('usuario') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="pt-2 flex justify-end">
                <x-button wire:click.prevent="addUser()">Agregar</x-button>
            </div>
        </form>

    </div>
</x-modal.modal-sm>
