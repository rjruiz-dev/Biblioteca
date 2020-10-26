<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $multimedia->document->title }}</title>

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
                <b>Siglas Autor: {{ $multimedia->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $multimedia->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $multimedia->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $multimedia->document->id }}</b>
            </td>
        </tr>
    </table>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">       
                <img src= "{{ public_path("/images/". $multimedia->document->photo) }}"  width="300" height="380"> 
                <br>       
<pre>
<b>Titulo: {{ $multimedia->document->title }} </b>
<b>Autor: {{ $multimedia->document->creator->creator_name }} </b>
</pre>
            </td>            
            <td align="right" style="width: 40%;">
          
                <div style="text-align: center; margin-top: -120px;">
                    @if ( ( trim($multimedia->document->published != NULL) ) && ( trim($multimedia->document->published != '') ) )                          
                        <b>Nacionalidad:</b> <i>{{ $multimedia->document->published }}</i><br>
                    @endif
                    @if ( ( trim($multimedia->document->made_by != NULL) ) && ( trim($multimedia->document->made_by != '') ) )   
                        <b>Editorial:</b> <i>{{ $multimedia->document->made_by }}</i><br>
                    @endif
                        <b>Idioma:</b> <i>{{ $multimedia->document->lenguage->leguage_description  }}</i><br>
                        <b>Año:</b> <i>{{ Carbon\Carbon::parse($multimedia->document->year)->format('Y')  }}</i><br>                           
                        <b>Disponible desde:</b> <i>{{ Carbon\Carbon::parse($multimedia->document->acquired)->format('d-m-Y') }}</i><br>       
                    @if ( ( trim($multimedia->document->adequacy['adequacy_description'] != NULL) ) && ( trim($multimedia->document->adequacy['adequacy_description'] != '') ) )   
                        <b>Adecuado para:</b> <i>{{ $multimedia->document->adequacy['adequacy_description'] }}</i><br>
                    @endif
                    @if ( ( trim($multimedia->document->assessment != NULL) ) && ( trim($multimedia->document->assessment != '') ) )   
                        <b>Valoración:</b> <i>{{ $multimedia->document->assessment }}</i><br>
                    @endif
                    @if ( ( trim($multimedia->document->quantity_generic != NULL) ) && ( trim($multimedia->document->quantity_generic != '') ) )   
                        <b>Número de paginas:</b> <i>{{ $multimedia->document->quantity_generic }}</i><br>
                    @endif
                    @if ( ( trim( $multimedia->document->volume != NULL) ) && ( trim( $multimedia->document->volume != '') ) )   
                        <b>Volumen:</b> <i>{{ $multimedia->document->volume }}</i><br>
                    @endif
                    @if ( ( trim($multimedia->edition  != NULL) ) && ( trim($multimedia->edition  != '') ) )   
                        <b>Edición:</b> <i>{{ $multimedia->edition }}</i><br>
                    @endif
                    @if ( ( trim($multimedia->document->location != NULL) ) && ( trim($multimedia->document->location != '') ) )   
                        <b>Ubicación:</b> <i>{{ $multimedia->document->location }}</i><br>
                    @endif            
                </div>
            </td>
            <td style="width: 20%;">
            </td>
        </tr> 
    </table>
</div>
<br>
<!-- <div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 100%;">
            <b>Sinopsis:</b><br>
            <p><i>{!! $multimedia->document->synopsis != NULL ? $multimedia->document->synopsis : 'Sin sinopsis' !!}</i></p>
            </td>
        </tr>
    </table>
</div>
<br> -->
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