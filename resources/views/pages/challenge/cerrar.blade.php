<x-modal.modal-sm>
    <x-slot name="modalhead">Cerrar Campaña</x-slot>
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
                            <span>Seleccion un archivo</span>
                            <input id="file-upload" wire:model="fotos" name="file-upload" type="file" class="sr-only"
                                accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">
                        JPEG, PNG To 5MB
                    </p>
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                @if (empty($fotos))

                @else
                <button
                    class=" text-purple-700 hover:text-purple-600 flex items-center justify-center p-1 bg-purple-200 rounded-full"
                    wire:click.prevent="attachFotos()" type="button">
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
    @if ($archivoT == 0 )
    <div class="p-2 my-2 text-center uppercase bg-gray-100">
        <span>Sin Archivos</span>
    </div>

    @else
    <div class="p-2 my-2 w-full">
        <button type="button" class="w-full uppercase text-xs px-3 py-2 bg-indigo-500 text-white hover:bg-indigo-800"
            wire:click="cerrarCampania">
            Cerrar campaña
        </button>
    </div>
    <div class="my-2 grid grid-cols-6">
        @foreach ($archivos as $arc)
        <div class="col-span-2">
            <img src="{{ $arc->file }}" alt="" class="w-full" srcset="">
        </div>
        @endforeach

    </div>
    @endif

</x-modal.modal-sm>
