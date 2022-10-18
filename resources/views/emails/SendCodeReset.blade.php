<h1>Hemos recivido tu solicitud para cambiar la contraseña de tu cuenta</h1>
<p>Puedes usar el siguiente codigo para recuperar tu cuenta:</p>

@component('mail::panel')
{{ $token }}
@endcomponent

<p>La duración del codigo es de una hora desde que el mensaje fue enviado</p>
