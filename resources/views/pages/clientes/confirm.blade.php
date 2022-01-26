<x-modal.confirm>
    <div class="col-span-2">
        <button class="bg-indigo-700 text-white text-sm py-2 w-full hover:bg-indigo-600 rounded-md"
            wire:click="delete()">Confirmar</button>
    </div>
    <div class="col-span-2">
        <button class="bg-red-100 text-indigo-700 text-sm py-2 w-full hover:bg-red-500 rounded-md"
            wire:click="closeModal()">Cancelar</button>
    </div>
</x-modal.confirm>
