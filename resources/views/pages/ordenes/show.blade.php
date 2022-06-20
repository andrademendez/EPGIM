<x-material-layout :activePage="'ordenes'" :menuParent="'operacion'">
    <x-slot name="title">Detalles - Ordenes de servicios</x-slot>
    <x-slot name="titlePage">Detalles - Ordenes de servicios</x-slot>

    <div class="m-3 px-3 py-4 bg-white">
        <div class="px-3 py-2 bg-indigo-800 text-white shadow-lg text-center">
            <h1 class="uppercase text-lg font-medium">Datos de la orden de servicio</h1>
        </div>
        <div class="my-3">
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-1">
                    <div class="shadow-xl p-3">
                        <div class="uppercase px-3 font-medium text-lg">
                            <h1>Datos del espacio</h1>
                        </div>
                        <div class="mt-4">
                            <ul class="space-y-3">
                                {{-- <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Clave: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->clave}}</span>
                                    </div>

                                </li> --}}
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Nombre: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->nombre}}</span>
                                    </div>

                                </li>
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Referencia: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->referencia }}</span>
                                    </div>

                                </li>
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Medidas: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->medidas }}</span>
                                    </div>

                                </li>
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Unidad: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->unidad->nombre }}</span>
                                    </div>
                                </li>
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Unidad: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->tipo->nombre }}</span>
                                    </div>
                                </li>
                                <li class=" px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Ubicación: </h4>
                                        <span>{{ $orden->espacios($orden->ubicacion)->ubicacion->nombre }}</span>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-span-1">
                    <div class="shadow-xl p-3">
                        <div class="uppercase px-3 font-medium text-lg">
                            <h1>Datos de la campaña</h1>
                        </div>
                        <div class="my-4">
                            <ul>
                                <li class="mt-3 px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Campaña: </h4>
                                        <span>{{ $orden->campania->title }}</span>
                                    </div>
                                </li>
                                <li class="mt-3 px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Fecha: </h4>
                                        <span>{{ $orden->campania->dateFormato($orden->campania->start) }} - {{
                                            $orden->campania->dateFormato($orden->campania->end) }}</span>
                                    </div>
                                </li>
                                <li class="mt-3 px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Slot: </h4>
                                        <span>{{ $orden->campania->slot }} </span>
                                    </div>
                                </li>
                                <li class="mt-3 px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Usuario: </h4>
                                        <span>{{ $orden->campania->user->name }} </span>
                                    </div>
                                </li>
                                <li class="mt-3 px-2 py-2 border-b border-gray-200 hover:bg-gray-100">
                                    <div class="flex space-x-2">
                                        <h4 class="font-medium">Cliente: </h4>
                                        <span>{{ $orden->campania->cliente->nombre }} </span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            <div class="grid grid-cols-4 gap-3">
                <div class=" col-span-2  shadow-xl p-3">
                    <div class="bg-white">
                        <div class="text-lg font-medium uppercase text-gray-900 my-3">
                            <h1>Actividad</h1>
                        </div>
                        <div class="mt-3 px-2 py-2">
                            <div class="py-2 px-2 border-b border-gray-200 hover:bg-gray-100">
                                <span class="">{{ $orden->actividad->nombre }}</span>
                            </div>
                            <div class="mt-3">
                                <h5 class="text-lg font-medium text-gray-900">Responsables: </h5>
                            </div>
                            <div class="mt-3 px-3 py-2 border-b border-gray-200 hover:bg-gray-100">
                                <ul class="list-inside list-disc space-y-3">
                                    @foreach ($orden->responsables($orden->actividad->id) as $depa)
                                    @foreach ($depa->users as $user)
                                    <li>
                                        {{ $user->name }}
                                    </li>
                                    @endforeach

                                    @endforeach
                                </ul>
                            </div>

                            <div class="mt-3">
                                <h1 class="text-lg font-medium text-gray-900">Comentarios:</h1>
                                <div class="mt-3 border-l-2 border-gray-500 px-3">
                                    <p class="font-serif">
                                        {{ $orden->comentarios }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-right">
                                    <span class="text-lg font-medium text-gray-500">Fecha expericion:</span>
                                    <span class="font-serif"> {{ $orden->created_at }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 ">
                    <div class="shadow-xl p-3">
                        <livewire:operaciones.validar-orden :orden_id="$orden->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-material-layout>
