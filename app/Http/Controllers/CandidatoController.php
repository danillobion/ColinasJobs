<?php

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Request;
use App\Empresa;
use App\Vaga;
use App\Endereco;
use App\Escolaridade;
use App\Experiencia;
use App\Cargo;
use App\Match;
use App\User;

use Auth;
use DB;

class CandidatoController extends Controller
{

    //adicionar
    public function cadastrarCurriculo(){
      return view('curriculum', [Auth::user()->id]);
    }

    public function adicionar(Request $request){

      $user_id = Auth::user()->id;

      //dd($request);
      $this->validate($request,[
        'nome_completo'         => 'required|string|min:3|max:255',
        'cpf'                   => 'required|cpf',
        'email'                 => 'required|email',
        'data_de_nascimento'    => 'required|date',

        'celular'               => 'numeric',
        'funcao'                => 'required|string|max:255',
        'nivel_de_formacao'     => 'required|string|max:255',
        'tipo_de_deficiencia'   => 'required|string|max:255',

        'uf'                    =>  'required',
        'cidade'                =>  'required',
        'bairro'                =>  'string|max:255',
        'rua'                   =>  'string|max:255',
        'numero'                =>  'max:255',

        'instituicao'           =>  'string|min:3|max:255',
        'curso'                 =>  'string|min:3|max:255',
        'data_inicio'           =>  'required|date',
        'data_conclusao'        =>  'required|date',

        'nome_empresa'          =>  'required|string|max:255',
        'atribuicao'            =>  'required|string|max:255',
        'data_inicio'           =>  'required|date',
        'data_fim'              =>  'required|date',

        'nome_cargo'            =>  'required|string|max:255',

      ]);


      Candidato::create([
        'user_id'            =>Auth::user()->id,
        'nome_completo'      =>$request->nome_completo,
        'cpf'                =>$request->cpf,
        'email'              =>$request->email,
        'data_de_nascimento' =>$request->data_de_nascimento,
        'telefone'           =>$request->telefone,
        'funcao'             =>$request->funcao,
        'celular'            =>$request->celular,
        'nivel_de_formacao'  =>$request->nivel_de_formacao,
        'tipo_de_deficiencia'=>$request->tipo_de_deficiencia,
      ]);
      Endereco::create([
        'candidato_id'      => Auth::user()->candidato->id,
        'uf'                => $request->uf,
        'cidade'            => $request->cidade,
        'bairro'            => $request->bairro,
        'rua'               => $request->rua,
        'numero'            => $request->numero,
        'complemento'       => $request->complemento,
      ]);
      Escolaridade::create([
        'candidato_id'      => Auth::user()->candidato->id,
        'instituicao'       => $request->instituicao,
        'curso'             => $request->curso,
        'data_inicio'       => $request->data_inicio,
        'data_conclusao'    => $request->data_conclusao,
      ]);
      Experiencia::create([
          'candidato_id'    => Auth::user()->candidato->id,
          'nome_empresa'    => $request->nome_empresa,
          'atribuicao'      => $request->atribuicao,
          'data_inicio'     => $request->data_inicio,
          'data_fim'        => $request->data_fim,
      ]);
      Cargo::create([
          'experiencia_id'  => Auth::user()->candidato->id,
          'nome_cargo'      => $request->nome_cargo,
      ]);
      return redirect()->route('home');//view('principal_candidato');


    }

    public function adicionarMiniCurriculo(Request $request){

        $user_id = Auth::user()->id;

        $this->validate($request,[
            'nome_completo'         => 'required|string|min:3|max:255',
            'cpf'                   => 'required|cpf',

            'data_de_nascimento'    => 'required|date',
            'celular'               => 'numeric',
            'funcao'                => 'required|string|max:255',
            'tipo_de_deficiencia'   => 'required|string|max:255',
        ]);

        $user_id = Auth::user()->id;

        $user = User::find($user_id);
        $user->name = $request->nome_completo;
        $user->save();


        Candidato::create([
            'user_id'            =>Auth::user()->id,
            'nome_completo'      =>$request->nome_completo,
            'cpf'                =>$request->cpf,
            'email'              =>$user->email,
            'data_de_nascimento' =>$request->data_de_nascimento,
            'telefone'           =>$request->telefone,
            'funcao'             =>$request->funcao,
            'celular'            =>$request->celular,
            'tipo_de_deficiencia'=>$request->tipo_de_deficiencia,
        ]);
        return redirect()->route('home');//view('principal_candidato');
    }

