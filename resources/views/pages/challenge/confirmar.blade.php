<x-modal.modal-sm>
    <x-slot name="modalhead"></x-slot>
    <div class="flex flex-col items-center justify-center text-center text-xl px-10 pt-4 mb-3">
        <div class="text-green-600">
            <svg class="w-28 h-28" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
        </div>
        <span class="text-2xl font-bold uppercase mt-3">
            Confirmar solicitud
        </span>

    </div>
    <div class="flex items-center justify-between px-10 py-4 ">
        <x-button class="py-2 text-xs" wire:click="confirmar">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Confirmar
        </x-button>
        <button class="px-5 py-2 text-sm uppercase bg-gray-100 font-semibold rounded-xl hover:bg-orange-500 hover:text-white text-gray-700" wire:click="closeModal">
            Cancelar
        </button>
    </div>
</x-modal.modal-sm>
