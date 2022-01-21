<div {{ $attributes }} aria-hidden="true" class="flex overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <div class="relative px-4 w-full max-w-4xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class=" py-2 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3 pt-2">
                    <div class="text-center text-sm ">
                        <span class="font-medium uppercase">{{ $modalhead }}</span>
                    </div>
                    <button wire:click="closeModal()" class=" cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

</div>
