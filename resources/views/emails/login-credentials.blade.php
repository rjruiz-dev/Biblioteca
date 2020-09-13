@component('mail::message')
@if($accion == "solicitud aceptada")
# Tu solicitud de asociamiento a {{ config('app.name') }} ha sido aceptada !
@else
# Has sido dado del alta como socio en {{ config('app.name') }} 
@endif
Utiliza estas credenciales para acceder al sistema.

@component('mail::table')
    | Username | Contraseña |
    |:----------|:------------|
    | {{ $user->email }} | {{ $password }} |
@endcomponent

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent