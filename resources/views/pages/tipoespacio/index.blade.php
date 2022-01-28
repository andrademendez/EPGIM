<x-material-layout :activePage="'tipoespacio'" :menuParent="'administracion'">
    <x-slot name="title">Tipos de Espacios</x-slot>
    <x-slot name="titlePage">Tipos de Espacios </x-slot>
    <x-content>
        <x-slot name="import">
        </x-slot>
        <div class="" x-data="{ tab: 'tipos' }">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active ' : tab === 'tipos' }"
                        @click.prevent="tab = 'tipos'">
                        <span class="material-icons">
                            dashboard_customize
                        </span>
                        <span class="ml-2">
                            Tipos de espacios
                        </span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'itext-blue-600 border-blue-600 active' : tab === 'medios' }"
                        @click.prevent="tab = 'medios'">
                        <span class="material-icons">spatial_tracking</span>
                        <span class="ml-2">Medios</span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300"
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'unidades' }"
                        @click.prevent="tab = 'unidades'">
                        <span class="material-icons">business</span>
                        <span class="ml-2">Unidades</span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300"
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'ciudades' }"
                        @click.prevent="tab = 'ciudades'">
                        <span class="material-icons">location_city</span>
                        <span class="ml-2">Ciudades</span>

                    </a>
                </li>
            </ul>
            <div class=" bg-white  py-4">
                <div x-show="tab === 'tipos'">
                    <livewire:tipo-espacio />
                </div>
                <div x-show="tab === 'medios'">
                    <livewire:medios />
                </div>
                <div x-show="tab === 'unidades'">
                    <livewire:unidades />
                </div>
                <div x-show="tab === 'ciudades'">
                    <livewire:ciudades />
                </div>

            </div>
        </div>

    </x-content>
</x-material-layout>
