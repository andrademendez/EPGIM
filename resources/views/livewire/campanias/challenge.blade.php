<div>
    <div>
        @if ($open == true)
        @if ($action == 'Pendiente')
        @include('pages.challenge.pendiente')
        @elseif ($action == 'Confirmar')
        @include('pages.challenge.confirmar')
        @endif
        @endif
    </div>
    <div class="mb-3">
        <div class="">
            <x-form.search type="text" placeholder="Buscar..." wire:model="search" />
        </div>
    </div>
    <x-table.table>
        <x-slot name="theader">
            <x-table.th>Campaña</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Creado</x-table.th>
            <x-table.th>Usuario</x-table.th>
            <x-table.th>Espacios</x-table.th>
            <x-table.th>Estatus</x-table.th>
            <x-table.th>Proceso</x-table.th>
            <x-table.th>Archivo</x-table.th>
            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $camp)
        <x-table.tr>

            <x-table.td>
                <div>
                    <h1 class="text-xs font-medium text-gray-700">{{ $camp->campania->title }}</h1>
                    <span class="text-xs text-gray-500">{{ $camp->campania->cliente->nombre }}</span>
                </div>
            </x-table.td>
            <x-table.td class="whitespace-nowrap">
                <div class="flex flex-col ">
                    <span class="text-xs font-medium text-gray-700">{{
                        $camp->campania->formatoMx($camp->campania->start) }}</span>
                    <span class="text-xs text-gray-500">{{ $camp->campania->formatoMx($camp->campania->end) }}</span>
                </div>
            </x-table.td>

            <x-table.td class="whitespace-nowrap">
                <span>{{ $camp->campania->formatoMx($camp->created_at ) }}</span>
            </x-table.td>
            <x-table.td>
                <div class="flex flex-col">
                    <span class="text-gray-700 font-medium">
                        {{ $camp->campania->user->name }}
                    </span>
                    <span class="text-xs lowercase text-gray-500">{{ $camp->campania->user->email }}</span>
                </div>
            </x-table.td>
            <x-table.td>
                @foreach ($camp->campania->espacios as $espacio)
                {{ $espacio->nombre }}
                @if ($loop->remaining)
                ,
                @endif
                @endforeach
            </x-table.td>
            <x-table.td>
                <x-badge>{{ $camp->status }}</x-badge>
            </x-table.td>

            <x-table.td>
                <x-badge class="text-[#163672] bg-[#eed6f5]">{{ $camp->process }}</x-badge>
            </x-table.td>

            <x-table.td class="whitespace-nowrap">
                <div class="flex items-center justify-center">
                    @forelse ($camp->filesStatus as $key => $file)

                    <a href="{{ $file->file }}" target="_blank" rel="noopener noreferrer">
                        <span class="iconify h-10 w-10" data-icon="vscode-icons:file-type-pdf2"></span>
                    </a>
                    @empty
                    <span></span>
                    @endforelse
                </div>
            </x-table.td>
            <x-table.td class="whitespace-nowrap">
                @if ($camp->campania->status == 'Challenge' || $camp->campania->status == 'Solicitud')

                <div>
                    <button class="text-orange-400 bg-red-200 mr-2 rounded-full p-1.5" title="En espera de documentos"
                        wire:click="openPendiente({{ $camp->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="text-green-600 bg-green-200 rounded-full p-1.5"
                        wire:click="openConfirmar({{ $camp->id }})" title="Confirmar campaña">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                </div>
                @endif

            </x-table.td>

        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>
</div>
