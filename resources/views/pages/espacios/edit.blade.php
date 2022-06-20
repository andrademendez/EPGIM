<x-material-layout :activePage="'espacios'" :menuParent="'espacios'">
    <x-slot name="title">Espacio</x-slot>
    <x-slot name="titlePage">Editar Espacio - {{ $espacio->nombre }}</x-slot>

    <div class="mx-2 my-3">
        <div class="grid grid-cols-4 gap-2">
            <div class="px-4 py-3 col-span-4 md:col-span-2 bg-white   rounded-lg shadow-lg ">
                <div>
                    <livewire:espacio.editar-espacio :id_espacio="$espacio->id" />
                </div>

            </div>
            <div class="h-auto px-4  pt-3 pb-1  col-span-4 md:col-span-2 border border-gray-200 rounded-lg shadow-lg">
                <div>
                    <livewire:espacio.campanias :id_espacio="$espacio->id" />
                </div>

            </div>
        </div>
    </div>

</x-material-layout>
