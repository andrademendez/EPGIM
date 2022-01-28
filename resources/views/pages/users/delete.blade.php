<x-modal.confirm>
    <div class="col-span-2 ">
        <button class="bg-purple-800 text-red-100 w-full py-2.5 font-medium text-xs uppercase"
            wire:click=" closeModal()">Cancelar</button>
    </div>
    <div class="col-span-2 flex justify-center">
        <button class="py-2.5 w-full uppercase text-xs text-gray-800 text-center"
            wire:click="delete()">Eliminar</button>
    </div>
</x-modal.confirm>
