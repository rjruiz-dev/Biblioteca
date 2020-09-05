@component('mail::message')
# Tus credenciales para acceder a {{ config('app.name') }}

Test envio de reclamos.

@component('mail::table')
    | Username |
    |:----------|
    | {{ $user->email }} | 
@endcomponent

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
