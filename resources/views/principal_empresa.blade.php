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
                                            $matches = $vagas2[$i]->match->sortBy('created_at')->values();
                                        ?>
                                        <div style="display: none" id="curriculo{{$idTemp}}">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm" >
                                                        <a style="font-size:25px;">{{$matches[$j]->candidato->nome_completo}}</a>
                                                    </div>  
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm" >
                                                        <svg style="fill: #808080; width: 15px; height: 15px;" viewBox="0 0 39 39">
                                                            <path id="Icon_awesome-map-marker-alt" data-name="Icon awesome-map-marker-alt" d="M12.113,35.274C1.9,20.463,0,18.943,0,13.5a13.5,13.5,0,0,1,27,0c0,5.443-1.9,6.963-12.113,21.774a1.688,1.688,0,0,1-2.775,0ZM13.5,19.125A5.625,5.625,0,1,0,7.875,13.5,5.625,5.625,0,0,0,13.5,19.125Z"/>
                                                        </svg>
                                                        <!-- verifico se o campo endereco foi preenchido -->
                                                        @if(isset($matches[$j]->candidato->endereco))
                                                            <a> {{$matches[$j]->candidato->endereco->cidade}}{{"/"}}{{$matches[$j]->candidato->endereco->uf}}</a> <br>
                                                        @else
                                                            <a> Não foi informado </a><br>
                                                        @endif
                                                    </div> 
                                                    <div class="col-sm" >
                                                        <svg style="fill: #808080; width: 15px; height: 15px; margin-top:-5px;" viewBox="0 0 39 39">
                                                            <path id="Icon_awesome-calendar-alt" data-name="Icon awesome-calendar-alt" d="M0,32.625A3.376,3.376,0,0,0,3.375,36h24.75A3.376,3.376,0,0,0,31.5,32.625V13.5H0ZM22.5,18.844A.846.846,0,0,1,23.344,18h2.813a.846.846,0,0,1,.844.844v2.813a.846.846,0,0,1-.844.844H23.344a.846.846,0,0,1-.844-.844Zm0,9A.846.846,0,0,1,23.344,27h2.813a.846.846,0,0,1,.844.844v2.813a.846.846,0,0,1-.844.844H23.344a.846.846,0,0,1-.844-.844Zm-9-9A.846.846,0,0,1,14.344,18h2.813a.846.846,0,0,1,.844.844v2.813a.846.846,0,0,1-.844.844H14.344a.846.846,0,0,1-.844-.844Zm0,9A.846.846,0,0,1,14.344,27h2.813a.846.846,0,0,1,.844.844v2.813a.846.846,0,0,1-.844.844H14.344a.846.846,0,0,1-.844-.844Zm-9-9A.846.846,0,0,1,5.344,18H8.156A.846.846,0,0,1,9,18.844v2.813a.846.846,0,0,1-.844.844H5.344a.846.846,0,0,1-.844-.844Zm0,9A.846.846,0,0,1,5.344,27H8.156A.846.846,0,0,1,9,27.844v2.813a.846.846,0,0,1-.844.844H5.344a.846.846,0,0,1-.844-.844ZM28.125,4.5H24.75V1.125A1.128,1.128,0,0,0,23.625,0h-2.25A1.128,1.128,0,0,0,20.25,1.125V4.5h-9V1.125A1.128,1.128,0,0,0,10.125,0H7.875A1.128,1.128,0,0,0,6.75,1.125V4.5H3.375A3.376,3.376,0,0,0,0,7.875V11.25H31.5V7.875A3.376,3.376,0,0,0,28.125,4.5Z"/>
                                                        </svg>
                                                        <a style="margin-left: 4px;">{{$matches[$j]->candidato->data_de_nascimento}}</a>
                                                    </div>  
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm" >
                                                        <svg style="fill: #808080; width: 15px; height: 15px; margin-top:-5px;" viewBox="0 0 39 39">
                                                            <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt" d="M34.973,25.439,27.1,22.064a1.687,1.687,0,0,0-1.969.485L21.641,26.81A26.062,26.062,0,0,1,9.183,14.351l4.261-3.488A1.683,1.683,0,0,0,13.929,8.9L10.554,1.02A1.7,1.7,0,0,0,8.62.043L1.308,1.73A1.688,1.688,0,0,0,0,3.375,32.621,32.621,0,0,0,32.625,36a1.687,1.687,0,0,0,1.645-1.308l1.687-7.313a1.708,1.708,0,0,0-.985-1.941Z" transform="translate(0 0)"/>
                                                        </svg>
                                                        <a style="margin-left:2px;">{{$matches[$j]->candidato->celular}}</a>
                                                    </div>
                                                    <div class="col-sm" >
                                                        <svg style="fill: #808080; width: 15px; height: 15px; margin-top:-5px;" viewBox="0 0 39 39">
                                                            <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt" d="M34.973,25.439,27.1,22.064a1.687,1.687,0,0,0-1.969.485L21.641,26.81A26.062,26.062,0,0,1,9.183,14.351l4.261-3.488A1.683,1.683,0,0,0,13.929,8.9L10.554,1.02A1.7,1.7,0,0,0,8.62.043L1.308,1.73A1.688,1.688,0,0,0,0,3.375,32.621,32.621,0,0,0,32.625,36a1.687,1.687,0,0,0,1.645-1.308l1.687-7.313a1.708,1.708,0,0,0-.985-1.941Z" transform="translate(0 0)"/>
                                                        </svg>
                                                        
                                                            @if($matches[$j]->candidato->telefone == 'null')
                                                                <a style="margin-left:2px;">{{$matches[$j]->candidato->telefone}}</a>
                                                            @else
                                                                <a style="margin-left:2px;">XXXXX-XXXX</a>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <svg style="fill: #808080; width: 15px; height: 15px; margin-top:-5px;" viewBox="0 0 39 39">
                                                            <path id="Icon_simple-email" data-name="Icon simple-email" d="M34.3,16.618a18.569,18.569,0,0,1-.6,4.028,11.655,11.655,0,0,1-1.566,3.537A8.264,8.264,0,0,1,29.479,26.7a7.493,7.493,0,0,1-3.877.956,5.62,5.62,0,0,1-2.8-.686A4.8,4.8,0,0,1,20.9,25.024a6,6,0,0,1-5.08,2.552,5.166,5.166,0,0,1-4.435-2.385,7.807,7.807,0,0,1-1.1-2.763,11.916,11.916,0,0,1-.144-3.6,16.744,16.744,0,0,1,1.1-4.415,12,12,0,0,1,2.03-3.382,8.586,8.586,0,0,1,2.79-2.155,7.785,7.785,0,0,1,3.393-.754,10.55,10.55,0,0,1,2.029.173,8.307,8.307,0,0,1,1.575.472,8.517,8.517,0,0,1,1.305.689c.4.257.8.522,1.2.792l-.986,11.34a3.769,3.769,0,0,0,.029,1.327,1.857,1.857,0,0,0,.405.819,1.458,1.458,0,0,0,.657.427,2.439,2.439,0,0,0,2.308-.455,4.92,4.92,0,0,0,1.238-1.575,10.144,10.144,0,0,0,.833-2.367,16.241,16.241,0,0,0,.365-2.948,18.837,18.837,0,0,0-.463-5.508,10.948,10.948,0,0,0-2.038-4.261A9.466,9.466,0,0,0,24.253,4.3a13.262,13.262,0,0,0-5.323-.974,11.754,11.754,0,0,0-5.265,1.147,12.08,12.08,0,0,0-4,3.181A15.269,15.269,0,0,0,7.045,12.44a21.567,21.567,0,0,0-1.1,5.962A19.827,19.827,0,0,0,6.5,24.487a10.988,10.988,0,0,0,2.223,4.361,9.277,9.277,0,0,0,3.766,2.619,14.448,14.448,0,0,0,5.2.868,17.8,17.8,0,0,0,3.411-.367c.563-.113,1.1-.248,1.6-.4a12.074,12.074,0,0,0,1.382-.5l.713,3.208a7.918,7.918,0,0,1-1.546.765,14.879,14.879,0,0,1-1.827.529,17.827,17.827,0,0,1-3.816.428,20.012,20.012,0,0,1-6.957-1.12,12.8,12.8,0,0,1-5.071-3.334A14,14,0,0,1,2.54,26.046,23.485,23.485,0,0,1,1.69,18.4a23.31,23.31,0,0,1,1.462-7.335A18.153,18.153,0,0,1,6.676,5.24,16.056,16.056,0,0,1,12.051,1.4,16.829,16.829,0,0,1,19.013,0a17.57,17.57,0,0,1,6.746,1.208,13.12,13.12,0,0,1,4.869,3.4,13.943,13.943,0,0,1,2.889,5.249A20.071,20.071,0,0,1,34.3,16.618Zm-19.323,2.2a7.654,7.654,0,0,0,.4,3.8A2.035,2.035,0,0,0,17.33,23.9a2.162,2.162,0,0,0,.67-.124,2.391,2.391,0,0,0,.772-.463,4.119,4.119,0,0,0,.783-.945,7.252,7.252,0,0,0,.72-1.6l.77-8.811a4.6,4.6,0,0,0-1.2-.158,4.139,4.139,0,0,0-1.991.457A3.942,3.942,0,0,0,16.445,13.6a7.875,7.875,0,0,0-.936,2.2,18.7,18.7,0,0,0-.531,3.015Z" transform="translate(-1.67)"/>
                                                        </svg>
                                                        <a style="margin-left:2px;"> {{$matches[$j]->candidato->email}}</a>
                                                    </div>
                                                    <div class="col-sm">
                                                        <svg style="fill: #808080; width: 15px; height: 15px; margin-top:-5px;" viewBox="0 0 39 39">
                                                        <path id="Icon_awesome-wheelchair" data-name="Icon awesome-wheelchair" d="M34.882,27.117l1,2.015a1.125,1.125,0,0,1-.508,1.508l-4.6,2.312a2.25,2.25,0,0,1-3.037-1.059L23.321,22.5H13.5a2.25,2.25,0,0,1-2.227-1.932C8.89,3.889,9.027,4.925,9,4.5a4.5,4.5,0,1,1,5.159,4.452l.328,2.3h9.138a1.125,1.125,0,0,1,1.125,1.125v2.25a1.125,1.125,0,0,1-1.125,1.125h-8.5L15.451,18h9.3a2.25,2.25,0,0,1,2.036,1.293L30.83,27.9l2.544-1.29a1.125,1.125,0,0,1,1.508.508ZM21.892,24.75H20.169A7.875,7.875,0,1,1,8.46,16.794L7.793,12.13A12.375,12.375,0,1,0,23.7,28.6Z" transform="translate(0 0)"/>
                                                        </svg>
                                                       <a style="margin-left:2px;">{{$matches[$j]->candidato->tipo_de_deficiencia}}</a> <br>
                                                    </div>
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
