<x-modal.modal-sm>
    <x-slot name="modalhead">Nuevo rol</x-slot>
    <form method="post">
        <div class="mb-3">
            <x-form.label for="nombre">Nombre</x-form.label>
            <x-input type="text" class="w-full" wire:model="nombre" placeholder="Nombre del rol" />
        </div>
        <div class="mb-3">
            <x-form.label for="">Descripción</x-form.label>
            <x-input type="text" class="w-full" wire:model="descripcion" placeholder="Descripcion" />
        </div>
        <div class="flex justify-end">
            <x-button wire:click.prevent="store">Guardar</x-button>
        </div>
    </form>
</x-modal.modal-sm>
