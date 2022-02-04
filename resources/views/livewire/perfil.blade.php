<div class="grid grid-cols-4 gap-2">
    <div class="col-span-4 md:col-span-2  ">
        <div class="flex flex-col items-center justify-center rounded-lg shadow-lg py-4 px-3 bg-gray-50">
            <div class="flex flex-col items-center">
                @if ($foto)
                <img src="{{ $foto->temporaryUrl() }}" alt="" srcset="" class="w-36 h-36 rounded-full">
                @else
                @if ($perfil->perfil)

                <img src="{{ $perfil->perfil }}" alt="" srcset="" class="w-36 h-36 rounded-full">
                @else
                <img src="{{ $perfil->profilePicture() }}" alt="" srcset=""
                    class="w-36 h-36 rounded-full border-2 border-gray-300">
                @endif
                @endif
                <form method="post">
                    @csrf
                    <div class="mt-3 flex items-center justify-between">
                        <div class="bg-indigo-200 flex justify-center pt-2 px-3 border border-gray-300 rounded-md">
                            <div class="flex text-sm items-center text-gray-600 ">
                                <label for="file-upload"
                                    class="cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring focus-within:ring-offset-1 focus-within:ring-indigo-500">
                                    <span>Cambiar perfil</span>
                                    <input id="file-upload" name="file-upload" wire:model="foto" type="file"
                                        accept="image/jpeg, image/png" class="sr-only">
                                </label>
                            </div>
                        </div>
                        @if ($foto)
                        <div class="ml-2">
                            <x-form.btn-icons wire:click.prevent="changePerfil" class="bg-indigo-200 rounded-full p-1">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </x-form.btn-icons>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
            <div class="text-center inline-block">
                <div class="text-lg font-medium uppercase ">
                    <span>{{ $name }}</span>
                </div>
                <div class="text-sm">
                    <span>{{ $email }}</span>
                </div>
                <div class="text-sm uppercase mt-3 font-medium">
                    <span> {{ $rol }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-4 md:col-span-2 ">
        <div class="pt-4 pb-1 px-3 shadow-lg bg-gray-50 rounded-lg">
            <form action="#" method="post">
                <div class="">
                    <x-form.label for="name">Nombre</x-form.label>
                    <x-input type="text" name="name" id="name" wire:model="name" class="max-w-md w-full" required />
                </div>
                <div class="pt-4">
                    <x-form.label for="email">Correo</x-form.label>
                    <x-input type="email" name="email" wire:model="email" disabled id="email" class="max-w-md w-full" />
                </div>
                <div class="pt-4">
                    <x-button wire:click.prevent="update()">Actualizar</x-button>
                </div>
            </form>
        </div>
        <div class="pt-4 pb-1 px-3 shadow-lg bg-gray-50 rounded-lg mt-3">
            <form action="#" method="post">
                <div class="">
                    <x-form.label for="password">Contraseña</x-form.label>
                    <x-input type="password" wire:model="password" name="password" id="password" class="max-w-md w-full"
                        placeholder="*********" required />
                </div>
                <div class="pt-4">
                    <x-form.label for="repeat_password">Confirmar Contraseña</x-form.label>
                    <x-input type="password" wire:model="repeat_password" name="repeat_password" id="repeat_password"
                        class="max-w-md w-full" placeholder="*********" required />
                </div>
                <div class="pt-4">
                    <x-button type="button" wire:click.prevent="updatePassword()">Actualizar</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
