<?php

namespace App\Http\Controllers;

use Mail;
use App\Empresa;
use App\Endereco;
use App\Vaga;
use App\Favorito;
use App\Candidato;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Auth;
use DB;


class EmpresaController extends Controller
{
  public function cadastrarVaga(){
    return view('oportunidade');
  }

  public function adicionarEmpresa(Request $request){

    $validatedData = $request->validate([

        'nome_empresa'          => 'required|string|max:255',
        'cnpj'                  => 'required|numeric|cnpj',
        'telefone'              => 'required|numeric',
        'email'                 => 'required|email',
    ]);

    Empresa::create([
        'user_id' => Auth::user()->id,
        'nome_empresa' => $request->nome_empresa,
        'cnpj' => $request->cnpj,
        'telefone' => $request->telefone,
        'email' => $request->email,
      ]);
    return redirect()->route('home');
  }

  /*
  * FUNCAO: Empresa deseja atualizar uma vaga
  * TIPO: POST
  * VIEW: principal_empresa
  */
  public function adicionarVaga(Request $request){
    //   dd($request);
    // dd(Auth::user()->endereco->id);
    $validatedData = $request->validate([
    'nome_vaga'             =>  'required|string|max:255',
    'atribuicoes'           =>  'required|string|max:255',
    'experiencia'           =>  'required|string|max:255',
    'descricao'             =>  'required|string|max:255',
    'quantidade'            =>  'numeric',
    'salario'               =>  'numeric',
    'tipo_de_remuneracao'   =>  'required|string|max:255',

    'uf'                    =>  'required',
    'cidade'                =>  'required',
    'bairro'                =>  'required',
    'rua'                   =>  'required',
    'numero'                =>  'required',
    ]);
    $idVaga = Vaga::create([
        'empresa_id'            => Auth::user()->empresa->id,
        'data_publicacao'       => date("d-m-Y"),
        'nome_vaga'             => $request->nome_vaga,
        'atribuicoes'           => $request->atribuicoes,
        'experiencia'           => $request->experiencia,
        'descricao'             => $request->descricao,
        'quantidade'            => $request->quantidade,
        'salario'               => $request->salario,
        'vaga_para_pcd'         => $request->vaga_para_pcd,
        'tipo_de_vaga'          => $request->tipo_de_vaga,
        'tipo_de_remuneracao'   => $request->tipo_de_remuneracao,
    ]);

    $resultado = Endereco::create([
        'empresa_id'        => Auth::user()->empresa->id,
        'vaga_id'           => $idVaga->id,
        'uf'                => $request->uf,
        'cidade'            => $request->cidade,
        'bairro'            => $request->bairro,
        'rua'               => $request->rua,
        'numero'            => $request->numero,
        'complemento'       => $request->complemento,
    ]);
    // dd($idVaga, $resultado);


    return redirect()->route('home');
  }

  /*
  * FUNCAO: Empresa deseja editar uma vaga
  * TIPO: GET
  * VIEW: principal_empresa
  */
  public function editarVaga(Request $request){
    $resultado = Vaga::where('empresa_id',$request->idEmpresa)->where('id',$request->idVaga)->first();
    // dd($resultado);

    return view('cadastrar_vaga', ['vaga' => $resultado]);

  }

  /*
  * FUNCAO: Empresa deseja remover uma vaga
  * TIPO: GET
  * VIEW: principal_empresa
  */
  public function deletarVaga(Request $request){
    //remover endereco
    Endereco::where('empresa_id',Auth::user()->empresa->id)->where('vaga_id',$request->idVaga)->delete();
    //remover vaga
    Vaga::where('empresa_id',Auth::user()->empresa->id)->where('id',$request->idVaga)->delete();

    return redirect()->route('home');
  }

  /*
  * FUNCAO: Empresa deseja atualizar uma vaga
  * TIPO: POST
  * VIEW: principal_empresa
  */
  public function atualizarVaga(Request $request){
    $validatedData = $request->validate([
        'nome_vaga'             =>  'required|string|max:255',
        'atribuicoes'           =>  'required|string|max:255',
        'experiencia'           =>  'required|string|max:255',
        'descricao'             =>  'required|string|max:255',
        'quantidade'            =>  'numeric',
        'salario'               =>  'numeric',
        'tipo_de_remuneracao'   =>  'required|string|max:255',

        'uf'                    =>  'required',
        'cidade'                =>  'required',
        'bairro'                =>  'required',
        'rua'                   =>  'required',
        'numero'                =>  'required',
      ]);
    //   dd(Auth::user()->empresa->id);
    Vaga::where('empresa_id',Auth::user()->empresa->id)->where('id',$request->idVaga)
    ->update([
        'data_publicacao'       => date("d-m-Y"),
        'nome_vaga'             => $request->nome_vaga,
        'atribuicoes'           => $request->atribuicoes,
        'experiencia'           => $request->experiencia,
        'descricao'             => $request->descricao,
        'quantidade'            => $request->quantidade,
        'salario'               => $request->salario,
        'vaga_para_pcd'         => $request->vaga_para_pcd,
        'tipo_de_vaga'          => $request->tipo_de_vaga,
        'tipo_de_remuneracao'   => $request->tipo_de_remuneracao,
    ]);
    Endereco::where('empresa_id',Auth::user()->empresa->id)->where('vaga_id',$request->idVaga)
    ->update([
        'uf'                    => $request->uf,
        'vaga_id'               => $request->idVaga,
        'cidade'                => $request->cidade,
        'bairro'                => $request->bairro,
        'rua'                   => $request->rua,
        'numero'                => $request->numero,
        'complemento'           =>$request->complemento,
    ]);
    return redirect()->route('home')->with('sucesso', 'A vaga '. $request->nome_vaga .' foi atualizada com sucesso.');
  }

