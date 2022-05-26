<x-content>
    <x-slot name="import">
        @if ($open == true)
        @if ($action == "Orden de Servicio")
        @include('pages.campanias.detalles.ordenes')
        @else
        @include('pages.campanias.detalles.challenge')
        @endif

        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search id="search" wire:model="search" placeholder="Buscar..." />
        <div class="flex items-center justify-center space-x-2">
            <div>
                <x-button class="space-x-2 rounded py-2 bg-indigo-600" type="button" wire:click="exportExcel">
                    <span>Descargar</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                </x-button>
            </div>

            <div>
                <x-form.select wire:model="searchStatus">
                    <option value="">Estatus</option>
                    <option value="Solicitud">Solicitud</option>
                    <option value="Challenge">Challenge</option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Cerrado">Cerrado</option>
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchUnidad">
                    <option value="">Unidades</option>
                    @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchMedio">
                    <option value="">Medios</option>
                    @foreach ($medios as $medio)
                    <option value="{{ $medio->id }}">{{ $medio->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div>
                <x-form.select wire:model="searchUbicacion">
                    <option value="">Ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                    @endforeach
                </x-form.select>
            </div>
            @if ($searchStatus || $searchUnidad || $searchMedio || $searchUbicacion )
            <div>
                <x-form.btn-icons type="button" wire:click="resetear">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd"></path>
                    </svg>
                </x-form.btn-icons>
            </div>
            @endif
            <!-- medio, unidad de negocio, ubicacion -->
        </div>
    </div>

    <x-table.table>
        <x-slot name="theader">
            <x-table.th class="pl-3">Id</x-table.th>

            <x-table.th>Nombre</x-table.th>
            <x-table.th>Costo</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            {{-- <x-table.th>Estatus</x-table.th> --}}

            <x-table.th>Usuario</x-table.th>
            <x-table.th>Archivos</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr class="">

            <x-table.td class="">
                {{ $campania->id }}
            </x-table.td>
            <x-table.td class="">
                <div class="text-left">
                    <div class="text-xs font-medium text-gray-800">
                        {{ $campania->title }}
                    </div>
                    <div class=" text-xs text-gray-500 lowercase">
                        {{ $campania->cliente->nombre }}
                    </div>
                </div>
            </x-table.td>
            <x-table.td class="">${{ number_format($campania->costoCampania($campania->id), 2) }}</x-table.td>

            <x-table.td>
                @if ($campania->status == 'Confirmado')
                <span class="text-orange-700 bg-orange-100 py-1 px-2 rounded-md hover:text-orange-600 ">
                    {{ $campania->status }}
                </span>
                @elseif ($campania->status == 'Cerrado')
                <span class="text-green-700 bg-green-100 py-1 px-2 rounded-md hover:text-green-800 ">
                    {{ $campania->status }}
                </span>
                @else
                {{ $campania->status }} - {{ $campania->hold }}
                @endif
            </x-table.td>
            <x-table.td>
                <div class="flex flex-col ">
                    <span class="text-xs text-gray-700 font-medium">
                        {{ $campania->formatoMx($campania->start) }}
                    </span>
                    <span class="text-xs text-gray-500">
                        {{ $campania->formatoMx($campania->end) }}
                    </span>
                </div>
            </x-table.td>
            <x-table.td>{{ $campania->medio->nombre }}</x-table.td>
            <x-table.td class="whitespace-normal">
                @foreach ($campania->espacios as $espacio)
                <div class="flex flex-col mb-1">
                    <span class="text-xs font-medium text-gray-700">
                        {{ $espacio->nombre }}
                    </span>
                    <span class="text-xs text-gray-500 capitalize">
                        {{ $espacio->unidad->nombre }}
                    </span>
                </div>
                @endforeach
            </x-table.td>

            <x-table.td>
                <div class="flex flex-col justify-start">
                    <span class="text-sm font-medium">{{ $campania->user->name }}</span>
                    <span class="text-xs lowercase">{{ $campania->user->email }}</span>
                </div>
            </x-table.td>
            <x-table.td>
                @if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado')
                <div class="flex flex-col">
                    <div class="my-2 text-center">
                        <span>Mis archivos</span>
                    </div>
                    <div class="flex space-x-2 items-center justify-center">
                        @foreach ($campania->attachStatusFile as $attach)
                        @if ($attach->process == 'Confirmacion')
                        @foreach ($attach->filesStatus as $files)
                        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('images/test/jpeg.png') }}" class="h-9" alt="" srcset="">
                        </a>
                        @endforeach

                        @continue
                        @endif
                        @if ($attach->process == 'Cierre')
                        @foreach ($attach->filesStatus as $files)
                        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('images/test/pdf.png') }}" class="h-9" alt="" srcset="">
                        </a>
                        @endforeach
                        @endif
                        @endforeach
                    </div>

                </div>
                @else
                <div class="flex items-center justify-center">
                    <button type="button"
                        class="rounded-full  p-1.5 bg-[#e0f1f8] ml-2 text-[#30a3cf] hover:text-[#2bb1e6] focus:outline-none focus:ring-transparent disabled:opacity-25 transition ease-in-out duration-150"
                        wire:click="openModal({{ $campania->id }})" title="Challenge">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endif
            </x-table.td>

            <x-table.td>
                @if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado')
                <a href="{{ route('campania.ordenes', $campania->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-purple-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </a>
                {{-- <x-form.btn-icons wire:click="openOrden({{ $campania->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                </x-form.btn-icons> --}}
                @endif

            </x-table.td>
        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>
    <div class="py-2 flex justify-end">
        {{ $campanias->links() }}
    </div>
</x-content>