    public function adicionarEndereco(Request $request){
        //dd(Auth::user()->candidato->id);
        $this->validate($request,[
            'uf'                    =>  'required',
            'cidade'                =>  'required',
            'bairro'                =>  'max:255',
            'rua'                   =>  'max:255',
            'numero'                =>  'max:255',
            'complemento'           =>  'max:255',
        ]);
        Endereco::create([
            'candidato_id'      => Auth::user()->candidato->id,
            'uf'                => $request->uf,
            'cidade'            => $request->cidade,
            'bairro'            => $request->bairro,
            'rua'               => $request->rua,
            'numero'            => $request->numero,
            'complemento'       => $request->complemento,
        ]);
        return redirect()->route('abrir_painel_curriculum');//view('principal_candidato');
    }

    public function adicionarEscolaridade(Request $request){
        //  dd($request);
    //    dd(Auth::user()->candidato->user_id);
        $this->validate($request,[
            'nivel_educacional'     =>  'required|string|min:3|max:255',
            'instituicao'           =>  'string|min:3|max:255',
            'curso'                 =>  'string|min:3|max:255',
            // 'data_inicio'           =>  'required|date',
            'anodeconclusao'        =>  'date',
        ]);
        Escolaridade::create([
            'candidato_id'          => Auth::user()->candidato->id,
            'status'                => $request->status,
            'nivel_educacional'     => $request->nivel_de_formacao,
            'instituicao'           => $request->instituicao,
            'curso'                 => $request->curso,
            'data_inicio'           => $request->data_inicio,
            'anodeconclusao'        => $request->data_conclusao,
        ]);
        return redirect()->route('editarEscolaridade');
    }

    public function adicionarExperiencias(Request $request){

        Experiencia::create([
            'candidato_id'    => Auth::user()->candidato->id,
            'nome_empresa'    => $request->nome_empresa,
            'atribuicao'      => $request->atribuicao,
            'data_inicio'     => $request->data_inicio,
            'data_fim'        => $request->data_fim,
        ]);
        Cargo::create([
            'experiencia_id'  => Auth::user()->candidato->id,
            'nome_cargo'      => $request->nome_cargo,
        ]);

        return redirect()->route('abrir_painel_curriculum');
    }

    public function adicionarMatch(Request $request){
       // dd($request);
        $this->validate($request,[
            'vaga_id'                    =>  'required',
            'empresa_id'                 =>  'required',
        ]);
        if(self::verificaInteresseNaVaga($request)!=true){
            Match::create([
                'candidato_id'      => Auth::user()->candidato->id,
                'vaga_id'           => $request->vaga_id,
            ]);
            return redirect()->route('home');//view('principal_candidato');
        }else{
            return redirect()->route('home');
        }
    }

    public function verificaInteresseNaVaga(Request $request){
        $resultado = Match::where('candidato_id',Auth::user()->candidato->id)->where('vaga_id',$request->vaga_id)->exists();
        return $resultado;
    }

    public function removerInteresseNaVaga(Request $request){
        $this->validate($request,[
            'vaga_id'                    =>  'required',
            'empresa_id'                 =>  'required',
        ]);
        $resultado = Match::where('candidato_id',Auth::user()->candidato->id)->where('vaga_id',$request->vaga_id)->delete();
        return redirect()->route('home');
    }

    public function removerInteresseNaVagaViewLista(Request $request){
        $this->validate($request,[
            'vaga_id'                    =>  'required',
            'empresa_id'                 =>  'required',
        ]);
        $resultado = Match::where('candidato_id',Auth::user()->candidato->id)->where('vaga_id',$request->vaga_id)->delete();
        return redirect()->route('listarMeuInteresse');
    }

    //editar
    public function editarMiniCurriculo(){
        $resultado = DB::table('candidatos')
        ->select('candidatos.nome_completo', 'candidatos.cpf','candidatos.email','candidatos.telefone','candidatos.celular','candidatos.funcao','candidatos.tipo_de_deficiencia','candidatos.data_de_nascimento')
        ->where('candidatos.user_id', 'ilike', Auth::user()->id)
        ->get();
        return view('curriculum',['candidatos' => $resultado]);
    }

    public function editarEndereco(){
        $resultado = DB::table('enderecos')
        ->select('enderecos.uf','enderecos.cidade','enderecos.bairro','enderecos.rua','enderecos.numero', 'enderecos.complemento')
        ->where('enderecos.candidato_id','ilike', Auth::user()->candidato->id)
        ->get();
        //dd(!is_null($resultado));
        return view('endereco_candidato', ['enderecos'=>$resultado]);
    }

    public function editarEscolaridade(){
        // $resultado = DB::table('escolaridades')
        // ->select('escolaridades.instituicao','escolaridades.curso','escolaridades.data_inicio','escolaridades.data_conclusao')
        // ->where('escolaridades.candidato_id','ilike',Auth::user()->candidato->id)
        // ->get();
        $resultado = Escolaridade::where('candidato_id',Auth::user()->candidato->id)->get();
        //dd(empty($resultado));
        return view('escolaridade_candidato', ['escolaridades'=>$resultado]);
    }

