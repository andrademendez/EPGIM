@component('mail::message')
@component('mail::panel')
## Datos de la campaña
Nombre: {{ $campaniaTitle }}

Inicio: {{ $campaniaStart }}

Fin: {{ $campaniaEnd }}

Tipo de solicitud: {{ $campaniaProcess }}

@endcomponent

> #### Observaciones del administrador
>
> {{ $comment }}

---

Thanks,<br>
{{ config('app.name') }}
@endcomponent
