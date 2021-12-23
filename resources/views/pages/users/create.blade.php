<x-modal.modal-sm>
    <x-slot name="modalhead"> Registrar nuevo Usuario </x-slot>
    <div>
        <form method="post">
            <div class="grid grid-cols-4 gap-2">
                <div class="pt-2 col-span-4">
                    <x-form.label for="nombre">Nombre</x-form.label>
                    <x-input type="text" name="nombre" wire:model="name" id="nombre" placeholder="Nombre del usuario" class="w-full" required />
                    @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2 col-span-4">
                    <x-form.label for="email">Email</x-form.label>
                    <x-input type="email" name="email" wire:model="email" id="email" placeholder="example@grupogim.com.mx" class="w-full" required />
                    @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class=" pt-2 col-span-2">
                    <x-form.label for="password">Contraseña</x-form.label>
                    <x-input type="password" name="password" wire:model="password" id="password" placeholder="********" class="w-full" required />
                    @error('password') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="repeat_password">Confirmar Contraseña</x-form.label>
                    <x-input type="password" name="repeat_password" wire:model="repeat_password" id="repeat_password" placeholder="*******" class="w-full" required />
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="rol">Rol</x-form.label>
                    <x-form.select name="rol" id="rol" wire:model="id_rol" class="w-full">
                        <option selected> Seleccione el rol</option>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}"> {{ $rol->nombre }}</option>
                        @endforeach
                    </x-form.select>
                </div>
                <div class="pt-2 col-span-2 ">
                    <x-form.label for="rol">Tipo de usuario</x-form.label>
                    <div class="flex items-center">
                        <div class="flex items-center pr-2">
                            <input id="interno" wire:model="interno" type="radio" name="interno" value="1" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" aria-labelledby="country-option-1" aria-describedby="country-option-1" checked>
                            <label for="interno" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Interno
                            </label>
                        </div>

                        <div class="flex items-center ">
                            <input id="externo" wire:model="interno" type="radio" name="interno" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" aria-labelledby="country-option-2" aria-describedby="country-option-2">
                            <label for="externo" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Externo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-2 flex justify-end">
                <x-button wire:click.prevent="store()">Registrar</x-button>
            </div>
        </form>

    </div>
</x-modal.modal-sm>
