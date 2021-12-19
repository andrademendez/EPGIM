<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="pb-3 ">
                    <h1 class="text-lg font-normal uppercase">Mi Perfil</h1>
                </div>
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-2 flex flex-col items-center justify-center shadow-lg py-4 px-3">
                        <img src="{{ $perfil->profilePicture() }}" alt="" srcset="" class="w-28 h-28 rounded-full">
                        <div class="text-center pt-3">
                            <span>{{ $name }}</span>
                            <span>{{ $email }}</span>
                        </div>
                    </div>
                    <div class="col-span-2 py-4 px-3 shadow-lg">
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
                                <x-button>Actualizar</x-button>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-2 py-4 px-3 shadow-lg">
                        <form action="#" method="post">
                            <div class="">
                                <x-form.label for="password">Contraseña</x-form.label>
                                <x-input type="password" wire:model="password" name="password" id="password" class="max-w-md w-full" required />
                            </div>
                            <div class="pt-4">
                                <x-form.label for="repeat_password">Confirmar Contraseña</x-form.label>
                                <x-input type="password" wire:model="repeat_password" name="repeat_password" id="repeat_password" class="max-w-md w-full" required />
                            </div>
                            <div class="pt-4">
                                <x-button type="button" wire:click.prevent="updatePassword()">Actualizar</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
