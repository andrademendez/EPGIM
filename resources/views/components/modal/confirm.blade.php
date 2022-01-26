<div {{ $attributes }} class=" fixed w-full h-full top-0 left-0 flex items-center justify-center" tabindex="-1"
    style="z-index: 1000">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="bg-white w-9/12 sm:w-[26rem] 2xl:w-3/12  mx-auto rounded-lg shadow-lg z-50 overflow-y-auto">
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content text-left pt-4">
            <!--Title-->
            <div class="sm:px-5 lg:pt-5 flex flex-col items-center justify-center">
                <div class="pb-4">
                    <div class=" text-red-600">
                        {{-- <svg class=" w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg> --}}
                        <ion-icon name="alert-circle-outline"></ion-icon>
                    </div>
                </div>
                <div>
                    <span>¿Está seguro de eliminar el registro?</span>
                </div>
                <div class="pb-2">
                    <span>No podrá revertir esta acción</span>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-4 px-10 mt-6 mb-3 ">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
