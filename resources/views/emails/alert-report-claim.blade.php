@component('mail::message')
# Informe de reclamos

Administrador: {{ $user->nickname }} 
Fecha: {{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('d-m-Y') }}


 
Documentos: 
    @component('mail::table')
     | ID | Documento | Socio | Fecha Prestamo | Fecha Devolucion | Retraso |
     |:----------|:------------|:------------|:------------|:------------|:------------|
    @foreach($prestamos as $prestamo) 

    | {{ $prestamo->id }} | {{ $prestamo->copy->document->title }} | {{ $prestamo->user->nickname }} | {{ Carbon\Carbon::parse($prestamo->date)->format('d-m-Y') }} | {{ Carbon\Carbon::parse($prestamo->date_until)->format('d-m-Y') }} | {{ Carbon\Carbon::parse($prestamo->date_until)->diffInDays(Carbon\Carbon::now()) }} |
    
    @endforeach 
    @endcomponent



Administracion {{ config('app.name') }}
@endcomponent


