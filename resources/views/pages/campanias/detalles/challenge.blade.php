<x-modal.modal-sm>
    @if ($id_campania == $camp_first)
    <x-slot name="modalhead">Solicitud de confirmación </x-slot>

    @else
    <x-slot name="modalhead">Solicitud de challenge </x-slot>
    @endif

    @if (empty($attachStatusFile) )
    <div class="inline-block  px-2 pb-4">
        <h1 class="text text-gray-700 text-sm">No dispone actualmente de alguna solicitud</h1>
        <div class="flex items-center mt-2">
            @if ($id_campania == $camp_first)
            <button wire:click="sendConfirmation()"
                class="bg-indigo-500 px-3 py-2  text-white text-xs uppercase hover:bg-indigo-600 rounded-md">Envíar
                Solicitud</button>
            @else
            <button wire:click="sendChallenge()"
                class="bg-indigo-500 px-3 py-2  text-white text-xs uppercase hover:bg-indigo-600 rounded-md">Envíar
                Solicitud</button>
            @endif
        </div>
    </div>

    @else
    <div class="py-2">
        <x-table.table>
            <x-slot name="theader">
                <x-table.th>Fecha</x-table.th>
                <x-table.th>Estatus</x-table.th>
                <x-table.th>Proceso</x-table.th>
            </x-slot>
            <x-table.tr>
                <x-table.td>{{ $attachStatusFile->created_at }}</x-table.td>
                <x-table.td>
                    <x-badge>{{ $attachStatusFile->status }}</x-badge>
                </x-table.td>

                <x-table.td>
                    @if ($attachStatusFile->process == 'Confirmacion')
                    <x-badge class="bg-green-200 text-[#23752a]">{{ $attachStatusFile->process }}</x-badge>
                    @else
                    <x-badge>{{ $attachStatusFile->process }}</x-badge>

                    @endif

                </x-table.td>
            </x-table.tr>
            @if ($attachStatusFile->comment && $attachStatusFile->status == 'Pendiente')
            <x-table.tr>
                <x-table.td colspan="3">
                    <div class="text-sm text-center">
                        <h1 class="mb-3 text-xs text-green-700">Comentario del administrador</h1>
                        <span class="text-xs">{{ $attachStatusFile->comment }}</span>
                    </div>
                </x-table.td>
            </x-table.tr>
            @endif
        </x-table.table>
    </div>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div
                class="mt-1 flex items-center justify-between px-4 pt-2 pb-3 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center w-full" x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <div class=" text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Seleccion un archivo</span>
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
                <button
                    class=" text-purple-700 hover:text-purple-600 flex items-center justify-center p-1 bg-purple-200 rounded-full"
                    wire:click.prevent="attachFiles()">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                        </path>
                        <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                    </svg>
                </button>
                @endif

            </div>

        </form>
    </div>

    @if (empty($attachStatusFile) )
    <span>cargar los archivos</span>
    @else
    <div class="">
        <div class="grid grid-cols-2 gap-1">
            @forelse ($attachStatusFile->filesStatus as $filesStatus)
            <div>
                <iframe src="{{ $filesStatus->file }}" class="w-full"></iframe>

            </div>

            @empty
            <div class="col-span-2">
                <span>No integrado ningun archivo a la solicitud</span>
            </div>
            @endforelse
        </div>
    </div>

    @endif

    @endif
</x-modal.modal-sm>
