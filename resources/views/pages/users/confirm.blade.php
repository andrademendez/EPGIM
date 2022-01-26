<x-modal.confirm>

    <div class="col-span-2 flex items-center justify-center">
        @if ($status == 0)
        <button class="bg-indigo-700 text-white text-sm py-2 w-full hover:bg-indigo-600 rounded-md"
            wire:click="changeStatus">Habilitar</button>
        @else
        <button class="bg-red-500 text-red-100 py-2 text-sm rounded-md w-full"
            wire:click="changeStatus">Deshabilitar</button>
        @endif

    </div>
    <div class="col-span-2  flex items-center justify-center">
        <button class="w-full py-2 bg-gray-50 text-sm text-gray-700 hover:bg-gray-200 rounded-md"
            wire:click="closeModal">Cancelar</button>
    </div>

</x-modal.confirm>