    public function editarExperiencia(){
        $resultado = DB::table('experiencias')
        ->leftJoin('cargos','experiencias.candidato_id','=','cargos.experiencia_id')
        ->select('experiencias.nome_empresa','experiencias.atribuicao','experiencias.data_inicio','experiencias.data_fim', 'cargos.nome_cargo')
        ->where('experiencias.candidato_id','ilike','26')
        ->get();
        //dd($resultado);
        return view('experiencia_candidato', ['experiencias'=>$resultado]);
    }

    //atualizar
    public function atualizarMiniCurriculo(Request $request){
        $user_id = Auth::user()->id;

        $this->validate($request,[
            'nome_completo'         => 'required|string|min:3|max:255',
            'cpf'                   => 'required|numeric|cpf',
            'data_de_nascimento'    => 'required|date',
            'celular'               => 'required|numeric',
            'funcao'                => 'required|string|max:255',
            'tipo_de_deficiencia'   => 'required|string|max:255',
        ]);

        $user_id = Auth::user()->id;

        $user = User::find($user_id);
        $user->name = $request->nome_completo;
        $user->save();


        $resultado = DB::table('candidatos')
        ->where('candidatos.user_id', 'ilike', Auth::user()->id)
        ->update([
            'nome_completo'         =>  $request->nome_completo,
            'cpf'                   =>  $request->cpf,
            'email'                 =>  $request->email,
            'data_de_nascimento'    =>  $request->data_de_nascimento,
            'celular'               =>  $request->celular,
            'telefone'              =>  $request->telefone,
            'funcao'                =>  $request->funcao,
            'tipo_de_deficiencia'   =>  $request->tipo_de_deficiencia,
        ]);

        return redirect()->route('abrir_painel_curriculum');
    }

    public function atualizarEndereco(Request $request){
        //dd($request);
        $user_id = Auth::user()->id;

        $this->validate($request,[
            'uf'            => 'required|string',
            'cidade'        => 'required|string',
        ]);
        $resultado = DB::table('enderecos')
        ->where('enderecos.candidato_id','ilike',Auth::user()->candidato->id)
        ->update([
            'uf'            =>  $request->uf,
            'cidade'        =>  $request->cidade,
            'bairro'        =>  $request->bairro,
            'rua'           =>  $request->rua,
            'numero'        =>  $request->numero,
            'complemento'   =>  $request->complemento,
        ]);


        return redirect()->route('abrir_painel_curriculum');

    }
    /*
    * FUNCAO: e utilizada pelo modal para editar e adicionar escolaridade
    * VIEW: escolaridade_candidato
    */
    public function adicionarEAtualizarEscolaridade(Request $request){
        // dd($request);
        //valido os campos antes de entrar no comando de decisao
        $this->validate($request,[
            'nivel_educacional'     =>  'string|max:255',
            'instituicao'           =>  'string|max:255',
            'curso'                 =>  'string|max:255',
            'data_conclusao'        =>  'date',
        ]);

        if($request->flagTemp == "adicionar"){
            $this->adicionarEscolaridade($request);
        }else{
            // dd($request);
            $this->atualizarEscolaridade($request);
        }
        return redirect()->route('editarEscolaridade');
    }

    public function atualizarEscolaridade(Request $request){
        $resultado = DB::table('escolaridades')
        ->where('escolaridades.candidato_id','ilike',Auth::user()->candidato->id)
        ->where('escolaridades.id','ilike',$request->escolaridade_id)
        ->update([
            'nivel_de_formacao' => $request->nivel_educacional,
            'instituicao'       => $request->instituicao,
            'curso'             => $request->curso,
            'data_conclusao'    => $request->anodeconclusao,
        ]);
        return redirect()->route('editarEscolaridade');

    }
    /*
    * FUNCAO: remover escolaridade
    * VIEW: escolaridade_candidato
    */
    public function deletarEscolaridade(Request $request){
        // dd($request);
        $this->validate($request,[
            'nivel_educacional'     =>  'string|max:255',
            'instituicao'           =>  'string|max:255',
            'curso'                 =>  'string|max:255',
            'data_inicio'           =>  'date',
            'data_conclusao'        =>  'date',
        ]);
        $resultado = DB::table('escolaridades')
        ->where('escolaridades.candidato_id','ilike',Auth::user()->candidato->id)
        ->where('escolaridades.id','ilike',$request->escolaridade_id)
        ->delete();

        return redirect()->route('editarEscolaridade');
    }

