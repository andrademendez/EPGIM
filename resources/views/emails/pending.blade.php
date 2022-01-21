@component('mail::message')
# Datos de la Campaña

{{ $comentario }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
