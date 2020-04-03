¡Hola! <i>{{$mail->nombre}}</i>.
<h2>¡Bienvenido!</h2>
<p>Si has recibido este correo significa que has podido registrarte correctamente. Ya puedes acceder a nuestro sitio.</p>
<h3>Tus credenciales de acceso son las siguientes:</h3>
<h3>Usuario:</h3><i>{{$mail->username}}</i>
<h3>Contraseña</h3><i>{{$mail->password}}</i>
Un saludo,
<br/>
<i>{{ $mail->sender }}</i>
