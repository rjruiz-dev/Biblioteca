<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->document->title }}</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;            
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {                        
            /* color: #FFF; */
            background-color: {{ $setting->skin }};
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .info table {
            padding: 25px;
           
        }
        .detalle table {
            padding: 25px;
           
        }
    </style>

</head>
<body>
<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>{{ $setting->library_name}}</h3>
<pre>
{{ $setting->street}} - {{ $setting->postal_code}}
{{ $setting->city}} - {{ $setting->province}}
{{ $setting->library_email}}
{{ $setting->library_phone}} 
</pre>
            </td>
            <td align="center" style="width: 20%;">
                <img class="logo" src="{{ public_path("/images/". $setting->logo) }}" width="64">    
            </td>
            <td align="right" style="width: 40%;">
                <div style="margin-top: -60px;">
                    <h3>Fecha: {{Carbon\Carbon::now()->format('d-m-Y')}}</h3> 
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="info">
    <table width="100%" style="color:black;     background: #999934;">
        <tr>
            <td align="left" style="width: 50%;">
                <b>Siglas Autor: {{ $movie->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $movie->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $movie->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $movie->document->id }}</b>
            </td>
        </tr>
    </table>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <!-- <h2>Portada</h2> -->
                <img src= "{{ public_path("/images/". $movie->document->photo) }}"  width="250" height="380"> 
                <br>       
<pre>
<b>Título: {{ $movie->document->title  }} </b>
@if ( ( trim($movie->document->original_title != NULL) ) && ( trim($movie->document->original_title != '') ) )   
<b>Título Original: {{ $movie->document->original_title != NULL ? $movie->document->original_title : 'Sin título original' }} </b>
@endif
<b>Dirigido Por: {{  $movie->document->creator->creator_name }} </b>

</pre>
            </td>            
            <td align="right" style="width: 40%;">
          
                <div style="text-align: center; margin-top: -120px;">
                    @php 
                        $reparto = '';
                        $cantidad = 0;
                    @endphp                
                    @foreach($movie->actors as $actor)

                        @if($cantidad == 0)

                        @php
                            $reparto = $reparto . $actor->actor_name;
                        @endphp

                        @else

                        @php
                            $reparto = $reparto . ", ". $actor->actor_name;
                        @endphp
                        
                        @endif

                        @php
                            $cantidad = $cantidad + 1 ;
                        @endphp
                        
                    @endforeach 
                    @if ( $reparto == '' )                            
                    <b>Reparto:</b><i>Sin reparto</i> <br>
                    @else                           
                    <b>Reparto:</b><i>{{ $reparto }}</i><br>
                    @endif 
                    @if ( ( trim( $movie->document->published != NULL) ) && ( trim( $movie->document->published != '') ) )   
                    <b>Nacionalidad:</b> <i>{{ $movie->document->published }}</i><br> 
                    @endif
                    @if ( ( trim($movie->document->made_by != NULL) ) && ( trim($movie->document->made_by != '') ) )   
                    <b>Productora:</b> <i>{{ $movie->document->made_by }}</i><br>
                    @endif
                    @if ( ( trim($movie->distributor != NULL) ) && ( trim($movie->distributor != '') ) )   
                    <b>Distribuidora:</b> <i>{{ $movie->distributor }}</i><br>
                    @endif                       
                    <b>Año:</b> <i>{{ Carbon\Carbon::parse($movie->document->year)->format('Y')  }}</i><br>
                    <b>Idioma:</b> <i>{{ $movie->document->lenguage['leguage_description'] }}</i><br>
                    @if ( ( trim($movie->generate_movie->genre_film  != NULL) ) && ( trim($movie->generate_movie->genre_film  != '') ) )   
                    <b>Género:</b> <i>{{ $movie->generate_movie->genre_film  }}</i><br>
                    @endif
                    <b>Disponible desde:</b> <i>{{  Carbon\Carbon::parse($movie->document->acquired)->format('d-m-Y') }}</i><br>
                    @if ( ( trim($movie->document->adequacy['adequacy_description'] != NULL) ) && ( trim($movie->document->adequacy['adequacy_description'] != '') ) )   
                    <b>Adecuado para:</b> <i>{{ $movie->document->adequacy['adequacy_description'] }}</i><br>
                    @endif
                    @if ( ( trim($movie->photography_movie['photography_movies_name'] != NULL) ) && ( trim($movie->photography_movie['photography_movies_name'] != '') ) )   
                    <b>Fotografía:</b> <i>{{ $movie->photography_movie['photography_movies_name'] }}</i><br>
                    @endif
                    @if ( ( trim($movie->document->quantity_generic  != NULL) ) && ( trim($movie->document->quantity_generic  != '') ) )   
                    <b>Duración:</b> <i>{{ $movie->document->quantity_generic }}</i><br>
                    @endif
                    @if ( ( trim($movie->document->assessment != NULL) ) && ( trim($movie->document->assessment != '') ) )   
                    <b>Valoración:</b> <i>{{ $movie->document->assessment }}</i><br>
                    @endif
                    @if ( ( trim($movie->document->location != NULL) ) && ( trim($movie->document->location != '') ) )   
                    <b>Ubicación:</b> <i>{{ $movie->document->location }}</i><br>
                    @endif              
                </div>
            </td>
            <td style="width: 20%;">
            </td>
        </tr> 
    </table>
</div>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 100%;">
            @if ( ( trim($movie->document->synopsis != NULL) ) && ( trim($movie->document->synopsis != '') ) )
            <b>Sinopsis:</b><br>
            <p><i>{!! $movie->document->synopsis !!}</i></p>
            @endif
            </td>
        </tr>
    </table>
</div>
<br>
<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - Todos los derechos reservados.
            </td>
            <td align="right" style="width: 50%;">
            {{ $setting->library_name}}
            </td>
        </tr>
    </table>
</div>
</body>
</html>