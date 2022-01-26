@component('mail::message')
#### El Usuario {{ $userName }} a iniciado un Challenge


@component('mail::panel')
Campaña: {{ $campaniaTitle }}

Fecha de inicio: {{ $campaniaStart }}

Fecha de fin: {{ $campaniaEnd }}

@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
