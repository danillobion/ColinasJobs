@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div style="height: 100%; width:100%; background-color:white; margin-top:7.0rem;">
            <div class="card-header">Meus Matches</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- <p>{{$matches}}</p> -->

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Vaga</th>
                            <th scope="col">Candidato</th>
                            <th scope="col">Data</th>
                            <th scope="col">Hora</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <?php $idTemp=0; ?>
                    <tbody>
                    @foreach ($matches as $item)
                        @foreach($item->vaga as $itemVaga)
                            @foreach($itemVaga->match as $itemMatch)
                            <?php

                                $idTemp++;
                                
                                $divID='idDiv' . $idTemp;
                                $tdID='tdID' . $idTemp;
                            ?>
                                <tr >
                                    <th scope="row">{{$idTemp}}</th>
                                    <td>{{$itemVaga->nome_vaga}}</td>
                                    <td>{{$itemMatch->candidato->nome_completo}}</td>
                                    <?php
                                        $dataHora = explode(' ',$itemMatch->created_at);

                                        $data = explode('-', $dataHora[0]);
                                        $dataAno = $data[0];
                                        $dataMes = $data[1];
                                        $dataDia = $data[2];
                                        
                                        $dataBR = $dataDia . '-' . $dataMes . '-' . $dataAno;
                                    ?>
                                    <td>{{$dataBR}}</td>
                                    <td>{{$dataHora[1]}}</td>
                                    <td>{{$itemMatch->match}}</td>
                                </tr>
                                <tr>
                                </tr>
                            @endforeach
                        @endforeach
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

