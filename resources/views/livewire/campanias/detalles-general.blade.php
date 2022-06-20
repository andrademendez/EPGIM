<div>
    <div class="m-2 p-4 bg-white rounded shadow-lg">
        <div class="flex justify-end">
            <a class="px-1 py-2 border-b border-gray-300 hover:border-gray-400 flex space-x-2 items-center uppercase text-xs"
                href="{{ route('campania.detalles') }}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span> Regresar a campaña </span>

            </a>
        </div>
        <div class="my-3 pxx-3 py-2">
            <x-timeline>
                <x-timeline-item class="relative mb-6 sm:mb-0">
                    <x-slot name="title">Creado</x-slot>
                    <span>Released on December 2, 2021</span>
                </x-timeline-item>
                <x-timeline-item class="relative mb-6 sm:mb-0">
                    <x-slot name="title">Confirmado</x-slot>
                    <span>Released on December 2, 2021</span>
                </x-timeline-item>
                <x-timeline-item class="relative mb-6 sm:mb-0">
                    <x-slot name="title">Cerrado</x-slot>
                    <span>Released on December 2, 2021</span>
                </x-timeline-item>
            </x-timeline>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <div class="col-span-2">
                <div class="rounded shadow-lg p-3">
                    <ul class="space-y-4">
                        <li>
                            <span class="text-base font-bold">Title: </span>
                            <span>{{ $campania->title }}</span>
                        </li>
                        <li>
                            <span class="text-base font-bold">Periodo: </span>

                            <span>{{ $campania->formatoMx( $campania->start) }} - {{
                                $campania->formatoMx($campania->end) }}</span>
                        </li>
                        <li>
                            <div class="">
                                <span class="text-base font-bold">Estatus: </span>
                                <span>{{ $campania->status }} - {{ $campania->hold }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="">
                                <span class="text-base font-bold">Usuario: </span>
                                <span>{{ $campania->user->name }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="">
                                <div class="flex space-x-2">
                                    <span class="text-base font-bold">Cliente: </span>
                                    <span class="block">{{ $campania->cliente->nombre }}</span>
                                </div>

                                <div class="mt-2">

                                    <div class="flex flex-col text-xs">

                                        <span>Contacto: {{ $campania->cliente->contacto }}</span>
                                        <span>Telefono: {{ $campania->cliente->telefono }}</span>
                                        <span> Correo: {{ $campania->cliente->email }}</span>
                                    </div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mt-3 rounded shadow-lg p-2">
                    <div class="mb-3 py-2">
                        <h1 class="uppercase text-lg text-center font-bold">Espacios</h1>
                    </div>
                    @foreach ($campania->espacios as $espacio)
                    <ul class="mb-3 space-y-2 hover:bg-gray-50 px-2 hover:shadow-md py-2">
                        <li>
                            <div class="flex space-x-2 ">
                                <h1 class="text-base font-medium">Nombre: </h1>
                                <span>{{ $espacio->nombre }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Referencia: </h1>
                                <span>{{ $espacio->referencia }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Medidas: </h1>
                                <span>{{ $espacio->medidas }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Clave: </h1>
                                <span>{{ $espacio->clave }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Tipo: </h1>
                                <span>{{ $espacio->tipo->nombre }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Unidad</h1>
                                <span>{{ $espacio->unidad->nombre }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="flex space-x-2">
                                <h1 class="text-base font-medium">Ubicación: </h1>
                                <span>{{ $espacio->ubicacion->nombre }}</span>
                            </div>
                        </li>
                    </ul>
                    <hr class="my-2">
                    @endforeach

                </div>
            </div>
            <div class="col-span-2">
                <div class="rounded shadow-lg p-3">
                    <div class="">
                        <h1>Documentos</h1>
                    </div>
                    <div>
                        <div class="flex space-x-2 items-center justify-center">
                            @foreach ($campania->attachStatusFile as $attach)
                            @if ($attach->process == 'Confirmacion')
                            @foreach ($attach->filesStatus as $files)
                            <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('images/test/pdf.png') }}" class="h-12" alt="" srcset="">
                            </a>
                            @endforeach

                            @continue
                            @endif

                            @if ($attach->process == 'Cierre')
                            @foreach ($attach->filesStatus as $files)
                            <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('images/test/jpeg.png') }}" class="h-12" alt="" srcset="">
                            </a>
                            @endforeach
                            @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="mt-3 rounded shadow-lg p-3">
                    <div class="">
                        <h1>Cotización</h1>
                    </div>
                    <div class="flex flex-col items-center justify-center space-y-2">
                        @if (isset($campania->cotizacion->folio))
                        <a href="{{ $campania->cotizacion->archivo }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('images/test/pdf.png') }}" class="h-12" alt="" srcset="">
                        </a>
                        <span class="text-xs">No. Co.: {{ $campania->cotizacion->folio }}</span>
                        @else

                        @endif
                    </div>
                </div>
                <div class="mt-3 rounded shadow-lg p-3">
                    <div class="">
                        <h1>Ordenes de Servicios</h1>
                    </div>
                    <div class="mt-3 flex items-center justify-center space-x-3">
                        @foreach ($campania->ordenesServicios as $orden)
                        <div class="flex flex-col space-y-2">
                            <a href="{{ $orden->archivo}}" target="_blanc">
                                <img src="{{ asset('images/test/pdf.png') }}" class="h-12" alt="" srcset="">
                            </a>
                            <span class="text-xs text-center">{{ $orden->actividad->nombre }}</span>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
