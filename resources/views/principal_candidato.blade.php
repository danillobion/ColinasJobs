@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-10 offset-md-2">
        <div class="row justify-content-md-center">
            {{-- Vagas --}}
            <div class="col col-sm-4 col-md-4" style="margin-bottom:1rem;">
                <div style="height: 90%; width:295px;  background-color:white; margin-top:7.0rem;">
                    <div class="card-header">Oportunidades</div>
                    <div class="card-body" style="height:900px; ">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('buscarOportunidade')}}" method="GET">
                            <input type="text" name="busca" style="width:170px;" placeholder="Nome da empresa/vaga">
                            <button type="submit" style="background-color:#4285f4;  border: none;
                            border-radius: 8px;
                            color: white;
                            padding: 4px 11px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 13px;
                            margin: 4px 2px;
                            cursor: pointer;"> Procurar</button>
                            <small id="entradaFunção" class="form-text text-muted">ex.: pintor, mecânico</small>
                        </form>
                        <div style="height: 45rem; margin-left:1px; overflow: auto; margin-top:20px; border: 1px solid #000; border-color:#e9e9e9; border-radius: 8px;">
                            <?php $i = 0; ?>
                            <ul style="height: 5rem;margin-top:20px; ">
                                <div style="margin-left:-33px;">
                                    <?php $idTemp=0; ?>
                                    @foreach ($empresas as $item)
                                        <table id="tabelaOportunidades">
                                            <?php $idTemp++; ?>
                                            <button onclick="mostrarVaga({{$idTemp}})" class="button buttonCampo1">
                                                <div class="btn-form" style="margin-left:-7px; margin-bottom:50px; width:200px; height:20px; text-align: left;">
                                                    <div class="btn-group">
                                                        <div><img src="icon/paper.png" alt="paper" width="13px" height="13px"></div>
                                                    @if (strlen($item->nome_vaga) > 3)
                                                        <?php  $str = substr($item->nome_vaga, 0, 25). ' ...'; ?>
                                                        <div style="margin-left:7px; margin-top:2px;">{{$str}}</div>
                                                    @endif
                                                    </div>
                                                    <br>
                                                    <div class="btn-group">
                                                        <div><img src="icon/company.png" alt="company" width="13px" height="13px"></div>
                                                        @if (strlen($item->empresa->nome_empresa) > 3)
                                                            <?php  $str = substr($item->empresa->nome_empresa, 0, 25). ' ...'; ?>
                                                            <div style="margin-left:7px; margin-top:2px;">{{$str}}</div>
                                                        @endif
                                                    </div>
                                                    <br>
                                                    <div class="btn-group">
                                                        <div><img src="icon/address.png" alt="address" width="10px" height="13px"></div>
                                                        <div style="margin-left:9px; margin-top:2px;">{{$item->empresa->endereco->cidade . "/". $item->empresa->endereco->uf}}</div>
                                                    </div>
                                                    <br>
                                                    {{-- <div class="btn-group">
                                                        <img src="icon/date.png" alt="date" width="12px" height="13px">
                                                        <div style="margin-left:9px; margin-top:-2px;">{{$item->data_publicacao}}</div>
                                                    </div> --}}
                                                </div>
                                            </button>
                                        </table>
                                        @endforeach
                                </div>
                            </ul>
                        </div>
                        @if(!is_null($empresas))
                        @endif
                    </div>
                    <input id="aux" type="hidden" value="1">
                </div>
            </div>
            {{-- Detalhes --}}
            <div class="col col-sm-8 col-md-8 " style="margin-bottom:1rem;">
                <div style="height: 90%; width:445px; background-color:white; margin-top:7.0rem;">
                    <div class="card-header">Detalhes</div>
                    <div class="card-body "  style="height:900px; width:400px;">
                        <div>
                            <?php $idTemp =0; ?>
                            @if(!is_null($empresas))
                                @foreach($empresas as $id)
                                    <?php $idTemp++; ?>
                                    <div style="display: none" id="{{$idTemp}}">
                                        <a style="font-size:25px;"> {{$id->nome_vaga}}</a> <br>
                                        <a style="font-size:19px;"> {{$id->empresa->nome_empresa}}</a> <br>
                                        <a> {{$id->empresa->endereco->cidade}}{{"/"}}{{$id->empresa->endereco->uf}}</a> <br>
                                        <a> <b>{{'Data de Publicação: '}}</b>{{$id->data_publicacao}}</a> <br>
                                        <div class="btn-group">
                                            <a> <b>{{'Número de Vagas: '}}</b>{{$id->quantidade}}</a>

                                            <a style="margin-left:5px;"> <b>{{'Vagas para PCD: '}}</b>{{$id->vaga_para_pcd}}</a>
                                        </div>
                                        <div class="btn-group">
                                            <a> <b>{{'Salário: '}}</b>{{'R$'}}{{$id->salario}}</a>
                                            <a style="margin-left:5px;"> <b>{{'Tipo de vaga: '}}</b>{{$id->tipo_de_vaga}}</a>
                                            <a style="margin-left:5px;"> <b>{{'Remuneração: '}}</b>{{$id->tipo_de_remuneracao}}</a>
                                        </div>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; width:490px; height:170px;">
                                            <p style="font-size:20px;">Atribuições  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2px;width:490px;height:140px;">
                                                <a style="margin-left:5px;">{{$id->atribuicoes}}</a>
                                            </div>
                                        </div><br>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; width:490px; height:170px;">
                                            <p style="font-size:20px;">Experiência  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2px;width:490px;height:140px;">
                                                <a style="margin-left:5px;">{{$id->experiencia}}</a>
                                            </div>
                                        </div><br>

                                        <hr style="margin-top:2px;">

                                        <div style="margin-left:5px; width:490px; height:170px;">
                                            <p style="font-size:20px;">Descrição  </p><br>
                                            <div style="margin-top:-45px; margin-left:-2px;width:490px;height:140px;">
                                                <a style="margin-left:5px;">{{$id->descricao}}</a>
                                            </div>
                                        </div><br>
                                        <div>
                                            <?php $varTemp = count($id->match) ?>
                                            <?php $i =0; ?>
                                            @if($varTemp>=1)
                                                @foreach ($id->match as $item)
                                                    @if($item->candidato_id == Auth::user()->candidato->id AND $item->vaga_id == $id->id)
                                                        <form action="{{route('removerInteresseNaVaga')}}" method="GET">
                                                            <input type="hidden" name="empresa_id" value="{{$id->empresa->user_id}}">
                                                            <input type="hidden" name="vaga_id" value="{{$id->id}}">
                                                            <button type="submit" style="background-color:red;  border: none;
                                                            border-radius: 8px;
                                                            color: white;
                                                            padding: 4px 11px;
                                                            text-align: center;
                                                            text-decoration: none;
                                                            display: inline-block;
                                                            font-size: 13px;
                                                            margin: 4px 2px;
                                                            cursor: pointer;">Desfazer Interesse</button>
                                                        </form>
                                                        <?php break ?>
                                                        <?php $i = $i +1; ?>
                                                    @elseif($i==$varTemp-1)
                                                        <form action="{{route('adicionarMatch')}}" method="GET">
                                                            <input type="hidden" name="empresa_id" value="{{$id->empresa->user_id}}">
                                                            <input type="hidden" name="vaga_id" value="{{$id->id}}">

                                                            <button type="submit" style="background-color:#4285f4;  border: none;
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
                                                    @endif
                                                @endforeach
                                            @else
                                                <form action="{{route('adicionarMatch')}}" method="GET">
                                                    <input type="hidden" name="empresa_id" value="{{$id->empresa->user_id}}">
                                                    <input type="hidden" name="vaga_id" value="{{$id->id}}">
                                                    <button type="submit" style="background-color:#4285f4;  border: none;
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
                                            @endif
                                            </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function mostrarVaga(x){
        var aux = document.getElementById("aux").value;
        document.getElementById(aux).style.display = "none";
        document.getElementById(x).style.display = "block";
        document.getElementById("aux").value = x;
    }
</script>

@endsection

