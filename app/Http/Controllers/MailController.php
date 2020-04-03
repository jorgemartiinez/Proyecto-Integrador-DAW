<?php

namespace App\Http\Controllers;

use App\Http\Request\StoreContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class MailController extends Controller
{

    //const sender = 'El Cau';

    public function sendContacto(StoreContacto $request){
        $mail = new \stdClass();
        $mail->sender = 'El Cau';
        $mail->email = $request->email;
        $mail->nombre = $request->nombre;
        $mail->asunto = $request->asunto;
        $mail->mensaje = $request->mensaje;
        Mail::to("jorgemartinezswiftmailer@gmail.com")->send(new Email($mail,
            'mails.contactus',           //vista grafica
            'mails.contactus_plain'));   //vista texto

    }

    public function sendAceptada(Request $request){
        $mail = new \stdClass();
        $mail->sender = 'El Cau';
        $mail->email = $request->email;
        $mail->nombre = $request->nombre;
        $mail->asunto = "Petición de acceso aceptada";
        Mail::to($request->email)->send(new Email($mail,
            'mails.aceptada',           //vista grafica
            'mails.aceptada_plain'));   //vista texto

        return redirect('/admin/users');
    }

    public function sendRechazada(Request $request){
        $mail = new \stdClass();
        $mail->sender = 'El Cau';
        $mail->email = $request->email;
        $mail->nombre = $request->nombre;
        $mail->asunto = "Petición de acceso rechazada";
        $mail->mensaje = $request->mensajeRechazado;
        Mail::to($request->email)->send(new Email($mail,
            'mails.rechazada',           //vista grafica
            'mails.rechazada_plain'));   //vista texto

        return redirect('/admin/users');
    }



    public function sendRegistroPadre(Request $request){

        for ($i = 0; $i < 1; $i++) {

            $mail = new \stdClass();
            $mail->sender = 'El Cau';
            $mail->nombre = $request[$i]['nombre'];
            $mail->asunto = "Se ha registrado correctamente. Petición de acceso pendiente.";
            $mail->username = $request[$i]['username'];
            $mail->password =  $request[$i]['password'];
            Mail::to($request[$i]['email'])->send(new Email($mail,
                'mails.registroPadre',
                'mails.registroPadre_plain'));

        }
    }

}
