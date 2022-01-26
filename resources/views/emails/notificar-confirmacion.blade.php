@component('mail::message')
## En hora buena tu campaña a sido confirmado!!

@component('mail::panel')
#### Datos de la campaña

Nombre: {{ $campaniaTitle }}

Con Fecha de inicio: {{ $campaniaStart }}

Fecha de fin: {{ $campaniaEnd }}

@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
