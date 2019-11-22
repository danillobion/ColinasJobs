@extends('layouts.app')

@section('content')

<style>

</style>
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top:100px;">
        <div class="col-sm-3">

            <div class="card" style="width:100%;">
                <div class="card-header">Minhas Oportunidades Cadastradas</div>
                <div class="card-body" >
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div style="height: 37rem; margin-left:1px; overflow: auto; margin-top:1%; border: 1px solid #000; border-color:#e9e9e9; border-radius: 8px;">
                        <?php $i = 0; ?>
                        <ul style="height: 5rem;margin-top:1%; ">
                            <div style="margin-left:-40px;">
                                    <?php $idTemp=0; ?>
                            @foreach ($empresas as $item)
                                @for($i = 0; $i < sizeof($item->vaga); $i++)
                                    <?php $idTemp++; ?>
                                    <button id="buttonMinhasVagas{{$idTemp}}" onclick="mostrarVaga('div_A',{{$idTemp}}, {{$item->vaga[$i]->id}})" class="button buttonCampo1">
                                        <div style="margin-left:-5px; margin-bottom:30%; width:75%; height:5%; text-align: left;">
                                            <p style="margin-bottom: -5px;">{{$item->vaga[$i]->nome_vaga}}</p>
                                            <p style="margin-bottom: -5px;">{{$item->nome_empresa}}</p>
                                            <p style="margin-bottom: -5px;">{{$item->endereco->cidade . "/". $item->endereco->uf}}</p>
                                            {{-- <p style="margin-bottom: -5px;">{{$item->vaga[$i]->data_publicacao}}</p> --}}
                                            <p style="margin-bottom: -5px;">{{$item->vaga[$i]->match->count()}}</p>
                                            @foreach ($vagas as $item2)
                                                <p style="margin-bottom: -5px;">{{$item2->candidato_id}}</p>
                                            @endforeach

                                        </div>
                                    </button>
                                @endfor
                                @if(sizeof($item->vaga) == 0)
                                    <a href="{{ route('vaga') }}" class="button buttonCampo1 enabled-jobs">Você não possui nenhuma vaga cadastrada. Clique aqui para criar uma vaga.</a>
                                @endif
                            @endforeach
                            </div>
                            @if(!is_null($empresas))
                            @endif
                        </ul>
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
                        @if(!is_null($empresas))
                            @foreach($empresas as $id)
                                @for($i = 0; $i < sizeof($item->vaga); $i++)
                                    <?php $idTemp++; ?>
                                    <div class="card-body" style="display: none" id="vaga{{$idTemp}}">
                                        <a style="font-size:25px;"> {{$item->vaga[$i]->nome_vaga}}</a> <br>
                                        <a style="font-size:19px;"> {{$id->nome_empresa}}</a> <br>
                                        <a> {{$item->endereco->cidade . "/". $item->endereco->uf}}</a> <br>
                                        <a> <b>{{'Data de Publicação: '}}</b>{{$item->vaga[$i]->data_publicacao}}</a> <br>
                                        <div class="btn-group">
                                            <a> <b>{{'Número de Vagas: '}}</b>{{$item->vaga[$i]->quantidade}}</a>
                                            @if($item->vaga[$i]->vaga_para_pcd == 1)
                                                <a style="margin-left:5px;"> <b>{{'Vagas para PCD: '}}</b>Sim</a>
                                            @else
                                                <a style="margin-left:5px;"> <b>{{'Vagas para PCD: '}}</b>Não</a>
                                            @endif
                                        </div>
                                        <div class="btn-group">
                                            <a> <b>{{'Salário: '}}</b>{{'R$'}}{{$item->vaga[$i]->salario}}</a>
                                            <a style="margin-left:5px;"> <b>{{'Tipo de vaga: '}}</b>{{$item->vaga[$i]->tipo_de_vaga}}</a>
                                            <a style="margin-left:5px;"> <b>{{'Remuneração: '}}</b>{{$item->vaga[$i]->tipo_de_remuneracao}}</a>
                                        </div>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; ">
                                            <p style="font-size:20px;">Atribuições  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2px;">
                                                <a style="margin-left:5px;">{{$item->vaga[$i]->atribuicoes}}</a>
                                            </div>
                                        </div><br>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; ">
                                            <p style="font-size:20px;">Experiência  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2px;">
                                                <a style="margin-left:5px;">{{$item->vaga[$i]->experiencia}}</a>
                                            </div>
                                        </div><br>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; ">
                                            <p style="font-size:20px;">Descrição  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2pxwidth:490px;height:140px;">
                                                <a style="margin-left:5px;">{{$item->vaga[$i]->descricao}}</a>
                                            </div>
                                        </div><br>
                                    </div>
                                @endfor
                            @endforeach
                        @endif

                {{-- Curriculo --}}
                <div class="card-body" >
                    <?php $idTemp=0; ?>
                    @if(!is_null($empresas))
                        @foreach ($empresas as $item)
                            @for($i = 0; $i < sizeof($item->vaga); $i++)
                                @for($j = 0; $j < sizeof($item->vaga[$i]->match); $j++)
                                    <?php $idTemp++; ?>
                                    <div style="display: none" id="curriculo{{$idTemp}}">
                                        <a style="font-size:25px;">{{$item->vaga[$i]->match[$j]->candidato->nome_completo}}</a> <br>
                                        <a> {{'cidade'}}{{"/"}}{{'uf'}}</a> <br>
                                        <hr style="margin-top:2px;">
                                        <div class="btn-group">
                                            <p>Data de Nascimento:  </p>
                                            <a style="margin-left:5px;"> {{$item->vaga[$i]->match[$j]->candidato->data_de_nascimento}}</a>
                                        </div><br>
                                        <div class="btn-group" style="margin-top:-19px;">
                                            <p>Email:  </p>
                                            <a style="margin-left:5px;"> {{$item->vaga[$i]->match[$j]->candidato->email}}</a>
                                        </div><br>
                                        <div class="btn-group" style="margin-top:-19px;">
                                        <div>
                                            <p >Telefone: {{$item->vaga[$i]->match[$j]->candidato->telefone}}</p>
                                        </div>
                                        <div>
                                            <p style="margin-left:10px;">Celular: {{$item->vaga[$i]->match[$j]->candidato->celular}}</p>
                                        </div>
                                        </div><br>
                                        <div  style="margin-top:-19px;">
                                            <a> {{"Deficiência: "}}{{$item->vaga[$i]->match[$j]->candidato->tipo_de_deficiencia}}</a> <br>
                                        </div>
                                        <hr style="margin-top:2px;">
                                            <div>
                                                @foreach ($item->vaga[$i]->match[$j]->candidato->escolaridade as $itemEscolaridade)
                                                    <p style="margin-top:-10px; font-size:19px;">Escolaridade</p>
                                                    <div style="margin-top:-10px;">
                                                        <a> {{"Instituição: "}}{{$itemEscolaridade->instituicao}}</a> <br>
                                                        <a> {{"Curso: "}}{{$itemEscolaridade->curso}}</a> <br>
                                                        <div>
                                                            <a> {{"Data Entrada: "}}</a>{{$itemEscolaridade->data_inicio}}</a>
                                                            <a style="margin-left:10px;"> {{"Data Saída: "}}</a> {{$itemEscolaridade->data_conclusao}}</a>
                                                        </div>
                                                    </div><br>
                                                    <hr style="margin-top:2px;">
                                                @endforeach
                                            </div>
                                            <div>
                                                @foreach ($item->vaga[$i]->match[$j]->candidato->experiencia as $itemExperiencia)
                                                    <p style="margin-top:-10px; font-size:19px;">Experiência</p>
                                                    <div style="margin-top:-10px;">
                                                        <a> {{"Empresa: "}}{{$itemExperiencia->nome_empresa}}</a> <br>
                                                        <a> {{"Atribuição: "}}{{$itemExperiencia->atribuicao}}</a> <br>
                                                        @foreach ($itemExperiencia->cargo as $itemCargo)
                                                            <a> {{"Cargo: "}}{{$itemCargo->nome_cargo}}</a> <br>
                                                        @endforeach
                                                        <div>
                                                            <a> {{"Data Saída: "}}</a>{{$itemExperiencia->data_fim}}</a>
                                                        </div>
                                                    </div><br>
                                                @endforeach
                                            </div>
                                        <hr/>
                                        <div>
                                            @if($item->vaga[$i]->match[$j]->match === NULL )
                                                <div class="btn-group">
                                                    <div>
                                                        <form action="{{route('interesseNoCandidato')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                            <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                            <input type="hidden" name="match" value="TRUE">
                                                            <button type="submit" style="background-color:blue;  border: none;
                                                            border-radius: 8px;
                                                            color: white;
                                                            padding: 4px 11px;
                                                            text-align: center;
                                                            text-decoration: none;
                                                            display: inline-block;
                                                            font-size: 13px;
                                                            margin: 4px 2px;
                                                            cursor: pointer;">Tenho Interesse</button>
                                                        </form>
                                                    </div>
                                                    <div class="margin-left:50px;">
                                                        <form action="{{route('interesseNoCandidato')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                            <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                            <input type="hidden" name="match" value="FALSE">
                                                            <button type="submit" style="background-color:red;  border: none;
                                                            border-radius: 8px;
                                                            color: white;
                                                            padding: 4px 11px;
                                                            text-align: center;
                                                            text-decoration: none;
                                                            display: inline-block;
                                                            font-size: 13px;
                                                            margin: 4px 2px;
                                                            cursor: pointer;">Não Tenho Interesse</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif($item->vaga[$i]->match[$j]->match === FALSE)
                                                <form action="{{route('interesseNoCandidato')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                    <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                    <input type="hidden" name="match" value="TRUE">
                                                    <button type="submit" style="background-color:blue;  border: none;
                                                    border-radius: 8px;
                                                    color: white;
                                                    padding: 4px 11px;
                                                    text-align: center;
                                                    text-decoration: none;
                                                    display: inline-block;
                                                    font-size: 13px;
                                                    margin: 4px 2px;
                                                    cursor: pointer;">Tenho Interesse</button>
                                                </form>
                                            @else
                                                <form action="{{route('interesseNoCandidato')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="candidato_id" value="{{$item->vaga[$i]->match[$j]->candidato_id}}">
                                                    <input type="hidden" name="vaga_id" value="{{$item->vaga[$i]->match[$j]->vaga_id}}">
                                                    <input type="hidden" name="match" value="FALSE">
                                                    <button type="submit" style="background-color:red;  border: none;
                                                    border-radius: 8px;
                                                    color: white;
                                                    padding: 4px 11px;
                                                    text-align: center;
                                                    text-decoration: none;
                                                    display: inline-block;
                                                    font-size: 13px;
                                                    margin: 4px 2px;
                                                    cursor: pointer;">Não Tenho Interesse</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            @endfor
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card" style="height:100%">
                <div class="card-header">Candidatos Interessados</div>
                <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <?php $idTemp=0; ?>
                        <?php $i = 0; ?>
                        @foreach ($empresas as $item)
                            @for($i = 0; $i < sizeof($item->vaga); $i++)
                            <div id="curriculoVaga{{$item->vaga[$i]->id}}"  style="display: none; height: 37rem; margin-left:1px; overflow: auto; margin-top:1%; border: 1px solid #000; border-color:#e9e9e9; border-radius: 8px;">
                            @for($j = 0; $j < sizeof($item->vaga[$i]->match); $j++)
                                <ul style="height: 5rem;margin-top:1%; ">
                                <div style="margin-left:-40px;">
                                        <?php $idTemp++; ?>
                                        <button id="buttonMeusCandidatos{{$idTemp}}" onclick="mostrarCurriculo({{$idTemp}})" class="button buttonCampo1" style="">
                                            <div style="margin-left:-5px; margin-bottom:30%; width:75%; height:5%; text-align: left;">
                                                <p style="margin-bottom: -5px;">{{$item->vaga[$i]->match[$j]->candidato->nome_completo}}</p>
                                                <p style="margin-bottom: -5px;">{{$item->vaga[$i]->match[$j]->candidato->funcao}}</p>
                                                <p style="margin-bottom: -5px;">{{$item->vaga[$i]->match[$j]->candidato->tipo_de_deficiencia}}</p>
                                            </div>
                                        </button>
                                </div>
                                </ul>
                            @endfor
                            </div>
                            @endfor
                        @endforeach
                                @if(!is_null($empresas))

                                @endif
                        <input id="div_B" type="hidden" value="1">
                </div>
            </div>
        </div>
    </div>
</div>
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

    function mostrarCurriculo(x){

        document.getElementById(str5.concat(x)).className = "button buttonCampo1 enabled-jobs";

        if(ultimaVaga.value != ""){
            document.getElementById(str2.concat(ultimaVaga.value)).style.display = "none";
        }
        document.getElementById(str3.concat(x)).style.display = "block";
        if(ultimoCurriculo.value != ""){
            document.getElementById(str3.concat(ultimoCurriculo.value)).style.display = "none";
        }
        if(ultimoCurriculo.value != ""){
            document.getElementById(str5.concat(ultimoCurriculo.value)).className = "button buttonCampo1";
        }
        ultimoCurriculo.value = x;


    }
</script>

@endsection
