<div>
    {{-- The Master doesn't talk, he acts. --}}
    @if ($open == true)
    @include('pages.ordenes.validar')
    @endif
    @if ($orden->estatus)
    <div class="bg-white">
        <div class="px-3 py-2 border-b border-gray-200 space-y-3 ">
            <div class="text-center py-2">
                <h1 class="text-lg font-medium uppercase text-gray-900">Observaciones del administrador
                </h1>
            </div>

            <div class="mt-3 px-2 py-2 flex items-center justify-between">
                <div class="font-bold uppercase">
                    <span>Actividad: </span>

                    @if ($orden->validacion->estatus == "Rechazado")
                    <span class="text-red-700">{{ $orden->validacion->actividad }}</span>
                    @else
                    <span class="text-green-600">{{ $orden->validacion->actividad }}</span>
                    @endif

                </div>
                @if ($orden->validacion->estatus == "Rechazado")
                <div class="text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                @else
                <div class="text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                @endif

            </div>

        </div>

        <div class="mt-3 ">
            <ol class="relative border-l border-gray-200 dark:border-gray-700">

                <li class="mb-10 ml-4">
                    <div
                        class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700">
                    </div>

                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                        {{ $orden->validacion->created_at }} </time>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $orden->validacion->estatus }}
                    </h3>
                    <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                        {{ $orden->validacion->comentarios }}
                    </p>
                </li>

            </ol>
            <div class="">
                @if ($orden->validacion->estatus == "Rechazado")
                <p><strong>Nota: </strong> Tu orden de servicio ha sido rechazado por
                    el administrador, tome encuenta las recomendaciones o comentarios echas por el.</p>
                @endif
            </div>
        </div>
    </div>
    @else
    @if ($usuario->isValidador($usuario->id))
    <div class="bg-indigo-600 px-4 py-4 my-2 w-full flex flex-col items-center justify-center">
        <div class="text-white text-lg py-2 uppercase">
            <h1 class="font-medium text-lg">Orden pendiente por validar</h1>
        </div>
        <div class="mt-3">
            <button class="py-2 px-4 bg-purple-800 hover:bg-purple-900 text-white text-sm uppercase"
                wire:click="openModal">
                Validar Orden de servicio
            </button>
        </div>
        <div class="text-white mt-4">
            <p class="text-xs font-medium">
                Nota: Una ves realizada la validacion no se puede revertir el procesaso.

            </p>
        </div>

    </div>
    @else
    <div class="mt-3 px-3 py-2">
        <div class="font-bold uppercase">
            <span>Orden de servicio: </span>
            <span class="text-purple-700">Pendiente por validar</span>
        </div>
        <div class="text-sm py-3 mt-4">
            <p> <strong>Nota</strong> El administrador aun no ha confirmado o validado la orden, en cuanto lo realice se
                te notificará inmediatamente.</p>
        </div>
    </div>
    @endif

    @endif
</div>
