<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $photograph->document->title }}</title>

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
                <b>Siglas Autor: {{ $photograph->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $photograph->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $photograph->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $photograph->document->id }}</b>
            </td>
        </tr>
    </table>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <!-- <h2>Portada</h2> -->
                <img src= "{{ public_path("/images/". $photograph->document->photo) }}"  width="300" height="380"> 
                <br>       
<pre>
<b>Titulo: {{ $photograph->document->title }} </b>
<b>Autor: {{ $photograph->document->creator->creator_name }} </b>
<b>Subtipo de Documento: {{ $photograph->document->document_subtype->subtype_name  }} </b> 
</pre>
            </td>            
            <td align="right" style="width: 40%;">          
                <div style="text-align: center; margin-top: -120px;">
                    <b>Disponible desde:</b> <i>{{ Carbon\Carbon::parse($photograph->document->acquired)->format('d-m-Y') }}</i><br>
                    <b>Idioma:</b> <i>{{ $photograph->document->lenguage->leguage_description  }}</i><br>
                    <b>Adecuado para:</b> <i>{{ $photograph->document->adequacy['adequacy_description'] != NULL ? $photograph->document->adequacy['adequacy_description'] : 'Sin adecuación' }}</i><br>
                    <b>Formato:</b> <i>{{ $photograph->generate_format['genre_format'] != NULL ?  $photograph->generate_format['genre_format'] : 'Sin formato' }}</i><br>
                    <b>Notas:</b> <i>{{ $photograph->document->note != NULL ?  $photograph->document->note : 'Sin notas' }}</i><br>
                    <b>Observaciones:</b> <i>{{ $photograph->document->observation != NULL ? $photograph->document->observation : 'Sin notas' }}</i><br>
                    <b>Ubicación:</b> <i>{{ $photograph->document->location  != NULL ? $photograph->document->location  : 'Sin ubicación' }}</i><br>
                </div>
            </td>
            <td style="width: 20%;">
            </td>
        </tr> 
    </table>
</div>
<!-- <br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 100%;">
            <b>Sinopsis:</b><br>
            <p><i>{!! $photograph->document->synopsis != NULL ? $photograph->document->synopsis : 'Sin sinopsis' !!}</i></p>
            </td>
        </tr>
    </table>
</div> -->     
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