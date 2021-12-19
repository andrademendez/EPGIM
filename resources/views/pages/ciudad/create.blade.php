<x-modal.modal-sm>
    <x-slot name="modalhead"> Nuevo Registro </x-slot>
    <div>
        <form action="#" method="post">
            <div class="pt-2">
                <x-form.label for="clave">Clave</x-form.label>
                <x-input type="text" wire:model="clave" name="clave" id="clave" placeholder="00X" class="w-full" />
            </div>
            <div class="pt-4">
                <x-form.label for="nombre">Nombre</x-form.label>
                <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre de la unidad" class="w-full" />
            </div>
            <div class="pt-4">
                <x-button wire:click.prevent="store">Guardar</x-button>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
