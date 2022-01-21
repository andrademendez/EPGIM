@component('mail::message')

@component('mail::panel')

## Datos de la campaña

Nombre: {{ $campaniaTitle }}

Inicio: {{ $campaniaStart }}

Fin: {{ $campaniaEnd }}

Cliente: {{ $campaniaCliente }}

Creado por: {{ $campaniaUser }}

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
