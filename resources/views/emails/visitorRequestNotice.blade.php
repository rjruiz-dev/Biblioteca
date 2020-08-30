@component('mail::message')
# Has solicitado asociarte a {{ config('app.name') }}

Seras notificada a este mail la respuesta a su solicitud.

@component('mail::table')
    | Username | Nickname |
    |:----------|:------------|
    | {{ $user->email }} | {{ $user->nickname }} |
@endcomponent


Gracias,<br>
Administracion {{ config('app.name') }}
@endcomponent