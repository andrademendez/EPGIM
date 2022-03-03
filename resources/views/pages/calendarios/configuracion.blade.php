<x-material-layout :activePage="'configuracion'" :menuParent="'calendario'">
    <x-slot name="title">Overview</x-slot>
    <x-slot name="titlePage">Overview </x-slot>
    <div class=" px-2 py-3 mt-2  bg-white shadow-sm m-2 rounded-lg">
        <div class="" x-data="{ tab: 'tipos' }">
            <ul class="flex flex-wrap px-3">
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active ' : tab === 'tipos' }"
                        @click.prevent="tab = 'tipos'">
                        <span class="material-icons">calendar_month</span>
                        <span class="ml-2">
                            Campañas
                        </span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'medios' }"
                        @click.prevent="tab = 'medios'">
                        <span class="material-icons">view_week</span>
                        <span class="ml-2">Espacios</span>

                    </a>
                </li>
            </ul>
            <div class=" bg-white  py-4">
                <div x-show="tab === 'tipos'">
                    <livewire:campanias.configuracion />
                </div>
                <div x-show="tab === 'medios'">
                    <livewire:espacio.abstracto />
                </div>

            </div>
        </div>
    </div>

</x-material-layout>
