<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->document->title }}</title>

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
                <b>Siglas Autor: {{ $book->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $book->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $book->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $book->document->id }}</b>
            </td>
        </tr>
    </table>
<br>
<div class="detalle">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <!-- <h2>Portada</h2> -->
                <img src= "{{ public_path("/images/". $book->document->photo) }}"  width="300" height="380"> 
                <br>       
<pre>
<b>Titulo: {{ $book->document->title }} </b>
<b>Autor: {{ $book->document->creator->creator_name }} </b>
<b>Subtipo de Documento: {{ $book->document->document_subtype->subtype_name  }} </b> 
</pre>
            </td>            
            <td align="right" style="width: 40%;">
          
                <div style="text-align: center; margin-top: -120px;">
                <!-- EJEMPLO PARA IMPLEMENTAR EN DEMAS CAMPOS. ---- para select valdiar != null y que sea mayor a 0 -->
                    @if ( ( trim($book->document->original_title != NULL) ) && ( trim($book->document->original_title != '') ) )   
                        <b>Título Original:</b> <i>{{ $book->document->original_title }}</i><br> 
                    @endif
                    @if ( ( trim($book->subtitle != NULL) ) && ( trim($book->subtitle != '') ) )   
                        <b>Subtítulo:</b> <i>{{ $book->subtitle }}</i><br>
                    @endif
                    <!-- VER -->
                    @if ( ( trim($book->second_author_id != NULL) ) && ( trim($book->third_author_id != '') ) )   
                    @if (( $book->second_author_id == NULL ) && ($book->third_author_id == NULL))   
                        <b>Otros autores:</b> <i>No tiene otros autores</i><br>   
                    @else
                            @if (( $book->second_author_id != NULL ) && ($book->third_author_id != NULL))
                            @php
                                    $coma = ", ";
                            @endphp
                            @else
                            @php
                                    $coma = "";
                            @endphp
                            @endif
                    <b>Otros autores:</b> <i>{{ $book->second_author_id != NULL ? $book->second_author->creator_name : null }} {{$coma}} {{ $book->third_author_id != NULL ? $book->third_author->creator_name : null }}</i><br>
                    @endif 
                    @endif      
                    @if ( ( trim($book->document->published != NULL) ) && ( trim($book->document->published != '') ) )   
                        <b>Publicado en:</b> <i>{{ $book->document->published }}</i><br>
                    @endif
                    @if ( ( trim($book->document->made_by != NULL) ) && ( trim($book->document->made_by != '') ) )   
                        <b>Editorial:</b> <i>{{ $book->document->made_by }}</i><br>
                    @endif                   
                        <b>Año:</b> <i>{{ Carbon\Carbon::parse($book->document->year)->format('Y')  }}</i><br>                          
                        <b>Idioma:</b> <i>{{ $book->document->lenguage['leguage_description'] }}</i><br>                 
                    @if ( ( trim($book->document->volume != NULL) ) && ( trim($book->document->volume != '') ) )   
                        <b>Volumen:</b> <i>{{ $book->document->volume }}</i><br>
                    @endif                   
                        <b>Disponible desde:</b> <i>{{ Carbon\Carbon::parse($book->document->acquired)->format('d-m-Y') }}</i><br>
                        
                    @if ( ( trim($book->document->quantity_generic != NULL) ) && ( trim($book->document->quantity_generic != '') ) )   
                        <b>Número de paginas:</b> <i>{{ $book->document->quantity_generic }}</i><br>
                    @endif
                    @if ( ( trim($book->size != NULL) ) && ( trim($book->size != '') ) )   
                        <b>Tamaño:</b> <i>{{ $book->size }}</i><br>
                    @endif
                    @if ( ( trim($book->document->adequacy['adequacy_description'] != NULL) ) && ( trim($book->document->adequacy['adequacy_description'] != '') ) )   
                        <b>Adecuado para:</b> <i>{{ $book->document->adequacy['adequacy_description'] }}</i><br>
                    @endif
                    @if ( ( trim( $book->document->assessment != NULL) ) && ( trim( $book->document->assessment != '') ) )   
                        <b>Valoración:</b> <i>{{ $book->document->assessment }}</i><br>
                    @endif
                    @if ( ( trim($book->document->location != NULL) ) && ( trim($book->document->location != '') ) )   
                        <b>Ubicación:</b> <i>{{ $book->document->location }}</i><br>
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
            @if ( ( trim($book->document->synopsis != NULL) ) && ( trim($book->document->synopsis != '') ) )   
            <b>Sinopsis:</b><br>
            <p><i>{!! $book->document->synopsis !!}</i></p>
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