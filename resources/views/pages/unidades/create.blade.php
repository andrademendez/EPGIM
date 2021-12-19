<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} Unidad </x-slot>
    <div>
        <form action="#" method="post">
            <div class="pt-4">
                <x-form.label for="nombre">Nombre</x-form.label>
                <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre de la unidad" class="w-full" required />
            </div>
            <div class="pt-4">
                <x-form.label for="ciudad">Municipio</x-form.label>
                <x-form.select name="ciudad" id="ciudad" wire:model="id_ciudad">
                    <option selected disabled> Selecione la ciudad</option>
                    @foreach ($ciudades as $ciudad)
                    <option value="{{ $ciudad->id }}"> {{ $ciudad->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="pt-4">
                <x-button wire:click.prevent="store()">Guardar</x-button>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
