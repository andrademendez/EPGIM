<x-material-layout :activePage="'configuracion'" :menuParent="'calendario'">
    <x-slot name="title">Overview</x-slot>
    <x-slot name="titlePage">Espacios </x-slot>
    <div class=" px-2 py-3 mt-2  bg-white shadow-sm m-2 rounded-lg">

        @if (auth()->user()->isAdmin() || auth()->user()->isMonitor())
        <div class="" x-data="{ tab: 'espacios' }">
            <ul class="flex flex-wrap px-3">
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'espacios' }"
                        @click.prevent="tab = 'espacios'">
                        <span class="material-icons">view_week</span>
                        <span class="ml-2">Espacios</span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active ' : tab === 'campañas' }"
                        @click.prevent="tab = 'campañas'">
                        <span class="material-icons">calendar_month</span>
                        <span class="ml-2">
                            Campañas
                        </span>

                    </a>
                </li>

            </ul>
            <div class=" bg-white  py-4">
                <div x-show="tab === 'espacios'">
                    <livewire:espacio.abstracto />
                </div>
                <div x-show="tab === 'campañas'">
                    <livewire:campanias.configuracion />
                </div>


            </div>
        </div>
        @else
        <livewire:espacio.abstracto />
        @endif

    </div>

</x-material-layout>
