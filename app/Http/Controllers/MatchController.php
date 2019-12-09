<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use Auth;

class MatchController extends Controller
{
	/*
	*	FUNCAO: Listar todos os matches da empresa 
	*	TIPO: GET
	*	VIEW: lista_matches_empresa.blade
	*/
    public function listarMatches(){
    	$resultado = Empresa::where('id', Auth::user()->empresa->id)->get();
    	return view('lista_matches_empresa', ['matches' => $resultado]);
    }
}
