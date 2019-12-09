@extends('layouts.app')

@section('content')

<style>
</style>
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top:100px;">
        <div class="col-sm-3">
            <div class="card" style="width:100%;">
                <div class="card-title text-center">Minhas Oportunidades Cadastradas</div>
                <div class="card-body" >
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div style="height: 37rem; margin-left:1px; overflow: auto; border: 1px solid #000; border-color:#e9e9e9; border-radius: 8px;">
                        <?php $i = 0; ?>
                        <ul>
                            <div style="margin-left:-40px;">

                                <?php $idTemp=0; ?>
                                <!-- ordenar as vagas -->
                                <?php
                                    $vagas = $empresas[0]->vaga->sortByDesc('data_publicacao')->values();
                                    $vagasCand = $vagas;
                                    $countVagas = $vagas->count();

                                    $idOpcaoDiv = 'opcao' . $idTemp;
                                    // dd($vagas[1]->match);
                                ?>

                                @foreach ($vagas as $item)
                                    <?php $idTemp++; ?>
                                    <button id="buttonMinhasVagas{{$idTemp}}" class="button buttonCampo1" onclick="mostrarVaga('div_A',{{$idTemp}}, {{$item->id}})">
                                        <div style="margin-left:-5px; margin-bottom:30%; width:75%; height:5%; text-align: left;">
                                            <a style="position:absolute; margin-left:180px;" onclick="mostrarOpcoes('{{$idOpcaoDiv}}')"><img src="icon/ellipsis-v-solid.svg" alt="curriculum" width="45px" height="20px"></a>
                                            <p style="margin-bottom: -5px;">{{$item->nome_vaga}}</p>
                                            <p style="margin-bottom: -5px;">{{$item->empresa->nome_empresa}}</p>
                                            <p style="margin-bottom: -5px;">{{$item->endereco->cidade . "/". $item->endereco->uf}}</p>
                                            {{--<p style="margin-bottom: -5px;">{{$item->data_publicacao}}</p>--}}
                                            <p style="margin-bottom: -5px;">{{$item->match->count()}}</p>
                                        </div>
                                    </button>
                                    <div id="{{$idOpcaoDiv}}" style="padding:5px; display:none;" role="group">
                                            <a  href="{{ route('editarVaga', ['idEmpresa' => $item->empresa_id, 'idVaga' => $item->id ])}}" class="btn btn-primary btn-sm">Editar</a>
                                            <a  href="{{ route('deletarVaga', ['idEmpresa' => $item->empresa_id, 'idVaga' => $item->id ])}}" class="btn btn-danger btn-sm">Deletar</a>
                                        </div>
                                @endforeach
                            </div>
                        </ul>
                            @if($countVagas == 0)
                                <div style="padding-left: 10px;padding-right: 10px;">
                                    <p>Você não possui vaga cadastrada. <a type="button" href="{{ route('vaga') }}" class="btn btn-primary btn-sm">Clique aqui</a></a> para criar uma vaga.<p>
                                    </p>
                                </div>
                            @endif
                    </div>
                    <input id="div_A" type="hidden" value="1">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card" style="height:100%">
                <div class="card-header">Detalhes</div>
                {{-- Detalhes da vaga --}}

                    <?php $idTemp =0; ?>
                    @if(!is_null($vagas))
                        @foreach($vagas as $itemVaga)
                            <?php $idTemp++; ?>
                            <div class="card-body" style="display: none" id="vaga{{$idTemp}}">
                                <a style="font-size:25px;"> {{$itemVaga->nome_vaga}}</a> <br>
                                <a style="font-size:19px;"> {{$itemVaga->empresa->nome_empresa}}</a> <br>
                                <a> {{$itemVaga->endereco->cidade . "/". $itemVaga->endereco->uf}}</a> <br>
                                <a> <b>{{'Data de Publicação: '}}</b>{{$itemVaga->data_publicacao}}</a> <br>
                                <div class="btn-group">
                                    <a> <b>{{'Número de Vagas: '}}</b>{{$itemVaga->quantidade}}</a>
                                    @if($itemVaga->vaga_para_pcd == 1)
                                        <a style="margin-left:5px;"> <b>{{'Vagas para PCD: '}}</b>Sim</a>
                                    @else
                                        <a style="margin-left:5px;"> <b>{{'Vagas para PCD: '}}</b>Não</a>
                                    @endif
                                </div>
                                <div class="btn-group">
                                    <a> <b>{{'Salário: '}}</b>{{'R$'}}{{$itemVaga->salario}}</a>
                                    <a style="margin-left:5px;"> <b>{{'Tipo de vaga: '}}</b>{{$itemVaga->tipo_de_vaga}}</a>
                                    <a style="margin-left:5px;"> <b>{{'Remuneração: '}}</b>{{$itemVaga->tipo_de_remuneracao}}</a>
                                </div>

                                <hr style="margin-top:2px;">

                                <div style="margin-left:5px; ">
                                    <p style="font-size:20px;">Atribuições  </p><br>
                                    <div style="margin-top:-45px; margin-left:-2px;">
                                        <a style="margin-left:5px;">{{$itemVaga->atribuicoes}}</a>
                                    </div>
                                </div><br>

                                <hr style="margin-top:2px;">

                                <div style="margin-left:5px; ">
                                    <p style="font-size:20px;">Experiência  </p><br>
                                    <div style="margin-top:-45px; margin-left:-2px;">
                                        <a style="margin-left:5px;">{{$itemVaga->experiencia}}</a>
                                    </div>
                                </div><br>

                                <hr style="margin-top:2px;">

                                <div style="margin-left:5px; ">
                                    <p style="font-size:20px;">Descrição  </p><br>
                                    <div style="margin-top:-45px; margin-left:-2pxwidth:490px;height:140px;">
                                        <a style="margin-left:5px;">{{$itemVaga->descricao}}</a>
                                    </div>
                                </div><br>
                            </div>
                        @endforeach
                    @endif
            </div>
        </div>
        <!-- candidato interessado -->
       <div class="col-sm-3">
            <div class="card" style="height:100%">
                <div class="card-header">Candidatos Interessados</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php $idTemp=0;?>
                    @foreach ($vagas as $item)
                        <div id="curriculoVaga{{$item->id}}"  style="display: none; height: 37rem; margin-left:1px; overflow: auto; margin-top:1%; border: 1px solid #000; border-color:#e9e9e9; border-radius: 8px;">
                            <?php
                                // Ordenar candidatos
                                $countMatches = $item->match->count();
                                
                                if($countMatches > 0){
                                   $matches = $item->match->sortBy('created_at')->values();
                                }
                            ?>
                            @for($j = 0; $j < $countMatches; $j++)    
                                @if($matches[$j]->match == NULL && $matches[$j]->empresa_id == NULL)
                                    <ul style="height: 5rem;margin-top:1%; ">
                                        <div style="margin-left:-40px;">
                                            <?php $idTemp++; ?>
                                            <button id="buttonMeusCandidatos{{$idTemp}}" onclick="mostrarCurriculo({{$idTemp}})" class="button buttonCampo1" data-toggle="modal" data-target="#modalExemplo">
                                                <div style="margin-left:-5px; margin-bottom:30%; width:75%; height:5%; text-align: left;">
                                                    <p style="margin-bottom: -5px;">{{$matches[$j]->candidato->nome_completo}}</p>
                                                    <p style="margin-bottom: -5px;">{{$matches[$j]->candidato->funcao}}</p>
                                                    <p style="margin-bottom: -5px;">{{$matches[$j]->candidato->tipo_de_deficiencia}}</p>
                                                </div>
                                            </button>
                                        </div>
                                    </ul>
                                @endif
                            @endfor
                            @if($countMatches == 0)
                                <div style="padding: 10px;">
                                    <a>Até o momento nenhum candidato demonstrou interesse na oportunidade.</a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <input id="div_B" type="hidden" value="1">
                </div>
            </div>


        </div>
        <!--x candidato interessado x-->
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Candidato Interessado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Curriculo --}}
                        <?php $idTemp=0; ?>
                        @if(!is_null($empresas))
                            @foreach ($empresas as $item)
                            <?php
                                    $vagas2 = $empresas[0]->vaga->sortBy('data_publicacao')->values();
                                    $countVagas = $vagas->count();

                                    $idOpcaoDiv = 'opcao' . $idTemp;

                                ?>
                                @for($i = 0; $i < sizeof($item->vaga); $i++)
                                    @for($j = 0; $j < sizeof($item->vaga[$i]->match); $j++)
                                        <?php
                                            $idTemp++;
                                            $nomeCompletoTemp = $item->vaga[$i]->match[$j]->candidato->nome_completo;

                                            $matches = $vagas2[$i]->match->sortBy('created_at')->values();
                                        ?>
                                        <div style="display: none" id="curriculo{{$idTemp}}">
                                            <a style="font-size:25px;">{{$matches[$j]->candidato->nome_completo}}</a> <br>
                                            
                                                <!-- verifico se o campo endereco foi preenchido -->
                                                @if(isset($matches[$j]->candidato->endereco))

                                                    <a> Local: {{$matches[$j]->candidato->endereco->cidade}}{{"/"}}{{$matches[$j]->candidato->endereco->uf}}</a> <br>
                                                @else

                                                    <p>Local: Não foi informado

                                                @endif

                                                <hr style="margin-top:2px;">
                                                <div class="btn-group">
                                                    <p>Data de Nascimento:  </p>
                                                    <a style="margin-left:5px;"> {{$matches[$j]->candidato->data_de_nascimento}}</a>
                                                </div><br>
                                                <div class="btn-group" style="margin-top:-19px;">
                                                    <p>Email:  </p>
                                                    <a style="margin-left:5px;"> {{$matches[$j]->candidato->email}}</a>
                                                </div><br>
                                                <div class="btn-group" style="margin-top:-19px;">
                                                    <div>
                                                        <p >Telefone: {{$matches[$j]->candidato->telefone}}</p>
                                                    </div>
                                                    <div>
                                                        <p style="margin-left:10px;">Celular: {{$matches[$j]->candidato->celular}}</p>
                                                    </div>
                                                </div><br>
                                                <div  style="margin-top:-19px;">
                                                    <a> {{"Deficiência: "}}{{$matches[$j]->candidato->tipo_de_deficiencia}}</a> <br>
                                                </div>
                                                <div>
                                                    <p style="margin-top:10px; margin-bottom:-4px; font-size:19px;">Escolaridade</p>
                                                        <table class="table table-sm table-hover " style="font-size:12px;">
                                                            <thead>
                                                              <tr>
                                                                <th scope="col">Nível de Formação</th>
                                                                <th scope="col">Instituição</th>
                                                                <th scope="col">Curso</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Ano de Conclusão</th>
                                                              </tr>
                                                            </thead>
                                                            @foreach ($item->vaga[$i]->match[$j]->candidato->escolaridade as $itemEscolaridade)
                                                                <tbody>
                                                                    <tr>
                                                                    <td>{{$itemEscolaridade->nivel_de_formacao}}</td>
                                                                    <td>{{$itemEscolaridade->instituicao}}</td>
                                                                    <td>{{$itemEscolaridade->curso}}</td>
                                                                    <td>{{$itemEscolaridade->status}}</td>
                                                                    <?php
                                                                        $dataTemp = $itemEscolaridade->data_conclusao;
                                                                        $dataSplit = explode("-", $dataTemp);
                                                                    ?>
                                                                    <td>{{$dataSplit[0]}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                </div>
                                                <div>
                                                        <p style="margin-top:10px; margin-bottom:-4px; font-size:19px;">Experiencia</p>
                                                        <table class="table table-sm table-hover" style="font-size:12px;">
                                                                <thead>
                                                                  <tr>
                                                                    <th scope="col">Empresa</th>
                                                                    <th scope="col">Atribuição</th>
                                                                    <th scope="col">Cargo</th>
                                                                    <th scope="col">Saída</th>
                                                                  </tr>
                                                                </thead>
                                                    @foreach ($item->vaga[$i]->match[$j]->candidato->experiencia as $itemExperiencia)
                                                        <tbody>
                                                                <tr>
                                                                <td>{{$itemExperiencia->nome_empresa}}</td>
                                                                <td>{{$itemExperiencia->atribuicao}}</td>
                                                                @foreach ($itemExperiencia->cargo as $itemCargo)
                                                                    <td>{{$itemCargo->nome_cargo}}</td>
                                                                @endforeach
                                                                <?php
                                                                    $dataSaida = $itemExperiencia->data_fim;
                                                                    $dataSaidaSplit =  explode("-", $dataSaida);
                                                                ?>
                                                                <td>{{$dataSaidaSplit[0]}}</td>

                                                                </tr>
                                                            </tbody>
                                                    @endforeach
                                                </table>
                                                <hr>
                                                </div>
                                                <div>
                                                {{-- Id's --}}
                                                <?php
                                                    $id = $item->vaga[$i]->match[$j]->candidato_id;
                                                    $idVaga = $item->vaga[$i]->id;

                                                    $idDivNull = 'idDivNull';
                                                    $idDivNull = $idDivNull . $id . $idVaga;

                                                    $idDivEmail = 'idDivEmail';
                                                    $idDivEmail = $idDivEmail . $id . $idVaga;

                                                    $textAreaBloqueado = 'textAreaBloqueado';
                                                    $textAreaBloqueado = $textAreaBloqueado . $id . $idVaga;

                                                    $textAreaDesbloqueado = 'textAreaDesbloqueado';
                                                    $textAreaDesbloqueado = $textAreaDesbloqueado . $id . $idVaga;

                                                    $campoTextDesbloqueado = 'campoTextDesbloqueado';
                                                    $campoTextDesbloqueado = $campoTextDesbloqueado . $id . $idVaga;
                                                ?>

                                                    <div  id="{{$idDivNull}}" style="display:block">
                                                        <button class="btn btn-primary" onclick="mostrarBotoes('{{$idDivNull}}','{{$idDivEmail}}','TRUE')">Tenho Interesse</button>
                                                        <div style="float:right">
                                                            <form action="{{route('interesseNoCandidato')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="nome" value="{{$item->vaga[$i]->match[$j]->candidato->nome_completo}}">
                                                                <input type="hidden" name="vaga" value="{{$item->vaga[$i]->nome_vaga}}">
                                                                <input type="hidden" name="empresa" value="{{$item->nome_empresa}}">
                                                                <input type="hidden" name="emailCandidato"  value="{{$item->vaga[$i]->match[$j]->candidato->user->email}}">

                                                                <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                                <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                                <input type="hidden" name="match" value="FALSE">
                                                                <button type="submit" class="btn btn-danger" >Não Tenho Interesse</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                
                                                <!-- DIV EMAIL -->
                                                <div id="{{$idDivEmail}}" style="display:none;">
                                                    <div class="btg-group">
                                                        Para:<br>
                                                        <input value="{{$item->vaga[$i]->match[$j]->candidato->nome_completo}}" style="width:100%" disabled>
                                                    </div>
                                                    <div id="{{$textAreaBloqueado}}" style="display:'block;">
                                                        <form id="idFormTA" action="{{route('interesseNoCandidato')}}" method="POST"> 
                                                            @csrf
                                                            Mensagem:<br>
                                                            <!-- <small style="color:blue;">Digite aqui se você quiser personalizar a mensagem..</small> --> 
                                                            <textarea form="idFormTA" id="{{$campoTextDesbloqueado}}" style="width:100%" name="campoMensagem" disabled>Value padrao que vai ser enviado</textarea>
                                                            <br>
                                                            <br>
                                                            <input type="hidden" name="nome" value="{{$item->vaga[$i]->match[$j]->candidato->nome_completo}}">
                                                            <input type="hidden" name="vaga" value="{{$item->vaga[$i]->nome_vaga}}">
                                                            <input type="hidden" name="empresa" value="{{$item->nome_empresa}}">
                                                            <input type="hidden" name="emailCandidato"  value="{{$item->vaga[$i]->match[$j]->candidato->user->email}}">

                                                            <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                            <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                            <input type="hidden" name="match" value="TRUE">
                                                            <button type="button" class="btn btn-primary btn-sm" style="float:right;" onclick="mostrarCampo('{{$campoTextDesbloqueado}}');">Editar</button> 
                                                            <button type="submit" class="btn btn-success" >Enviar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="mostrarBotoes('{{$idDivNull}}','{{$idDivEmail}}','FECHAR')">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endfor
                            @endforeach
                        @endif
            </div>
        </div>
    </div>
</div>
{{-- X MODAL X --}}

<input id="ultimaVaga" type="hidden" value="">
<input id="ultimoCurriculo" type="hidden" value="">
<input id="ultimoIdVaga" type="hidden" value="">


 <script type="text/javascript">
    var str1 = "buttonMinhasVagas";
    var str2 = "vaga";
    var str3 = "curriculo";
    var str4 = "curriculoVaga";
    var str5 = "buttonMeusCandidatos";

    function mostrarVaga(tipoDiv,x, id_vaga){
        var aux = document.getElementById(tipoDiv).value;
        var ultimoCurriculo = document.getElementById('ultimoCurriculo');
        var ultimaVaga = document.getElementById('ultimaVaga');
        var ultimoIdVaga = document.getElementById('ultimoIdVaga');

        document.getElementById(str2.concat(aux)).style.display = "none";
        document.getElementById(str2.concat(x)).style.display = "block";

        document.getElementById(tipoDiv).value = x;

        document.getElementById(str1.concat(x)).className = "button buttonCampo1 enabled-jobs";

        if(ultimoCurriculo.value != ""){
            document.getElementById(str3.concat(ultimoCurriculo.value)).style.display = "none";
        }

        //altera a lista de candidatos de acordo com a vaga selecionada
        if(ultimoIdVaga.value != ""){
            document.getElementById(str4.concat(ultimoIdVaga.value)).style.display = "none";
        }

        if(ultimaVaga.value != ""){
            document.getElementById(str1.concat(ultimaVaga.value)).className = "button buttonCampo1";
        }


        document.getElementById(str4.concat(id_vaga)).style.display = "block";

        ultimaVaga.value = x;
        ultimoIdVaga.value = id_vaga;
    }

    /*
    *   FUNCAO: Abrir o Modal
    *
    */
    function mostrarCurriculo(x){
        console.log(x);
        document.getElementById(str5.concat(x)).className = "button buttonCampo1 enabled-jobs";
        if(ultimaVaga.value != ""){
            // document.getElementById(str2.concat(ultimaVaga.value)).style.display = "none";
        }
        document.getElementById(str3.concat(x)).style.display = "block";
        if(ultimoCurriculo.value != ""){
            document.getElementById(str3.concat(ultimoCurriculo.value)).style.display = "none";
            document.getElementById(str3.concat(x)).style.display = "block";
        }
        if(ultimoCurriculo.value != ""){
            document.getElementById(str5.concat(ultimoCurriculo.value)).className = "button buttonCampo1";
        }
        ultimoCurriculo.value = x;
    }

    /*
    *   FUNCAO: Mostrar botoes com as opções de SIM/NAO para enviar uma mensagem personalizada.
    *
    */
    function mostrarBotoes(divNULL, divEMAIL, tipo){

        if(document.getElementById(divNULL).style.display == 'block'){
            document.getElementById(divNULL).style.display = 'none';
            document.getElementById(divEMAIL).style.display = 'block';
            $(this).removeData('bs.modal');
        }else if(document.getElementById(divEMAIL).style.display == 'block'){
            document.getElementById(divNULL).style.display = 'block';
            document.getElementById(divEMAIL).style.display = 'none';
        }else if(tipo === 'FECHAR'){
            document.getElementById(divEMAIL).style.display = 'none';
            document.getElementById(divNULL).style.display = 'block';
        }

    }
     /*
    *   FUNCAO: Habilitar campo para editar mensagem
    *
    */
    function mostrarCampo(campoTextArea){
        if((document.getElementById(campoTextArea).disabled) === true){
            document.getElementById(campoTextArea).disabled = false;
        }else{
            document.getElementById(campoTextArea).disabled = true;
        }
    }

    /*
    *   FUNCAO: mostrar opcoes (editar/deletar) vaga
    *
    *
    */

    var aux = 'null'; //Variavel global

    function mostrarOpcoes(idDiv){

       if(document.getElementById(idDiv).style.display == 'none'){
            document.getElementById(idDiv).style.display = 'block';
            if(aux == 'null'){
                // console.log(aux);
            }else if(aux == idDiv){
                document.getElementById(idDiv).style.display = 'block';
            }else{
                document.getElementById(aux).style.display = 'none';
            }
            aux = idDiv; //atualizar o valor aux
       }else{
            document.getElementById(idDiv).style.display = 'none';
       }

    }

</script>

@endsection
