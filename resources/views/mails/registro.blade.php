@component('mail::message')
# Bienvenido

Te has registrado en nuestro sistema con el correo: {{ $email }}

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