  /*
  * FUNCAO: Empresa tem interesse ou não no candidato
  * TIPO: POST
  * VIEW: principal_empresa
  */
  public function interesseNoCandidato(Request $request){
    // dd($request);
    // return view('emails.mensagem_email');
    $this->validate($request,[
        'candidato_id'             =>  'required',
        'vaga_id'                  =>  'required',
    ]);

    DB::table('matches')
    ->where('candidato_id','like', $request->candidato_id)
    ->where('vaga_id','like',$request->vaga_id)
    ->update(['empresa_id'=> Auth::user()->empresa->id, 'match'=>$request->match]);

        // if($request->match=='TRUE'){
        //     EmailController::enviarEmail($request);
        // }

    return redirect()->back(); //->with('sucesso', 'E-mail enviado com sucesso!');
  }

  /*
  * FUNCAO: Carregar view principal do usuario empresa
  * TIPO: GET
  * VIEW: principal_empresa
  */
  public function principalEmpresa(){
    $resultado = Empresa::where('user_id',Auth::user()->id)->get();

    $resultadoMatches = DB::table('vagas')
    ->join('matches','vagas.id','=','matches.vaga_id')
    ->where('vagas.empresa_id','=',Auth::user()->id)
    ->get();
    return view('principal_empresa', ['empresas'=>$resultado, 'vagas'=>$resultadoMatches]);
  }

  public function buscarOportunidade(Request $request){
    //$empresas = Empresa::where('nome_empresa', 'like', '%' . strtolower($request->busca) . '%')-> paginate(10);
        // $resultado = DB::table('empresas')
        // ->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
        // ->join('vagas','empresas.id','=','vagas.empresa_id')
        // ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
        // ->where('vagas.nome_vaga','ilike','%'. $request->busca .'%')
        // ->orwhere('empresas.nome_empresa','ilike','%'. $request->busca .'%')
        // ->get();

    $resultado = Vaga::where('nome_vaga',  'ilike', '%'. $request->busca .'%')->get();

    //return view('resultado_busca_nao_logado', ['empresas' => $resultado]);
    return view('principal_candidato', ['empresas' => $resultado]);
  }
  public function listarInteressados(Request $request){
    $candidatos_id = Favorito::where('vaga_id', $request->vaga_id)->select('id')->get();
    $candidatos = Candidato::whereIn('id', $candidatos_id)->paginate(10);
    return view('', ['candidatos' => $candidatos]);

  }
  public function buscarNaoLogadoCandidato(Request $request){
    //dd($request);
    $string_de_busca1 = strtolower($request->campo_texto3);

    //Busca
    if($request->campo_texto3 != null){
        $resultado = DB::table('candidatos')
        ->leftJoin('enderecos','candidatos.user_id','=','enderecos.id')
        ->leftJoin('escolaridades','candidatos.id','=','escolaridades.candidato_id')
        ->leftJoin('experiencias','candidatos.id','=','experiencias.candidato_id')
        ->leftJoin('cargos','candidatos.id','=','cargos.experiencia_id')
        ->select('candidatos.nome_completo','candidatos.data_de_nascimento','candidatos.cpf','candidatos.email', 'candidatos.telefone','candidatos.celular','candidatos.funcao', 'candidatos.tipo_de_deficiencia','escolaridades.instituicao','escolaridades.curso','escolaridades.data_inicio','escolaridades.data_conclusao','experiencias.nome_empresa','experiencias.atribuicao','experiencias.data_inicio', 'experiencias.data_fim','cargos.nome_cargo','enderecos.uf','enderecos.cidade','enderecos.bairro','enderecos.rua','enderecos.numero','enderecos.complemento')
        ->where('candidatos.funcao','ilike','%'. $request->campo_texto3 .'%')
        ->get();
        return view('resultado_busca_nao_logado_sou_empresa', ['candidatos' => $resultado]);
    }else{
        $resultado = DB::table('candidatos')
        ->leftJoin('enderecos','candidatos.user_id','=','enderecos.id')
        ->leftJoin('escolaridades','candidatos.id','=','escolaridades.candidato_id')
        ->leftJoin('experiencias','candidatos.id','=','experiencias.candidato_id')
        ->leftJoin('cargos','candidatos.id','=','cargos.experiencia_id')
        ->select('candidatos.nome_completo','candidatos.data_de_nascimento','candidatos.cpf','candidatos.email', 'candidatos.telefone','candidatos.celular','candidatos.funcao', 'candidatos.tipo_de_deficiencia','escolaridades.instituicao','escolaridades.curso','escolaridades.data_inicio','escolaridades.data_conclusao','experiencias.nome_empresa','experiencias.atribuicao','experiencias.data_inicio', 'experiencias.data_fim','cargos.nome_cargo','enderecos.uf','enderecos.cidade','enderecos.bairro','enderecos.rua','enderecos.numero','enderecos.complemento')
        ->get();
        return view('resultado_busca_nao_logado_sou_empresa', ['candidatos' => $resultado]);
    }
  }
}
