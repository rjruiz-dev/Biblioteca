<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $music->document->title }}</title>

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
                <b>Siglas Autor: {{ $music->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $music->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $music->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $music->document->id }}</b>
            </td>
        </tr>
    </table>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <!-- <h2>Portada</h2> -->
                <img src= "{{ public_path("/images/". $music->document->photo) }}"  width="300" height="380"> 
                <br>       
<pre>
<b>Obra: {{ $music->document->title }} </b>
@if ( ( trim($music->culture['album_title'] != NULL) ) && ( trim($music->culture['album_title'] > 0) ) )   
<b>Disco: {{ $music->culture['album_title'] }} </b>
@endif
@if ( ( trim( $music->culture['director']  != NULL) ) && ( trim( $music->culture['director']  > 0) ) )   
<b>Director: {{ $music->culture['director'] }} </b> 
@endif
<b>Subtipo de Documento: {{ $music->document->document_subtype->subtype_name  }} </b> 
</pre>
            </td>            
            <td align="right" style="width: 40%;">
          
                <div style="text-align: center; margin-top: -120px;">
                @if ( ( trim($idioma_music->compositor != NULL) ) && ( trim($idioma_music->compositor != '') ) )   
                    <b>Compositor:</b> <i>{{ $idioma_music->compositor  }}</i><br>
                @endif
                @if ( ( trim($music->culture['orchestra'] != NULL) ) && ( trim($music->culture['orchestra'] != '') ) )   
                    <b>Orquesta:</b> <i>{{ $music->culture['orchestra'] }}</i><br>
                @endif
                @if ( ( trim($music->document->published != NULL) ) && ( trim($music->document->published != '') ) )   
                    <b>Editado en:</b> <i>{{ $music->document->published }}</i><br>
                @endif
                @if ( ( trim($music->document->made_by != NULL) ) && ( trim($music->document->made_by != '') ) )   
                    <b>Sello discografico:</b> <i>{{ $music->document->made_by }}</i><br>
                @endif                               
                    <b>Idioma:</b> <i>{{ $music->document->lenguage->leguage_description  }}</i><br>
                    <b>Año:</b> <i>{{ Carbon\Carbon::parse($music->document->year)->format('Y')  }}</i><br>
                @if ( ( trim($music->generate_music->genre_music != NULL) ) && ( trim($music->generate_music->genre_music != '') ) )   
                    <b>Género:</b> <i>{{ $music->generate_music->genre_music }}</i><br>
                @endif
                    <b>Disponible desde:</b> <i>{{ Carbon\Carbon::parse($music->document->acquired)->format('d-m-Y') }}</i><br>
                @if ( ( trim($music->document->adequacy['adequacy_description'] != NULL) ) && ( trim($music->document->adequacy['adequacy_description'] != '') ) )   
                    <b>Adecuado para:</b> <i>{{ $music->document->adequacy['adequacy_description'] }}</i><br>
                @endif
                @if ( ( trim($music->generate_format['genre_format'] != NULL) ) && ( trim($music->generate_format['genre_format'] != '') ) )   
                    <b>Formato:</b> <i>{{  $music->generate_format['genre_format'] }}</i><br>
                @endif
                @if ( ( trim($music->document->quantity_generic != NULL) ) && ( trim($music->document->quantity_generic != '') ) )   
                    <b>Duración:</b> <i>{{ $music->document->quantity_generic }}</i><br>
                @endif
                @if ( ( trim($music->document->assessment != NULL) ) && ( trim($music->document->assessment != '') ) )   
                    <b>Valoración:</b> <i>{{ $music->document->assessment }}</i><br>
                @endif
                @if ( ( trim($music->document->location != NULL) ) && ( trim($music->document->location != '') ) )   
                    <b>Ubicación:</b> <i>{{ $music->document->location }}</i><br>
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
            @if ( ( trim($music->document->synopsis != NULL) ) && ( trim($music->document->synopsis != '') ) )   
            <b>Sinopsis:</b><br>
            <p><i>{!! $music->document->synopsis !!}</i></p>
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