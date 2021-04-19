@component('mail::message')

**E-MAIL DE PRUEBAS PARA {{ $details['destinatario'] }}**

<hr>


<h2><p>Envia: {{ $details['remitente'] }}</p></h2>
<h2><p>Mensaje: {{ $details['mensaje'] }}</p></h2>

<hr>


{{ date('Y') }}<br>

Gracias,<br>
{{ config('app.name') }}
@endcomponent
