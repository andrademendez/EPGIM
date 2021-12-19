<x-modal.modal-md>
    <x-slot name="modalhead"> {{ $action }} Usuario </x-slot>
    <div>
        <form method="post">
            <div class="grid grid-cols-4 gap-4">
                <div class="pt-2 col-span-2">
                    <x-form.label for="nombre">Nombre</x-form.label>
                    <x-input type="text" name="nombre" wire:model="name" id="nombre" placeholder="Nombre del usuario" class="w-full" required />
                    @error('name') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2 col-span-2">
                    <x-form.label for="email">Email</x-form.label>
                    <x-input type="email" name="email" wire:model="email" id="email" placeholder="example@grupogim.com.mx" class="w-full" required />
                    @error('email') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
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
                @if ($action == 'Actualizar')
                <div class="pt-2 col-span-2">
                    <x-form.label for="status">Estatus</x-form.label>
                    <x-form.select name="status" id="status" wire:model="status" class="w-full">
                        <option selected> Selecione el estatus</option>
                        <option value="0"> Inactivo</option>
                        <option value="1"> Activo</option>
                    </x-form.select>
                </div>
                @endif
            </div>
            <div class="pt-2 flex justify-end">
                <x-button wire:click.prevent="store()">{{ $action }}</x-button>
            </div>
        </form>
        <form method="post">
            <div class="grid grid-cols-4 gap-4">
                <div class="w-full pt-2 pr-2 col-span-2">
                    <x-form.label for="password">Contraseña</x-form.label>
                    <x-input type="password" name="password" wire:model="password" id="password" placeholder="********" class="w-full" required />
                    @error('password') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="w-full pt-2 pl-2 col-span-2">
                    <x-form.label for="repeat_password">Repetir Contraseña</x-form.label>
                    <x-input type="password" name="repeat_password" wire:model="repeat_password" id="repeat_password" placeholder="*******" class="w-full" required />
                </div>
            </div>
            <div class="pt-2 flex justify-end">
                <x-button wire:click.prevent="updatePassword()">{{ $action }}</x-button>
            </div>
        </form>
    </div>
</x-modal.modal-md>
