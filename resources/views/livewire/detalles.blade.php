<x-content>
    <x-slot name="import">
        @if ($open == true)
        @include('pages.campanias.detalles.challenge')
        @endif
    </x-slot>
    <div class="mb-3 flex items-center justify-between">
        <x-form.search id="search" wire:model="search" placeholder="Buscar..." />
        <div>

        </div>
    </div>

    <x-table.table>
        <x-slot name="theader">
            @if ($user->isAdmin())
            <x-table.th class="pl-3">Id</x-table.th>
            @endif
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            {{-- <x-table.th>Estatus</x-table.th> --}}
            @if ($user->isAdmin())
            <x-table.th>Usuario</x-table.th>
            @endif

            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr class="border-l-4 border-[{{ $campania->display }}]">
            @if ($user->isAdmin())
            <x-table.td class="">{{ $campania->id }}</x-table.td>
            @endif
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

            <x-table.td>
                @if ($campania->status == 'Confirmado')
                <span class="text-green-700 bg-green-200 py-1 px-2 rounded-md hover:text-green-600 ">
                    {{ $campania->status }}
                </span>
                @else
                {{ $campania->status }} - {{ $campania->hold }}
                @endif
            </x-table.td>
            <x-table.td>
                <div class="flex flex-col ">
                    <span class="text-xs text-gray-700 font-medium">{{ $campania->formatoMx($campania->start) }}</span>
                    <span class="text-xs text-gray-500">{{ $campania->formatoMx($campania->end) }}</span>
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
            {{-- <x-table.td class="text-green-700 flex items-center justify-center text-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </x-table.td> --}}

            @if ($user->isAdmin())
            <x-table.td>
                <div class="flex flex-col justify-start">
                    <span class="text-sm font-medium">{{ $campania->user->name }}</span>
                    <span class="text-xs lowercase">{{ $campania->user->email }}</span>
                </div>
            </x-table.td>
            @endif

            <x-table.td>
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
            </x-table.td>

        </x-table.tr>
        @empty

        @endforelse
    </x-table.table>
    <div>
        {{ $campanias->links() }}
    </div>
</x-content>
