<x-material-layout :activePage="'challenge'" :menuParent="'calendario'">
    <x-slot name="title">Challenge</x-slot>
    <x-slot name="titlePage">Eventos</x-slot>
    <x-content>
        <x-slot name="import"></x-slot>
        <div class="" x-data="{ tab: 'challenge' }">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active ' : tab === 'challenge' }"
                        @click.prevent="tab = 'challenge'">
                        <span class="material-icons">event_available</span>
                        <span class="ml-2">Challenge | Confirmar</span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'itext-blue-600 border-blue-600 active' : tab === 'confirmar' }"
                        @click.prevent="tab = 'confirmar'">
                        <span class="material-icons">edit_calendar</span>
                        <span class="ml-2">Cierre de campaña</span>

                    </a>
                </li>
            </ul>
            <div class=" bg-white  py-4">
                <div x-show="tab === 'challenge'">
                    <livewire:campanias.challenge />
                </div>
                <div x-show="tab === 'confirmar'">
                    <livewire:campanias.confirmados />
                </div>
            </div>
        </div>
    </x-content>


    @push('js')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
    @endpush
</x-material-layout>
