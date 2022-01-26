<x-modal.modal-sm>
    <x-slot name="modalhead">Notificar pendiente</x-slot>
    <form method="post">
        @csrf
        <div class="mt-3">
            <x-form.textarea wire:model="comentario" rows="4" placeholder="Proporcionar detalle del porque no se ha validado la solicitud" required />

        </div>
        <div class="mt-3 flex items-center justify-center">
            <x-button class="py-2" wire:click.prevent="pendiente">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                </svg>
                <span class="pl-2 text-xs">Notificar al propietario</span>

            </x-button>
        </div>
    </form>
</x-modal.modal-sm>
