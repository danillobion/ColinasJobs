@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div style="height: 100%; width:100%; background-color:white; margin-top:7.0rem;">
            <div class="card-header">Tenho Interesse</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Vaga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <?php $idTemp=0; ?>
                    <tbody>
                    @foreach ($match as $item)
                        <?php

                            $idTemp++;
                            $divID='idDiv' . $idTemp;
                            $tdID='tdID' . $idTemp;

                        ?>
                            <tr data-toggle="collapse" data-target="#collapseExample{{$idTemp}}" aria-expanded="false" aria-controls="collapseExample{{$idTemp}}">
                                <th scope="row">{{$idTemp}}</th>
                                <td>{{$item->vaga->empresa->nome_empresa}}</td>
                                <td>{{$item->vaga->nome_vaga}}</td>
                                <td>
                                   ????
                                </td>
                                <td>
                                    <div>
                                        @foreach ($match as $verifica)
                                            @if($verifica->id == $item->id AND $verifica->candidato_id == Auth::user()->candidato->id)
                                                <form action="{{route('removerInteresseNaVagaViewLista')}}" method="GET">
                                                    <input type="hidden" name="empresa_id" value="{{Auth::user()->candidato->id}}">
                                                    <input type="hidden" name="vaga_id" value="{{$item->vaga_id}}">
                                                    <button type="submit" class="btn btn-danger btn-sm">Não Tenho Interesse</button>
                                                </form>
                                                <?php break ?>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="collapse" id="collapseExample{{$idTemp}}">
                                    <div class="row" >
                                        <div class="col-md-3">
                                            <a> {{$item->vaga->empresa->nome_empresa}}</a> <br>
                                            <a> {{$item->vaga->nome_vaga}}</a> <br>
                                            <a> {{$item->vaga->empresa -> email}}</a> <br>
                                            <a> {{$item->vaga->empresa->telefone}}</a> <br>

                                        </div>
                                        <div class="col-md-9">
                                            <p ><b>Atribuições </b></p>
                                            <textarea style="resize: none; width:100%; border: none; color:black; background-color:white;" rows="3" disabled>{{$item->vaga->atribuicoes}}</textarea>
                                            <hr>
                                            <p ><b>Experiência </b></p>
                                            <textarea style="resize: none; width:100%; border: none; color:black; background-color:white;" rows="3" disabled>{{$item->vaga->experiencia}}</textarea>
                                            <hr>
                                            <p ><b>Descrição </b></p>
                                            <textarea style="resize: none; width:100%; border: none; color:black; background-color:white;" rows="3" disabled>{{$item->vaga->descricao}}</textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div>
    </div>
</div>

<script type="text/javascript">
    function mostrarVaga(x){
        var aux = document.getElementById("aux").value;
        document.getElementById(aux).style.display = "none";
        document.getElementById(x).style.display = "block";
        document.getElementById("aux").value = x;
    }

    var aux = 'null'; //Variavel global
    var aux2 = 'null'; //Variavel global

    function abrirDiv(teste){
        console.log(teste);
    //     if(document.getElementById(divID).style.display == 'none'){
    //         document.getElementById(divID).style.display = 'block';
    //         document.getElementById(tdID).style.display = 'block';
    //         if(aux == 'null'){
    //             // console.log(aux);
    //         }else if(aux == divID){
    //             document.getElementById(divID).style.display = 'block';
    //             // document.getElementById(tdID).style.display = 'block';
    //         }else{
    //             document.getElementById(aux).style.display = 'none';
    //             // document.getElementById(aux2).style.display = 'none';
    //         }
    //         aux = divID; //atualizar o valor aux
    //         // aux2 = tdID;
    //    }else{
    //         document.getElementById(divID).style.display = 'none';
    //         // document.getElementById(tdID).style.display = 'none';
    //    }
    }
</script>

@endsection

