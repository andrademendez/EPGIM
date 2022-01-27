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
            <x-table.th>Nombre</x-table.th>
            <x-table.th>Estado</x-table.th>
            <x-table.th>Fecha</x-table.th>
            <x-table.th>Medio</x-table.th>
            <x-table.th>Espacios</x-table.th>
            <x-table.th>Estatus</x-table.th>
            @if ($user->isAdmin())
            <x-table.th>User</x-table.th>
            @endif

            <x-table.th></x-table.th>
        </x-slot>
        @forelse ($campanias as $campania)
        <x-table.tr>
            <x-table.td class="border-l-4 border-[{{ $campania->display }}]">
                <div class="text-left pl-2">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $campania->title }}
                    </div>
                    <div class=" text-xs text-gray-500 uppercase">
                        {{ $campania->cliente->nombre }}
                    </div>
                </div>
            </x-table.td>

            <x-table.td>{{ $campania->status }} - {{ $campania->hold }}</x-table.td>
            <x-table.td>
                <div class="flex flex-col ">
                    <span class="text-sm text-gray-700">{{ $campania->formatoMx($campania->start) }}</span>
                    <span class="text-xs text-gray-500">{{ $campania->formatoMx($campania->end) }}</span>
                </div>
            </x-table.td>
            <x-table.td>{{ $campania->medio->nombre }}</x-table.td>
            <x-table.td class="whitespace-normal">
                @forelse ($campania->espacios as $espacio)
                {{ $espacio->nombre }}
                @if ($loop->remaining)
                ,
                @endif
                @empty
                <span>No has asignado ningun espacio</span>
                @endforelse
            </x-table.td>
            <x-table.td class="text-green-700 flex items-center justify-center text-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </x-table.td>

            @if ($user->isAdmin())
            <x-table.td>
                <div class="flex flex-col items-center">
                    <span class="text-sm font-medium">{{ $campania->user->name }}</span>
                    <span class="text-xs lowercase">{{ $campania->user->email }}</span>
                </div>
            </x-table.td>
            @endif

            <x-table.td>
                <div class="flex items-center justify-center">
                    <button
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
