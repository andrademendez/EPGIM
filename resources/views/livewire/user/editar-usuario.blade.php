<div>
    <div>
        @if ($open == true)
        @include('pages.users.confirm')
        @endif
    </div>
    <x-link-return :href="route('user.index')">
        Volver a usuarios
    </x-link-return>

    <div class="">
        <div class="w-full my-2 bg-cover bg-center shadow-lg  rounded-lg py-4 px-3"
            style="background-image: url('../../images/test/ll.png')">
            <div class="flex flex-col items-center justify-center  ">
                <img src="{{ $profile }}" alt="" srcset="" class="w-28 h-28 rounded-full">
                <div class="text-center py-3 flex flex-col">
                    <span class="font-medium uppercase">{{ $name }}</span>
                    <span class="text-gray-700 text-sm">{{ $email }}</span>
                </div>

            </div>
            <div class="flex justify-center space-x-5 w-full bg-gray-500 bg-opacity-80 py-2 px-3 text-white">
                <div class=" py-2 px-10 rounded-lg ">
                    <div class="text-left text-xs uppercase">
                        <span class="font-bold">Tipo de usuario: </span>
                        <span>{{ $role->nombre }}</span>
                    </div>
                    <div class="text-left text-xs uppercase">
                        <span class="font-bold">Estado: </span>
                        @if ($status == 0)
                        <span class="bg-red-500 text-red-100 px-2 rounded-lg">Inactivo</span>
                        @else
                        <span class="bg-green-500 text-white font-medium px-2 rounded-lg">Activo</span>
                        @endif
                    </div>
                </div>
                <div class="mt-3">
                    @if ($status == 0)
                    <button class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white font-medium text-xs rounded-md"
                        wire:click="openModal">
                        Habilitar
                    </button>
                    @else
                    <button class="px-3 py-2 bg-red-600 hover:bg-red-600 text-white font-medium text-xs rounded-md"
                        wire:click="openModal">
                        <span>Deshabilitar</span>
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-6 gap-4 mt-3">

        <div class="md:col-span-3  col-span-6 ">
            <div class="pt-4 pb-2 px-3 shadow-lg  rounded-lg">
                <div class="pb-3 font-medium uppercase text-center text-sm">
                    <h2>Actualizar nombre</h2>
                </div>
                <form method="post">
                    @csrf
                    <div class="">
                        <x-form.label for="name">Nombre</x-form.label>
                        <x-input type="text" name="name" id="name" class="w-full" wire:model="name" required />
                        @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="pt-4">
                            <x-form.label for="email">Correo</x-form.label>
                            <x-input type="email" name="email" id="email" wire:model="email" class="w-full" disabled />
                        </div>

                        <div class="col-span-1 ">
                            <div class="mt-4">
                                <x-form.label for="rol">Rol</x-form.label>
                                <x-form.select class="w-full" name="rol" id="rol" wire:model="id_rol">
                                    <option selected>Rol</option>
                                    @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                    @endforeach
                                </x-form.select>
                                @error('rol') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="col-span-2 flex items-end justify-end">
                            <x-button wire:click.prevent="updateData()" class="bg-purple-700">Actualizar</x-button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="md:col-span-3  col-span-6">
            <div class="pt-4 pb-2 px-5 shadow-lg  rounded-lg">
                <div class="pb-3 font-medium uppercase text-center text-sm">
                    <h2>Actualizar contraseña</h2>
                </div>
                <form method="post">
                    @csrf
                    <div class="">
                        <x-form.label for="password">Password</x-form.label>
                        <x-input type="password" name="password" wire:model="password" id="password" class="w-full"
                            placeholder="**********" />
                        @error('password') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                    </div>
                    <div class="pt-4">
                        <x-form.label for="repeat_password">Repeat Password</x-form.label>
                        <x-input type="password" name="repeat_password" wire:model="repeat_password"
                            id="repeat_password" class="w-full" placeholder="**********" />
                    </div>
                    <div class="pt-4 flex justify-end">
                        <x-button wire:click.prevent="updatePassword()" class="bg-purple-700">Actualizar</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
