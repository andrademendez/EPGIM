<x-modal.modal-sm>
    <x-slot name="modalhead"> Agregar Departamento</x-slot>
    <div>
        <form method="post">
            <x-form.label for="nombre">Departamentos</x-form.label>
            <div class="flex justify-between items-center mt-1 w-full">
                <div class="w-full">

                    <x-form.select class="w-full" wire:model="departamento">
                        <option value="">Departamentos</option>
                        @foreach ($departamentos as $depa)
                        <option value="{{ $depa->id }}">{{ $depa->nombre }}</option>
                        @endforeach
                    </x-form.select>
                    @error('departamento') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <x-form.btn-primary class="px-3 py-2 rounded " type="button"
                        wire:click.prevent="agregarDepartamento()">Agregar
                    </x-form.btn-primary>
                </div>
            </div>

        </form>

    </div>
</x-modal.modal-sm>
