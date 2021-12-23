<x-modal.modal-md>
    <x-slot name="modalhead"> {{ $action }} Registro </x-slot>
    <div>
        <form action="#" method="post">
            <div class="grid grid-cols-4 gap-4">
                <div class="pt-2 col-span-2">
                    <x-form.label for="nombre">Clave</x-form.label>
                    <x-input type="text" wire:model="nombre" name="nombre" id="nombre" placeholder="nombre" class="w-full" />
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="nombre">Nombre</x-form.label>
                    <x-input type="text" name="nombre" wire:model="nombre" id="nombre" placeholder="Nombre de la unidad" class="w-full" />
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="start">Fecha Inicio</x-form.label>
                    <x-input type="text" name="start" wire:model="start" id="start" placeholder="Fecha inicio" class="w-full" />
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="end">Fecha Fin</x-form.label>
                    <x-input type="text" name="end" wire:model="end" id="end" placeholder="Fecha fin" class="w-full" />
                </div>

            </div>
            <div class="pt-4 flex justify-end">
                <x-form.btn-primary wire:click.prevent="store">Guardar</x-form.btn-primary>
            </div>

        </form>
    </div>
</x-modal.modal-md>
