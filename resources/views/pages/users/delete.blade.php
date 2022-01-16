<x-modal.modal-confirm>
    <div class="col-span-2 flex justify-center bg-blue-500">
        <button class="py-2.5 w-full uppercase text-xs text-white text-center" wire:click=" closeModal()">Cancelar</button>
    </div>
    <div class="col-span-2 flex justify-center">
        <button class="py-2.5 w-full uppercase text-xs text-white text-center" wire:click="delete()">Eliminar</button>
    </div>
</x-modal.modal-confirm>
