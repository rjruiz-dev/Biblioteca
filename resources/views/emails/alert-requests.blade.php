@component('mail::message')
@if($mensaje == 1)
# Tu Solicitud ha sido envia a {{ config('app.name') }}.

Pronto recibira la respuesta a su solicitud!
@else
# Tu Solicitud ha sido rechazada por {{ config('app.name') }}.

Contactese para mas Información.
@endif

Muchas Gracias!,<br>
{{ config('app.name') }}

@endcomponent
