<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} Medio </x-slot>
    <div>
        <form action="#" method="post">
            <div class="pt-4">
                <x-form.label for="nombre">Nombre</x-form.label>
                <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre de la unidad" class="w-full" required />
            </div>
            <div class="pt-4 flex justify-end">
                <x-form.btn-primary wire:click.prevent="store()">{{ $action }}</x-form.btn-primary>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
