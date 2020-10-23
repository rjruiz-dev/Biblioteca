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
            color: #FFF;
            background-color: {{ $setting->skin }};
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .info table {
            padding: 10px;
           
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
    <table width="100%" style="color:white;     background: #999934;">
        <tr>
            <td align="left" style="width: 50%;">
                <b>Siglas Autor: {{ $book->document->let_author }}&nbsp;&nbsp; Siglas Título: {{ $book->document->let_title }}&nbsp;&nbsp; </b>
            </td>
            <td align="right" style="width: 50%;">
                <b>Cdu: {{ $book->document->subjects->cdu }}&nbsp;&nbsp; NR: {{ $book->document->id }}</b>
            </td>
        </tr>
    </table>
</div>
<div class="info">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Portada</i></h2>
            </td>
            <td align="right" style="width: 50%;">
                <h2 align="left"> <i>Sobre el Documento</i></h2>
            </td>
        </tr>
    </table>
</div>

<div class="info">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <!-- <h2>Portada</h2> -->
                <img src= "{{ public_path("/images/". $book->document->photo) }}">            
                <br>       
<pre>
<b>Titulo: {{ $book->document->let_author }} </b>
<b>Autor: {{ $book->document->creator->creator_name }} </b>
<b>Subtipo de Documento: {{ $book->document->document_subtype->subtype_name  }} </b>      
</pre>
            </td>            
            <td align="right" style="width: 40%;">
            
            @if (( $book->second_author_id == NULL ) && ($book->third_author_id == NULL))   
                          @php                       
                          $texto = 'No tiene autores';
                          @endphp
                          @else
                                @if (( $book->second_author_id != NULL ) && ($book->third_author_id != NULL))
                                @php
                                        $coma = ", ";
                                @endphp
                                @else
                                @php
                                        $coma = "";
                            $texto = $book->second_author->creator_name." ".$coma." ".$book->third_author->creator_name;
                                 @endphp
                            @endif
            
                <!-- <h2 align="left">Sobre el Documento</h2> -->
                <div style="text-align: center; margin-top: -150px;">
                        <b>{{ $book->document->original_title != NULL ? $book->document->original_title : 'Sin titulo Original'}}<br></b> 
                        <b> {{ $book->subtitle != NULL ? $book->subtitle : 'Sin Subtitulo'}}</b><br>
                        {{ $texto }}; Editorial Planeta SA; 1983; 2ª; 1 Vol.; 280; ISBN: 84-320-5683-9; &nbsp;
                        Disponible desde: 00-00-0000; Genero: Cuento Adecuado para: Todos;&nbsp; 
                        Idioma: Castellano;&nbsp; 
                        Valoración: 1<br> 
                        Versión 3.0. Interactivo<br>
                        S1-E1-Es3-L5<br>
                </div>
<!-- <pre>
<p align="left"><b>Titulo: <i>{{ $book->document->let_author }}</i></b></p> 
<p align="left"><b>Autor: <i>{{ $book->document->creator->creator_name }} </i></b></p>
<p align="left"><b>Subtipo de Documento: <i>{{ $book->document->document_subtype->subtype_name  }} </i></b></p>                 
</pre> -->
            </td>
            <td style="width: 20%;">
            </td>
        </tr> 
    </table>
</div>
<br>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Slogan
            </td>
        </tr>
    </table>
</div>
</body>
</html>