@component('mail::message')
# Reclamos por Devolucion

# Número de Socio: {{ $user->membership }} 
# Socio: {{ $user->name }}

{!! $modelo->body !!}
 
Documentos: 
@component('mail::table')
    | ID | Documento | Fecha Prestamo | Fecha Devolucion |
    |:---|:------------|:---------------|:-----------------|
    @foreach($prestamos as $prestamo) 

    | {{ $prestamo->copy->document->id }} | {{ $prestamo->copy->document->title }} | {{ Carbon\Carbon::parse($prestamo->date)->format('d-m-Y') }} | {{ Carbon\Carbon::parse($prestamo->date_until)->format('d-m-Y') }} |
  
    @endforeach
    @endcomponent

{!! $modelo->excerpt !!}

# Gracias,<br>
# Administración {{ config('app.name') }}
@endcomponent
