@component('mail::message')
# Informe para el Bibliotecario

{{ $msj }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
