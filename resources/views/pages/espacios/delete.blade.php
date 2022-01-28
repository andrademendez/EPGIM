<x-modal.confirm>

    <div class="col-span-2">
        <button
            class="bg-gray-100 text-gray-900 hover:bg-gray-50 w-full py-2.5 font-medium text-xs uppercase ring-1 ring-gray-200"
            wire:click="closeModal" type="button">Cancelar</button>
    </div>
    <div class="col-span-2">
        <button
            class="bg-red-600 hover:bg-red-700 text-red-100 w-full py-2.5 font-medium text-xs  uppercase ring-1 ring-red-200"
            wire:click="delete()" type="button">Eliminar</button>
    </div>
</x-modal.confirm>
