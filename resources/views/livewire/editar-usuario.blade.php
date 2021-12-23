<div class="py-3">
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="titlePage">Editar Usuario - {{ $name }}</x-slot>

    <div class="max-w-7xl mx-auto px-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-2 ">
                        <div class="flex flex-col items-center justify-center shadow-lg bg-gray-50 rounded-lg py-4 px-3">
                            <img src="{{ $profile }}" alt="" srcset="" class="w-28 h-28 rounded-full">
                            <div class="text-center py-3 flex flex-col">
                                <span class="font-medium uppercase">{{ $name }}</span>
                                <span class="text-gray-700 text-sm">{{ $email }}</span>
                            </div>
                            <div class=" py-2 bg-gray-50 px-10 rounded-lg ">
                                <div class="text-left text-xs uppercase">
                                    <span>Tipo de usuario: </span><br>
                                    <span>{{ $role->nombre }}</span>
                                </div>
                                <div class="text-left text-xs uppercase">
                                    <span>Estado: </span>
                                    @if ($status == 0)
                                    <span class="bg-red-500 text-red-100 px-2 rounded-lg">Inactivo</span>
                                    @else
                                    <span class="bg-green-500 text-green-100 px-2 rounded-lg">Activo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 pt-4 pb-2 px-3 shadow-lg bg-gray-50 rounded-lg">
                        <div class="pb-3 font-medium uppercase text-center text-sm">
                            <h2>Actualizar nombre</h2>
                        </div>
                        <form action="#" method="post">
                            <div class="">
                                <x-form.label for="name">Nombre</x-form.label>
                                <x-input type="text" name="name" id="name" class="w-full" wire:model="name" required />
                            </div>
                            <div class="pt-4">
                                <x-form.label for="email">Correo</x-form.label>
                                <x-input type="email" name="email" id="email" wire:model="email" class="w-full" disabled />
                            </div>
                            <div class="grid grid-cols-3 gap-3 pt-3">
                                <div class="col-span-2">
                                    <x-form.label for="rol">Rol</x-form.label>
                                    <x-form.select name="rol" id="rol" wire:model="id_rol">
                                        <option selected>Rol</option>
                                        @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                        @endforeach
                                    </x-form.select>
                                </div>
                                <div class="col-span-1 flex flex-col items-start">
                                    <x-form.label for="">Estatus</x-form.label>
                                    <label for="toggle-example" class="relative mb-4 cursor-pointer">
                                        <input type="checkbox" id="toggle-example" class="sr-only" wire:model="status">
                                        <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-4 flex justify-center">
                                <x-button wire:click.prevent="updateData()" class="bg-purple-700">Actualizar</x-button>
                            </div>
                        </form>
                    </div>
                    <div class="col-span-2 ">
                        <div class="pt-4 pb-2 px-3 shadow-lg bg-gray-50 rounded-lg">
                            <div class="pb-3 font-medium uppercase text-center text-sm">
                                <h2>Actualizar contraseña</h2>
                            </div>
                            <form action="#" method="post">
                                <div class="">
                                    <x-form.label for="password">Password</x-form.label>
                                    <x-input type="password" name="password" wire:model="password" id="password" class="w-full" placeholder="**********" />
                                </div>
                                <div class="pt-4">
                                    <x-form.label for="repeat_password">Repeat Password</x-form.label>
                                    <x-input type="password" name="repeat_password" wire:model="repeat_password" id="repeat_password" class="w-full" placeholder="**********" />
                                </div>
                                <div class="pt-4 flex justify-center">
                                    <x-button wire:click.prevent="updatePassword()" class="bg-purple-700">Actualizar</x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
