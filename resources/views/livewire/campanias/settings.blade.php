<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="m-2 px-3 py-2 bg-white">
        <h1>Configuraciones</h1>
        <div class=" grid grid-cols-5 gap-4 mt-4">
            <div class="col-span-1 rounded-lg shadow-lg">

            </div>
            <div class="lg:col-span-2 shadow-lg rounded-lg px-3">
                <div class="">
                    <form class="space-y-4" method="post">
                        <div class="flex flex-col ">
                            <x-form.label>Usuario Origen</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">AA</option>
                            </x-form.select>
                        </div>
                        <div class="flex flex-col">
                            <x-form.label>Usuario destino</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">AA</option>
                            </x-form.select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex flex-col">
                                <x-form.label>Campañas</x-form.label>
                                <x-form.select name="" id="">
                                    <option value="a">Todos</option>
                                    <option value="a">Confirmados</option>
                                    <option value="a">Cerrados</option>
                                </x-form.select>
                            </div>
                            <div class="flex flex-col">
                                <x-form.label>Fechas</x-form.label>
                                <x-form.select name="" id="">
                                    <option value="a">Todos</option>
                                    <option value="a">Hoy en adelante</option>
                                </x-form.select>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-button>Transferir campañas</x-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:col-span-2 ">
                <div class="shadow-lg rounded-lg px-3 py-2">
                    <div class="py-2 mb-3">
                        <h1>Cambiar promotor a campaña</h1>
                    </div>
                    <form action="" method="post" class="space-y-4">
                        <div class="flex flex-col ">
                            <x-form.label>Campaña</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">AA</option>
                            </x-form.select>
                        </div>
                        <div class="flex flex-col">
                            <x-form.label>Usuario destino</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">USUARIO 1</option>
                                <option value="a">USUARIO 2</option>
                            </x-form.select>
                        </div>
                        <div class="flex justify-end">
                            <x-button>Cambiar usuario</x-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="lg:col-span-2 ">
                <div class="shadow-lg rounded-lg px-3 py-2">
                    <div class="py-2 mb-3">
                        <h1>Cambiar cliente</h1>
                    </div>
                    <form action="" method="post" class="space-y-4">
                        <div class="flex flex-col ">
                            <x-form.label>Cliente</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">CLIENTE 1</option>
                                <option value="a">CLIENTE 2</option>
                            </x-form.select>
                        </div>
                        <div class="flex flex-col">
                            <x-form.label>Usuario destino</x-form.label>
                            <x-form.select name="" id="">
                                <option value="a">USUARIO 1</option>
                                <option value="a">USUARIO 2</option>
                            </x-form.select>
                        </div>
                        <div class="flex justify-end">
                            <x-button>Cambiar usuario</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
