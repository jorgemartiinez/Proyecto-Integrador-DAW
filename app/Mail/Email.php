<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $vista;
    public $vistaTexto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail, $vista, $vistaTexto)
    {
        //inicializar variables plantilla correo
        $this->mail = $mail;
        $this->vista = $vista;
        $this->vistaTexto = $vistaTexto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('jorgemartinezswiftmailer@gmail.com')
            ->view($this->vista)
            ->subject($this->mail->asunto)
            ->text($this->vistaTexto)
            ->attach(public_path('/images').'/cau.jpeg', [
                'as' => 'cau.jpeg',
                'mime' => 'image/jpeg',
            ]);
    }
}
