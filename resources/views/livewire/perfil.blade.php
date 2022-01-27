<x-content>
    <x-slot name="import">
    </x-slot>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2 rounded-lg shadow-lg py-4 px-3 bg-gray-700">
            <div class="flex flex-col items-center justify-center text-white">
                <img src="{{ $perfil->profilePicture() }}" alt="" srcset="" class="w-28 h-28 rounded-full">
                <div class="text-center pt-3 inline-block">
                    <div class="text-ld font-medium uppercase ">
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
        <div class="col-span-2 py-4 px-3 shadow-lg bg-gray-100 rounded-lg">
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
        <div class="col-span-2 py-4 px-3 shadow-lg bg-gray-100 rounded-lg">
            <form action="#" method="post">
                <div class="">
                    <x-form.label for="password">Contraseña</x-form.label>
                    <x-input type="password" wire:model="password" name="password" id="password" class="max-w-md w-full"
                        required />
                </div>
                <div class="pt-4">
                    <x-form.label for="repeat_password">Confirmar Contraseña</x-form.label>
                    <x-input type="password" wire:model="repeat_password" name="repeat_password" id="repeat_password"
                        class="max-w-md w-full" required />
                </div>
                <div class="pt-4">
                    <x-button type="button" wire:click.prevent="updatePassword()">Actualizar</x-button>
                </div>
            </form>
        </div>
    </div>

</x-content>
