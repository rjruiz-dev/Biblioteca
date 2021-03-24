@component('mail::message')
# Informe para el Bibliotecario

{{ $mensaje }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
