<x-modal.confirm>
    <div class="col-span-2">
        <button class="w-full bg-red-500 text-red-100 py-2 text-sm rounded-md px-4" type="button"
            wire:click="eliminarActividad()">Eliminar</button>
    </div>
    <div class="col-span-2">
        <button class="w-full  py-2 bg-gray-50 text-sm text-gray-700 hover:bg-gray-200 rounded-md px-4" type="button"
            wire:click="closeModal">Cancelar</button>
    </div>
</x-modal.confirm>
