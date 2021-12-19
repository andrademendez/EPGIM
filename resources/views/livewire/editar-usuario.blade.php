<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-3 lg:px-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                {{-- <div class="pb-3 ">
                    <h1 class="text-lg font-normal uppercase">{{ $usuario->name }}</h1>
            </div> --}}
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-2 flex flex-col items-center justify-center shadow-lg bg-gray-50 rounded-lg py-4 px-3">
                    <img src="{{ $usuario->profilePicture() }}" alt="" srcset="" class="w-28 h-28 rounded-full">
                    <div class="text-center py-3">
                        <span class="font-medium uppercase">{{ $usuario->name }}</span>
                        <span class="text-gray-700 text-sm">{{ $usuario->email }}</span>
                    </div>
                    <div class=" py-2 bg-gray-50 px-10 rounded-lg ">
                        <div class="text-center pb-1 text-xs uppercase">
                            <span>Usuario: </span>
                            <span>{{ $usuario->rol->nombre }}</span>
                        </div>
                        <div class="text-left text-xs uppercase">
                            <span>Estado: </span>
                            @if ($usuario->status == 0)
                            <span class="bg-red-500 text-red-100 px-2 rounded-lg">Disable</span>
                            @else
                            <span class="bg-green-500 text-green-100 px-2 rounded-lg">Enable</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-span-2 py-4 px-3 shadow-lg bg-gray-50 rounded-lg">
                    <div class="pb-3 font-medium uppercase text-center text-sm">
                        <h2>Actualizar nombre</h2>
                    </div>
                    <form action="#" method="post">
                        <div class="">
                            <x-form.label for="name">Nombre</x-form.label>
                            <x-input type="text" name="name" id="name" class="w-full" value="{{ old('name', $usuario->name) }}" />
                        </div>
                        <div class="pt-4">
                            <x-form.label for="email">Correo</x-form.label>
                            <x-input type="email" name="email" id="email" class="w-full" value="{{ old('name', $usuario->email) }}" />
                        </div>
                        <div class="pt-4">
                            <x-button>Actualizar</x-button>
                        </div>
                    </form>
                </div>
                <div class="col-span-2 py-4 px-3 shadow-lg bg-gray-50 rounded-lg">
                    <div class="pb-3 font-medium uppercase text-center text-sm">
                        <h2>Actualizar contraseña</h2>
                    </div>
                    <form action="#" method="post">
                        <div class="">
                            <x-form.label for="password">Password</x-form.label>
                            <x-input type="password" name="password" id="password" class="w-full" placeholder="**********" />
                        </div>
                        <div class="pt-4">
                            <x-form.label for="repeat_password">Repeat Password</x-form.label>
                            <x-input type="password" name="repeat_password" id="repeat_password" class="w-full" placeholder="**********" />
                        </div>
                        <div class="pt-4">
                            <x-button>Actualizar</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
