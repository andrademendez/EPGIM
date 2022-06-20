<div class=" flex items-center justify-end space-x-2  p-1 ">

    @if ($campania->status == 'Confirmado' || $campania->status == 'Cerrado')

    <a href="{{ route('campania.ordenes', $campania->id) }}" title="Ordenes de Servicios"
        class="hover:text-green-500 text-green-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 " fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
    </a>

    @endif
    <a class="hover:text-indigo-500 text-indigo-700" href="{{ route('campania.cotizacion', $campania->id) }}"
        title="Cotizaciones">
        <span class="material-icons">
            request_quote
        </span>
    </a>
    <a title="Detalles" href="{{ route('detalles.detalles', $campania->id) }}"
        class="hover:text-gray-500 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </a>
</div>
