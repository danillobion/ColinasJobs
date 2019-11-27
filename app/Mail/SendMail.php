<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $id_documento;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->requisicao = $id_documento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
        // $subject = 'Solicita - Status do documento';
        // return $this->from('noreply.solicita.lmts@gmail.com', 'Solicita - LMTS')
        //             ->subject($subject)
        //             ->view('mails.status');
    }
}
