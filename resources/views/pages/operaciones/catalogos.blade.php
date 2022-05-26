<x-material-layout :activePage="'catalogos'" :menuParent="'operacion'">
    <x-slot name="title">Catálogos</x-slot>
    <x-slot name="titlePage">Catálogos</x-slot>
    <div class="mx-2 px-3 py-4 shadow-md rounded ">
        <div class="" x-data="{ tab: 'actividad' }">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active ' : tab === 'actividad' }"
                        @click.prevent="tab = 'actividad'">
                        <span class="material-icons">
                            fact_check
                        </span>
                        <span class="ml-2">
                            Actividades
                        </span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 "
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'tordenes' }"
                        @click.prevent="tab = 'tordenes'">
                        <span class="material-icons">checklist</span>
                        <span class="ml-2">Tipos de Ordenes</span>

                    </a>
                </li>
                <li class="mr-2">
                    <a href="#"
                        class="inline-block py-3 px-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300"
                        :class="{ 'text-blue-600 border-blue-600 active' : tab === 'tcontratos' }"
                        @click.prevent="tab = 'tcontratos'">
                        <span class="material-icons">description</span>
                        <span class="ml-2">Tipos de Contratos</span>

                    </a>
                </li>
            </ul>
            <div class=" bg-white  py-4">
                <div x-show="tab === 'actividad'">
                    <livewire:operaciones.actividades />
                </div>
                <div x-show="tab === 'tordenes'">
                    <livewire:operaciones.tipos-ordenes />
                </div>
                <div x-show="tab === 'tcontratos'">
                    <livewire:operaciones.tipos-contratos />
                </div>

            </div>
        </div>
    </div>


</x-material-layout>
