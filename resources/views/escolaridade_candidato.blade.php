@extends('layouts.app')
@section('content')

<div class="container">
        <div  style="padding-top:80px">
            <div class="card">
                <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div style="padding:1%; float:right;">
                            <button type="button"  class="btn btn-primary" onclick="adicionarAtualizarEscolaridade('adicionar','new','new','new','new','new');" class="btn btn-warning" data-toggle="modal" data-target="#adicionarEditarEscolaModal">Adicionar Nova Escolaridade</button>
                        </div>
                        <div>
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Instituição</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Opções</th>
                                    </tr>
                                </thead>
                                <?php $idTemp =-1; ?>
                                @foreach ($escolaridades as $item)
                                    <?php $idTemp++; ?>
                                    <tbody>
                                        <tr>
                                        <th scope="row">{{$idTemp+1}}</th>
                                        <td>{{$item->instituicao}}</td>
                                        <td>{{$item->curso}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div>
                                                    <button type="button" onclick="adicionarAtualizarEscolaridade('atualizar','{{$item->id}}','{{$item->nivel_educacional}}','{{$item->instituicao}}','{{$item->curso}}','{{$item->data_conclusao}}');" class="btn btn-warning" data-toggle="modal" data-target="#adicionarEditarEscolaModal">Editar</button>
                                                </div>
                                                <div style="margin-left:30px;">
                                                    <form action="{{route('deletarEscolaridade')}}" >
                                                        <input type="hidden" id="idAtualizar" name="escolaridade_id" value="{{$item->id}}">
                                                        <button type="submit" class="btn btn-danger">Deletar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                </div>
                {{-- Modal para Adicionar e Editar uma escolaridade --}}
                <div class="modal fade" id="adicionarEditarEscolaModal" style="padding-top:70px" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Escolaridade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="recipient-name" class="col-form-label">Nível de Formação:</label>
                            <form action="{{route('adicionarEAtualizarEscolaridade')}}" >
                                    <select class="form-control" style="width:230px; margin-top:10px" name="nivel_educacional" id="editarEsc">
                                        <option id="opcaoTeste0" value="Selecione">Selecione...</option>
                                        <option id="opcaoTeste1" value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                                        <option id="opcaoTeste2" value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                        <option id="opcaoTeste3" value="Ensino Médio Completo">Ensino Médio Completo</option>
                                        <option id="opcaoTeste4" value="Técnico/Pós-Médio Incompleto">Técnico/Pós-Médio Incompleto</option>
                                        <option id="opcaoTeste5" value="Técnico/Pós-Médio Completo">Técnico/Pós-Médio Completo</option>
                                        <option id="opcaoTeste6" value="Técnólogo Incompleto">Técnólogo Incompleto</option>
                                        <option id="opcaoTeste7" value="Técnólogo Completo">Técnólogo Completo</option>
                                        <option id="opcaoTeste8" value="Superior Incompleto">Superior Incompleto</option>
                                        <option id="opcaoTeste9" value="Superior Completo">Superior Completo</option>
                                    </select>
                                    {{-- id da escolaridade --}}
                                    <input type="hidden" id="idEscolaridadeAdicionada" name="escolaridade_id" value="">
                                    <input type="hidden" id="idFlag" name="flagTemp"> {{-- idFlag é um identificador--}}

                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Instituição:</label>
                                    <input type="text" class="form-control" id="instituicao" name="instituicao" disabled>
                                    </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Curso:</label>
                                    <input type="text" class="form-control" id="curso" name="curso" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Ano De Conclusão:</label>
                                    <input  class="form-control" id="anoDeConclusao" name="anodeconclusao" type="date" disabled>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        </div>
                    </div>
                    </div>
            </div>
    </div>
</div>
<script>
    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.visibility = 'visible';
        }
        else document.getElementById('ifYes').style.visibility = 'hidden';
    }

    function aviso($texto)
    {

        alert($texto);

    }

    function editarVaga(x){
        // var aux = document.getElementById("aux").value;
        // document.getElementById("aux").value = x;

        var aux = document.getElementById("aux").value;
            document.getElementById(aux).style.display = "block";
            document.getElementById(x).style.display = "block";
            document.getElementById("aux").value = x;

    }
    function novaEscolaridade(){
        var display = document.getElementById("aux").style.display;
            if(display == "none")
                document.getElementById("aux").style.display = 'block';
            else
                document.getElementById("aux").style.display = 'none';
    }
    function mostrarCampos(){
        document.getElementById('aux').addEventListener('change', function () {
        var style = this.value == 'novaEscolaridade' ? 'block' : 'none';
        // document.getElementById('hidden_div').style.display = style;
    });
    }
    window.onload=function(){
        document.getElementById('editarEsc').addEventListener('change', function () {

            //Ensino Fundamental Completo
            if(this.value === 'Ensino Fundamental Completo'){
                //block
                document.getElementById('anoDeConclusao').disabled = false;
                //none
                // document.getElementById('statusCampo').style.display = "none";
                document.getElementById('instituicao').disabled = true;
                document.getElementById('curso').disabled = true;


            //Ensino Medio Incompleto
            }else if(this.value === 'Ensino Médio Incompleto'){//emcInstituicao
                //block
                // document.getElementById('statusCampo').style.display = "block";
                //none
                document.getElementById('anoDeConclusao').disabled = true;
                document.getElementById('instituicao').disabled = true;
                document.getElementById('curso').disabled = true;



            //Ensino Medio Completo
            }else if(this.value === 'Ensino Médio Completo'){
                //block
                document.getElementById('anoDeConclusao').disabled = false;
                //none
                // document.getElementById('statusCampo').style.display = "none";
                document.getElementById('instituicao').disabled = true;
                document.getElementById('curso').disabled = true;


            //Técnico/Pós-Médio Incompleto
            }else if(this.value === 'Técnico/Pós-Médio Incompleto'){
                //block
                // document.getElementById('statusCampo').style.display = "block";
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                document.getElementById('anoDeConclusao').disabled = true;

            //Técnico/Pós-Médio Completo
            }else if(this.value === 'Técnico/Pós-Médio Completo'){
                //block
                document.getElementById('anoDeConclusao').disabled = false;
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                // document.getElementById('statusCampo').style.display = "none";


            //Técnólogo Incompleto
            }else if(this.value === 'Técnólogo Incompleto'){
                //block
                // document.getElementById('statusCampo').style.display = "block";
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                document.getElementById('anoDeConclusao').disabled = true;

            //Técnólogo Completo
            }else if(this.value === 'Técnólogo Completo'){
                //block
                document.getElementById('anoDeConclusao').disabled = false;
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                // document.getElementById('statusCampo').style.display = "none";


            //Superior Incompleto
            }else if(this.value === 'Superior Incompleto'){
                //block
                // document.getElementById('statusCampo').style.display = "block";
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                document.getElementById('anoDeConclusao').disabled = true;

            //Superior Completo
            }else if(this.value === 'Superior Completo'){
                //block
                document.getElementById('anoDeConclusao').disabled = false;
                document.getElementById('instituicao').disabled = false;
                document.getElementById('curso').disabled = false;
                //none
                // document.getElementById('statusCampo').style.display = "none";
            }else{
            }
        });
    }
    //Modal adicionar e Atualizar nova escolaridade
    function adicionarAtualizarEscolaridade(type, idTemp, nivelEducacionalTemp, instituicaoTemp, cursoTemp, dataTemp){
        // console.log(idTemp);
        if(type === "adicionar"){
            document.getElementById('idFlag').value=type;
            document.getElementById('idEscolaridadeAdicionada').value='';
            document.getElementById('instituicao').value='';
            document.getElementById('curso').value='';
            document.getElementById('curso').value=cursoTemp;
            document.getElementById('curso').value='';
        }else if(type === "atualizar"){
            document.getElementById('idFlag').value=type;
            document.getElementById('idEscolaridadeAdicionada').value=idTemp;
            document.getElementById('instituicao').value=instituicaoTemp;
            document.getElementById('curso').value=cursoTemp;
            document.getElementById('anoDeConclusao').value=dataTemp;
        }
    }


</script>

@endsection
