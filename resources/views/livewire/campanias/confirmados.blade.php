<div>
    <div>
        @if ($open == true)
        @include('pages.challenge.cerrar')
        @endif
    </div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="">
        <div class="mb-3">
            <x-form.search type="text" placeholder="Buscar..." wire:model="search" />
        </div>
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Id</x-table.th>
                <x-table.th>Campaña</x-table.th>
                <x-table.th>Creado</x-table.th>
                <x-table.th>Usuario</x-table.th>
                <x-table.th>Espacios</x-table.th>
                <x-table.th>Estatus</x-table.th>
                <x-table.th>Proceso</x-table.th>
                <x-table.th>Archivo</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @forelse ($campanias as $campania)
            <x-table.tr>
                <x-table.td>{{ $campania->id }}</x-table.td>
                <x-table.td>
                    <div>
                        <h1 class="text-xs font-medium text-gray-700">{{ $campania->title }}</h1>
                        <span class="text-xs text-gray-500">{{ $campania->cliente->nombre }}</span>
                    </div>
                </x-table.td>
                <x-table.td class="whitespace-nowrap">
                    <div class="flex flex-col ">
                        <span class="text-xs font-medium text-gray-700">{{
                            $campania->formatoMx($campania->start) }}</span>
                        <span class="text-xs text-gray-500">{{ $campania->formatoMx($campania->end)
                            }}</span>
                    </div>
                </x-table.td>
                <x-table.td>
                    <div class="flex flex-col">
                        <span class="text-gray-700 font-medium">
                            {{ $campania->user->name }}
                        </span>
                        <span class="text-xs lowercase text-gray-500">{{ $campania->user->email }}</span>
                    </div>
                </x-table.td>
                <x-table.td>
                    @foreach ($campania->espacios as $espacio)
                    {{ $espacio->nombre }}
                    @if ($loop->remaining)
                    ,
                    @endif
                    @endforeach
                </x-table.td>
                @if ($campania->attachStatusFile->count() == 2)
                @foreach ($campania->attachStatusFile as $attach)
                @if ($attach->process == 'Cierre')
                <x-table.td>
                    {{ $attach->status }}
                </x-table.td>

                <x-table.td>
                    {{ $attach->process }}
                </x-table.td>

                <x-table.td class="">
                    @if ($attach->filesStatus->count() == 0)
                    <div class="flex items-center justify-center text-green-500">
                        <span class="pr-2">Cerrar</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    @else
                    <div class="flex space-x-1">
                        @foreach ($attach->filesStatus as $files)
                        <a href="{{ $files->file }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $files->file }}" alt="" srcset="" class="w-6 h-7">
                        </a>

                        @endforeach
                    </div>

                    @endif

                </x-table.td>
                @endif
                @endforeach
                @endif
                <x-table.td class="whitespace-nowrap">
                    @if ($campania->status == 'Confirmado' )
                    @if ($campania->attachStatusFile->count() == 1)
                    <button class="w-full py-2 px-3 bg-indigo-700 font-medium text-white uppercase" type="button"
                        wire:click="registrarCierre({{ $campania->id }})">Cerrar campaña
                    </button>
                    @endif
                    @foreach ($campania->attachStatusFile as $attach)
                    @if ($attach->process == 'Cierre')

                    <div>
                        <button class="text-green-500 bg-green-100 rounded-full p-1.5"
                            wire:click="openModal({{ $attach->id }})" title="Cerrar campaña">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                <path fill-rule="evenodd"
                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @break

                    @endif

                    @endforeach

                    @endif
                </x-table.td>

            </x-table.tr>
            @empty

            @endforelse
        </x-table.table>
    </div>

</div>
