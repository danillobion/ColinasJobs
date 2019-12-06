<?php

namespace App\Http\Controllers;

use Mail;
use App\Empresa;
use App\Endereco;
use App\Vaga;
use App\Favorito;
use App\Candidato;
use Illuminate\Http\Request;
use Auth;
use DB;



class EmailController extends Controller{

    /*
    *   FUNCAO: Enviar email da empresa para o candidato
    *   TIPO:   POST
    *   VIEW:   principal_empresa
    */
    public static function enviarEmail(Request $request){
        // dd($request->emailCandidato);
        // $data = array(
        //     'candidato' =>$dados->nome,
        //     'email'     =>$dados->email,
        //     'empresa'   =>$dados->empresa,
        //     'vaga'      =>$dados->vaga,
        // );

        //verifico se a mesagem é personalizada
        if($request->campoMensagem != null ){
            $to = $request->emailCandidato;
            $data = array(
                'text' => $request->campoMensagem,
            );

            $subject = 'Solicita - Status da Requisicao: ';
            Mail::send('emails.mensagem_email_personalizado', $data, function($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
                $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
            });

        }else{
            // dd('null');
            $to = $request->emailCandidato;
            $data = array(
                'text' => $request->nome,
                'empresa' => $request->empresa,
                'vaga' => $request->vaga,
            );

            $subject = 'Solicita - Status da Requisicao: ';
            Mail::send('emails.mensagem_email', $data, function($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
                $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
            });
            // dd('ñ é null');

        }




        // $to = $request->emailCandidato;
        // $data = array(
        //     'text' => $request->nome,
        //     'empresa' => $request->empresa,
        // );

        // $subject = 'Solicita - Status da Requisicao: ';
        // Mail::send('emails.mensagem_email', $data, function($message) use ($to, $subject) {
        //     $message->to($to)
        //             ->subject($subject);
        //     $message->from('naoresponder.lmts@gmail.com','Solicita - LMTS');
        // });
    }
}
