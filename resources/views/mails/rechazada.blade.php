¡Hola! <i>{{$mail->nombre}}</i>.
<p>Si has recibido este correo significa que tu petición de acceso no hemos podido aceptar tu petición. Esto es debido a:</p>

<p>{{$mail->mensaje}}</p>

<p>Lamentamos las molestias. Puede intentar registrarse de nuevo corrigiendo esta información</p>

Un saludo,
<br/>
<i>{{ $mail->sender }}</i>
