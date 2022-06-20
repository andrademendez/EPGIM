<x-modal.modal-sm>

    @if ($id_campania == $camp_first)
    <x-slot name="modalhead">Solicitud de confirmación </x-slot>

    @else
    <x-slot name="modalhead">Solicitud de challenge </x-slot>
    @endif



    <div class="py-2">
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Fecha</x-table.th>
                <x-table.th>Estatus</x-table.th>
                <x-table.th>Proceso</x-table.th>
                <x-table.th></x-table.th>
            </x-slot>
            @forelse ($attachStatusFile as $attach)
            <x-table.tr>
                <x-table.td>{{ $attach->created_at }}</x-table.td>
                <x-table.td>
                    <x-badge>{{ $attach->status }}</x-badge>
                </x-table.td>

                <x-table.td>
                    @if ($attach->process == 'Confirmacion')
                    <x-badge class="bg-green-200 text-[#23752a]">{{ $attach->process }}</x-badge>
                    @else
                    <x-badge>{{ $attach->process }}</x-badge>
                    @endif
                </x-table.td>
                <x-table.td class="">
                    <button class="bg-sky-200 text-sky-700 rounded-full p-1" type="button"
                        wire:click="openAddDocs({{ $attach->id }})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </button>
                </x-table.td>
            </x-table.tr>
            <x-table.tr>
                <x-table.td colspan="4">
                    <div class="flex space-x-2">
                        @foreach ($attach->filesStatus as $filesStatus)
                        <a href="{{ $filesStatus->file }}" target="_blank" rel="noopener noreferrer" class="h-16 w-14">
                            <img src="{{ asset('images/test/pdf.png') }}" alt="" srcset="" class="h-16 w-14">
                        </a>

                        @endforeach
                    </div>
                </x-table.td>
            </x-table.tr>


            @if ($attach->comment && $attach->status == 'Pendiente')
            <x-table.tr>
                <x-table.td colspan="4">
                    <div class="text-sm text-center">
                        <h1 class="mb-3 text-xs text-green-700">Comentario del administrador</h1>
                        <span class="text-xs">{{ $attach->comment }}</span>
                    </div>
                </x-table.td>
            </x-table.tr>
            @endif
            @empty
            @if ($id_campania == $camp_first)
            <x-table.tr>
                <x-table.td colspan="4">
                    <div class="text-sm text-center">
                        <button type="button" wire:click="sendConfirmation()"
                            class="bg-indigo-500 px-4 py-3  text-white text-sm uppercase hover:bg-indigo-600 rounded">
                            Envíar Solicitud
                        </button>
                    </div>
                </x-table.td>
            </x-table.tr>
            @else
            <x-table.tr>
                <x-table.td colspan="4">
                    <div class="text-sm text-center">
                        <button wire:click="sendChallenge()"
                            class="bg-indigo-500 px-4 py-3  text-white text-sm uppercase hover:bg-indigo-600 rounded">
                            Envíar Solicitud
                        </button>

                    </div>
                </x-table.td>
            </x-table.tr>
            @endif
            @endforelse


        </x-table.table>
    </div>
    @if ($openForm == "AddDocs")
    <div>
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div
                class="mt-1 flex items-center justify-between px-4 pt-2 pb-3 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center w-full" x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class=" text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Seleccione un archivo</span>
                            <input id="file-upload" wire:model="documentos" name="file-upload" type="file"
                                class="sr-only" accept=".docx,.pdf">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">
                        DOCX, PDF To 10MB
                    </p>
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                @if (empty($documentos))

                @else
                <button type="button"
                    class=" text-purple-700 hover:text-purple-600 flex items-center justify-center px-2 py-1.5 text-xs uppercase bg-purple-200 rounded-full"
                    wire:click.prevent="attachFiles()">
                    Guardar
                </button>
                @endif
            </div>
        </form>
    </div>
    @endif
</x-modal.modal-sm>