    public function atualizarExperiencia(Request $request){
        //dd($request);
        $this->validate($request,[
            'nome_empresa'  =>  'string|min:3|max:255',
            'atribuicao'    =>  'string|min:3|max:255',
            'data_inicio'   =>  'required|date',
            'data_fim'      =>  'required|date',
            'nome_cargo'    =>  'string|min:3|max:255',
        ]);
        $resultado = DB::table('experiencias')
        ->select('experiencias.nome_empresa','experiencias.atribuicao','experiencias.data_inicio','experiencias.data_fim')
        ->where('experiencias.candidato_id','ilike',Auth::user()->candidato->id)
        ->update([
            'nome_empresa'  =>  $request->nome_empresa,
            'atribuicao'    =>  $request->atribuicao,
            'data_inicio'   =>  $request->data_inicio,
            'data_fim'      =>  $request->data_fim,
        ]);
            $this->atualizarCargo($request);
            return redirect()->route('abrir_painel_curriculum');
    }

    private function atualizarCargo(Request $request){
        $resultado = DB::table('cargos')
        ->where('cargos.experiencia_id','ilike',Auth::user()->candidato->id)
        ->update([
            'nome_cargo'  =>  $request->nome_cargo,
        ]);
        return redirect()->route('abrir_painel_curriculum');
    }

    //buscar
    public function buscarCandidato(Request $request){
        $candidatos = Candidato::where('nome_completo', 'like', '%' . strtolower($request->busca) . '%')-> paginate(10);
        return view('principal_empresa', ['candidatos' => $candidatos]);
    }

    public function listarMeuInteresse(){
        $resultado = Match::where('candidato_id',Auth::user()->candidato->id)->get();
        return view('lista_de_vagas_interessadas_candidato', ['match' => $resultado]);
    }

    public function buscarNaoLogado(Request $request){
        $string_de_busca1 = strtolower($request->campo_texto1);
        $string_de_busca2 = strtolower($request->campo_texto2);

        //Busca

        //empresa = null e cidade = null
        if($string_de_busca1 == null && $string_de_busca2 == null){
            $resultado = DB::table('empresas')
            ->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
            ->join('vagas','empresas.id','=','vagas.empresa_id')
            ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero','enderecos.complemento', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
            ->get();
            return view('resultado_busca_nao_logado', ['empresas' => $resultado]);
        }
        //empresa/vaga e cidade
        if($string_de_busca1 != null && $string_de_busca2 != null){
            $resultado = DB::table('empresas')
            ->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
            ->join('vagas','empresas.id','=','vagas.empresa_id')
            ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero','enderecos.complemento', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
            ->where('enderecos.cidade','ilike','%'. $request->campo_texto2.'%')
            ->where('vagas.nome_vaga','ilike','%'. $request->campo_texto1 .'%')
            ->orwhere('empresas.nome_empresa','ilike','%'. $request->campo_texto1 .'%')
            ->get();
            return view('resultado_busca_nao_logado', ['empresas' => $resultado]);
        }
        //empresa/vaga
        if($string_de_busca2 == null){
            $resultado = DB::table('empresas')
            ->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
            ->join('vagas','empresas.id','=','vagas.empresa_id')
            ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero','enderecos.complemento', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
            ->where('empresas.nome_empresa','ilike','%'. $request->campo_texto1 .'%')
            ->orwhere('vagas.nome_vaga','ilike','%'. $request->campo_texto1 .'%')
            ->get();
            return view('resultado_busca_nao_logado', ['empresas' => $resultado]);

        }
        //cidade
        if($string_de_busca1 == null){
            $resultado = DB::table('empresas')
            ->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
            ->join('vagas','empresas.id','=','vagas.empresa_id')
            ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero','enderecos.complemento', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
            ->where('enderecos.cidade','ilike','%'. $request->campo_texto2 .'%')
            ->get();
            return view('resultado_busca_nao_logado', ['empresas' => $resultado]);
            //dd($empresas);

        }

    }

    public function detalheOportunidade(Request $request){
        $resultado = DB::table('empresas')->join('enderecos','empresas.id','=', 'enderecos.empresa_id')
        ->join('vagas','empresas.id','=','vagas.empresa_id')
        ->select('vagas.nome_vaga','empresas.nome_empresa','enderecos.uf', 'enderecos.cidade', 'enderecos.bairro','enderecos.rua', 'enderecos.numero','enderecos.complemento', 'vagas.data_publicacao','vagas.atribuicoes','vagas.experiencia','vagas.descricao','vagas.quantidade','vagas.salario','vagas.vaga_para_pcd','vagas.tipo_de_vaga', 'vagas.tipo_de_remuneracao' )
        ->where('enderecos.cidade','ilike','garanhuns')
        ->where('vagas.nome_vaga', 'ilike', 'design de sobrancelhas')
        ->get();
        return (['empresas' => $resultado]);
    }

}
