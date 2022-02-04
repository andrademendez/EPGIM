<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == 'Registrar')
        @include('pages.espacios.create')
        @else
        @include('pages.roles.delete')
        @endif

        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search type="search" name="search" id="search" wire:model="search" placeholder="Buscar..." />
        <div>
            <x-form.btn-primary wire:click="openModal()">
                <span class="pl-1">Agregar</span>
            </x-form.btn-primary>
        </div>

    </div>

    <x-table.table>

        <x-slot name="theader">
            <x-table.th>Id</x-table.th>
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Referencia</x-table.th>
            <x-table.th>Medidas</x-table.th>
            <x-table.th>Cant</x-table.th>
            <x-table.th>Clave</x-table.th>
            <x-table.th>Precio</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Unidad</x-table.th>
            <x-table.th>Tipo</x-table.th>
            <x-table.th>Ubicación</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($espacios as $espacio)
        <x-table.tr>
            <x-table.td>{{ $espacio->id }}</x-table.td>
            <x-table.td>{{ $espacio->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->referencia }}</x-table.td>
            <x-table.td>{{ $espacio->medidas }}</x-table.td>
            <x-table.td>{{ $espacio->cantidad }}</x-table.td>
            <x-table.td>{{ $espacio->clave }}</x-table.td>
            <x-table.td>${{ number_format($espacio->precio) }}.00</x-table.td>
            <x-table.td>
                @if ($espacio->estatus)
                Disponible
                @else
                Ocupado
                @endif
            </x-table.td>
            <x-table.td>{{ $espacio->unidad->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->tipo->nombre }}</x-table.td>
            <x-table.td>{{ $espacio->ubicacion->nombre }}</x-table.td>
            <x-table.td>
                <div class="flex items-center justify-center">
                    <a href="#" class="">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                            </path>
                        </svg>
                    </a>
                    <x-nav-link :href="route('espacios.edit', $espacio->id)" class="text-indigo-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </x-nav-link>
                    <button class="mx-2  text-red-500 focus:outline-none focus:ring-offset-transparent"
                        wire:click="openDelete( {{ $espacio->id }})">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </x-table.td>
        </x-table.tr>
        @empty
        <tr>
            <td colspan="9">
                <div class="text-center px-10 py-3 font-medium text-gray-500">
                    <span>No hay informacion que mostrar</span>
                </div>
            </td>
        </tr>
        @endforelse
    </x-table.table>

    <div class="">
        {{ $espacios->links() }}
    </div>
    {{-- <div class="mt-4">
        <div class="grid grid-cols-6 gap-4">
            @forelse ($espacios as $espacio)
            <div class="col-span-6 md:col-span-6">
                <div
                    class="max-h-72 grid grid-cols-5 gap-2 bg-white rounded-lg border shadow-lg md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="col-span-2">
                        <img class="object-cover w-full h-64 rounded-t-lg  md:rounded-none md:rounded-l-lg"
                            src="images/test/image-4.jpg" alt="">
                    </div>
                    <div class="col-span-2">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text- estxl font-bold tracking-tight text-gray-900 dark:text-white">{{
                                $espacio->nombre }}</h5>
                            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">{{ $espacio->referencia }}</p>
                            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Medidas: {{ $espacio->medidas
                                }} | Cantidad: {{ $espacio->cantidad }}</p>
                            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">Precio: $ {{ $espacio->precio
                                }}.00</p>
                            <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">{{ $espacio->unidad->nombre }}
                            </p>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $espacio->tipo->nombre }} - {{
                                $espacio->ubicacion->nombre }}</p>
                        </div>
                    </div>
                    <div class="col-span-1 py-2 flex justify-between px-3">

                        <div class="flex items-end justify-center">
                            <button
                                class="text-xs uppercase text-center font-normal px-4 py-2 text-white bg-gray-800 rounded-md hover:bg-gray-700 duration-75">
                                Ver campañas
                            </button>
                        </div>
                        <div class="flex flex-col space-y-3 ">
                            <x-nav-link :href="route('espacios.edit', $espacio->id)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                            </x-nav-link>
                            <a href="#" class="text-red-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            @empty

            @endforelse
        </div>

    </div> --}}
</x-content>
