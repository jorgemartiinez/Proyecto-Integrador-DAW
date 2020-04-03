¡Hola! El usuario con nombre <i>{{$mail->nombre}}</i> y correo <i> {{$mail->email}}</i> ha intentado ponerse en contacto con nosotros.
<h2>Asunto: </h2>
<p>{{$mail->asunto}}</p>
<h2>Mensaje: </h2>
<p>{{$mail->mensaje}}</p>
Un saludo,
<br/>
<i>{{ $mail->sender }}</i>
