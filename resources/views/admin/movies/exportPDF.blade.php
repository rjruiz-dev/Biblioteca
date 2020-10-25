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
<b>Título Original: {{ $movie->document->original_title != NULL ? $movie->document->original_title : 'Sin título original' }} </b>
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
                    <b>Nacionalidad:</b> <i>{{$movie->document->published != NULL ? $movie->document->published : 'Sin nacionalidad'}}</i><br> 
                    <b>Productora:</b> <i>{{ $movie->document->made_by != NULL ? $movie->document->made_by : 'Sin productora'}}</i><br>
                    <b>Distribuidora:</b> <i>{{  $movie->distributor != NULL ?  $movie->distributor : 'Sin distribuidora' }}</i><br>
                    <b>Año:</b> <i>{{ Carbon\Carbon::parse($movie->document->year)->format('Y')  }}</i><br>
                    <b>Idioma:</b> <i>{{ $movie->document->lenguage->leguage_description }}</i><br>
                    <b>Género:</b> <i>{{ $movie->generate_movie->genre_film  }}</i><br>                   
                    <b>Disponible desde:</b> <i>{{  Carbon\Carbon::parse($movie->document->acquired)->format('d-m-Y') }}</i><br>
                    <b>Adecuado para:</b> <i>{{ $movie->document->adequacy['adequacy_description'] != NULL ? $movie->document->adequacy['adequacy_description'] : 'Sin adecuación' }}</i><br>
                    <b>Fotografía:</b> <i>{{ $movie->photography_movie['photography_movies_name']  != NULL ? $movie->photography_movie['photography_movies_name']  : 'Sin fotografia' }}</i><br>
                    <b>Duración:</b> <i>{{ $movie->document->quantity_generic  != NULL ? $movie->document->quantity_generic  : 'Sin duración' }}</i><br>
                  
                    <b>Valoración:</b> <i>{{ $movie->document->assessment != NULL ? $movie->document->assessment : 'Sin valoración' }}</i><br>
                    <b>Ubicación:</b> <i>{{ $movie->document->location  != NULL ? $movie->document->location  : 'Sin ubicación' }}</i><br>
                                     
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
            <b>Sinopsis:</b><br>
            <p><i>{!! $movie->document->synopsis != NULL ? $movie->document->synopsis : 'Sin sinopsis' !!}</i></p>
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