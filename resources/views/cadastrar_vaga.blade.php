@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8" style="position: absolute; width:610px; padding-top: 7.0rem; padding-bottom:7.0rem;">
            <div class="card">
                <div class="card-header"> Empresa</div>
                <div class="card-body" style="padding-bottom:110px;">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        @if(isset($vaga))
                            <form action="{{route('atualizarVaga')}}" method="POST">
                            <input type="hidden" name="idVaga" value="{{$vaga->id}}">
                            <input type="hidden" name="idEmpresa" value="{{$vaga->empresa_id}}">
                            @csrf
                        @else
                            <form action="{{route('adicionarVaga')}}" method="POST">
                            @csrf
                        @endif
                        <center style="background-color: rgba(0,0,0,.03); font-size:20px; 'width':100%; height:30px; color:black;">Cadastrar Vaga</center><br>
                        <div class="btn-group">
                            <div>
                                <label for="nomeVaga">Nome da Vaga<a style="color:red"> *</a></label>
                                @if(isset($vaga)) {{--Verifica se o objeto vaga existe--}}
                                    <input type="text" name="nome_vaga" class="@error('nome_vaga') is-invalid @enderror form-control" style="width:400px;" value="{{ $vaga->nome_vaga }}" id="entrada_vaga" aria-describedby="emailHelp" placeholder="ex.: Design de Sobrancelhas, Vigilante, Porteiro">
                                @else
                                    <input type="text" name="nome_vaga" class="@error('nome_vaga') is-invalid @enderror form-control" style="width:400px;" value="{{ old('nome_vaga') }}" id="entrada_vaga" aria-describedby="emailHelp" placeholder="ex.: Design de Sobrancelhas, Vigilante, Porteiro">
                                @endif
                                <small id="nome_vaga" class="form-text text-muted">ex.: XXXXXXXXXXX</small>
                                @error('nome_vaga')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>


                            <div style="margin-left:10px;">
                                <label for="entradaTipoDeVaga">Tipo de Vaga<a style="color:red"> *</a></label>
                                <select name="tipo_de_vaga" class="@error('tipo_de_vaga') is-invalid @enderror form-control" id="tipo_de_vaga">
                                    @if(isset($vaga))
                                        <option value="{{ $vaga->tipo_de_vaga }}">{{ $vaga->tipo_de_vaga }}</option>
                                    @else
                                        <option>Selecione...</option>
                                    @endif
                                    <option>Aprendiz</option>
                                    <option>Autônomo</option>
                                    <option>Comissionado</option>
                                    <option>Concurso</option>
                                    <option>Efetivo/CLT</option>
                                    <option>Estágio</option>
                                    <option>Freelancer/MEI</option>
                                    <option>Temporário</option>
                                    <option>Trainne</option>
                                    <option>Voluntário</option>
                                </select>

                                @error('tipo_de_vaga')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <div class="btn-group">
                            <div >
                                <label for="entradaUF">UF<a style="color:red"> *</a></label>
                                <select  class="@error('uf') is-invalid @enderror form-control" id="nome_completo" value="{{ old('uf') }}" name="uf">
                                        @if(isset($vaga))
                                            <option  value={{$vaga->endereco->uf}}>{{$vaga->endereco->uf}}</option>
                                        @endif
                                        <option>PE</option>
                                        <option>PB</option>
                                        <option>PA</option>
                                </select>
                                @error('uf')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>

                            <div style="margin-left:15px;">
                                <label for="entradaCidade">Cidade<a style="color:red"> *</a></label>
                                <select class="@error('cidade') is-invalid @enderror form-control" style="width:200px;" id="nome_completo" value="{{ old('cidade') }}" name="cidade">
                                        @if(isset($vaga))
                                            <option  value={{$vaga->endereco->cidade}}>{{$vaga->endereco->cidade}}</option>
                                        @else
                                        <option>Selecione...</option>
                                        @endif
                                        <option>Recife</option>
                                        <option>Olinda</option>
                                        <option>Garanhuns</option>
                                </select>
                                @error('cidade')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                            <div  style="margin-left:10px;">
                                <label for="entradaRua">Rua<a style="color:red"> *</a></label>
                                @if(isset($vaga)) {{--Verifica se o objeto vaga existe--}}
                                    <input type="text" name="rua" class="@error('rua') is-invalid @enderror form-control" id="nome_completo" style="width:250px;" value="{{ $vaga->empresa->endereco->rua }}" id="entrada_rua" aria-describedby="emailHelp" placeholder="ex.: Nome da Rua">
                                @else
                                    <input type="text" name="rua" class="@error('rua') is-invalid @enderror form-control" id="nome_completo" style="width:250px;" value="{{ old('rua') }}" id="entrada_rua" aria-describedby="emailHelp" placeholder="ex.: Nome da Rua">
                                @endif
                                <small id="entradaRua" class="form-text text-muted">ex.: aaaaaa</small>
                                @error('rua')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="btn-group">
                            <div>
                                <label for="entradaBairro">Bairro<a style="color:red"> *</a></label>
                                @if(isset($vaga)) {{--Verifica se o objeto vaga existe--}}
                                    <input type="text" name="bairro" class="@error('bairro') is-invalid @enderror form-control" id="rua" style="width:400px;" value="{{ $vaga->empresa->endereco->bairro }}" id="entrada_bairro" aria-describedby="emailHelp" placeholder="ex.: Nome do Bairro">
                                @else
                                    <input type="text" name="bairro" class="@error('bairro') is-invalid @enderror form-control" id="rua" style="width:400px;" value="{{ old('bairro') }}" id="entrada_bairro" aria-describedby="emailHelp" placeholder="ex.: Nome do Bairro">
                                @endif
                                <small id="entradaBairro" class="form-text text-muted">ex.: aaaaaa</small>
                                @error('bairro')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                            <div style="margin-left:10px;">
                                <label for="entradaNumero">Número<a style="color:red"> *</a></label>
                                @if(isset($vaga))
                                    <input type="text" name="numero" class="@error('numero') is-invalid @enderror form-control" id="nome_completo" style="width:130px;" value="{{ $vaga->empresa->endereco->numero }}" id="entrada_numero" placeholder="ex.: Número">
                                @else
                                    <input type="text" name="numero" class="@error('numero') is-invalid @enderror form-control" id="nome_completo" style="width:130px;" value="{{ old('numero') }}" id="entrada_numero" placeholder="ex.: Número">
                                @endif
                                <small id="entradaNumero" class="form-text text-muted">ex.: aaaaaa</small>
                                @error('numero')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div style="margin-top:10px;">
                            <label for="entradaComplemento">Complemento</label>
                            <input type="text" name="complemento" class="@error('complemento') is-invalid @enderror form-control" id="complemento" style="width:100%;" value="{{ old('complemento') }}" id="complemento" placeholder="ex.: Complemento">
                            <small id="entradaComplemento" class="form-text text-muted">ex.: Perto da Praça, Próximo ao Mercado</small>
                            @error('complemento')
                                <div >
                                    <a style="color:red;">{{ $message }}</a>
                                </div>
                            @enderror
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="entradaDescricao">Descrição<a style="color:red"> *</a></label>
                            @if(isset($vaga))
                                <textarea name="descricao" class="@error('descricao') is-invalid @enderror form-control" id="vaga" rows="5" cols="50" placeholder="Digite aqui a descrição da vaga">{{ $vaga->descricao }}</textarea>
                            @else
                                <textarea name="descricao" class="@error('descricao') is-invalid @enderror form-control" id="vaga" value="{{ old('descricao') }}" rows="5" cols="50" placeholder="Digite aqui a descrição da vaga"></textarea>
                            @endif
                            @error('descricao')
                            <div >
                                <a style="color:red;">{{ $message }}</a>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="entradaExperiencia">Habilidades Necessárias<a style="color:red"> *</a></label>
                            @if(isset($vaga))
                                <textarea name="experiencia" class="@error('experiencia') is-invalid @enderror form-control" id="habilidades_necessarias" rows="5" cols="50">{{ $vaga->experiencia }}</textarea>
                            @else
                                <textarea name="experiencia" class="@error('experiencia') is-invalid @enderror form-control" id="habilidades_necessarias" value="{{ old('experiencia') }}" rows="5" cols="50" placeholder="Digite aqui as hablidades necessárias que o seu candidato deve ter"></textarea>
                            @endif
                            @error('experiencia')
                                <div >
                                    <a style="color:red;">{{ $message }}</a>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="entradaAtribuicoes">Atribuições<a style="color:red"> *</a></label>
                            @if(isset($vaga))
                                <textarea name="atribuicoes" class="@error('atribuicoes') is-invalid @enderror form-control" id="atribuicoes" rows="5" cols="50">{{ $vaga->atribuicoes }}</textarea>
                            @else
                                <textarea name="atribuicoes" class="@error('atribuicoes') is-invalid @enderror form-control" id="atribuicoes" value="{{ old('atribuicoes') }}" rows="5" cols="50" placeholder="Digite aqui a atribuição que seu candidato deve ter"></textarea>
                            @endif
                            @error('atribuicoes')
                                <div >
                                    <a style="color:red;">{{ $message }}</a>
                                </div>
                            @enderror
                        </div>
                        <hr/>
                        <div class="btn-group">
                            <div>
                                <label for="entradaQuantidade">Quantidade de Vagas<a style="color:red"> *</a></label>
                                @if(isset($vaga))
                                    <input type="text" name="quantidade" class="@error('quantidade') is-invalid @enderror form-control" id="nome_completo" value="{{ $vaga->quantidade }}" id="entrada_quantidade" aria-describedby="emailHelp" placeholder="ex.: 1,20, 50">
                                @else
                                    <input type="text" name="quantidade" class="@error('quantidade') is-invalid @enderror form-control" id="nome_completo" value="{{ old('quantidade') }}" id="entrada_quantidade" aria-describedby="emailHelp" placeholder="ex.: 1,20, 50">
                                @endif
                                <small id="entradaQuantidadeDeVagas" class="form-text text-muted">ex.: 1,20, 50</small>
                                @error('quantidade')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                            <div style="margin-left:15px;">
                                <label for="entradaPCD">Vaga para PCD<a style="color:red"> *</a></label>

                                @if(isset($vaga)) {{-- Vaga ja criada--}}
                                    @if($vaga->vaga_para_pcd == true)
                                        <div >
                                            <input type="radio" id="simPCD" name="vaga_para_pcd" value=true checked>
                                            <label for="sim">Sim</label>
                                        </div>
                                        <div >
                                            <input type="radio" id="naoPCD" name="vaga_para_pcd" value=false>
                                            <label for="nao">Não</label>
                                        </div>
                                    @else
                                        <div >
                                            <input type="radio" id="simPCD" name="vaga_para_pcd" value=true>
                                            <label for="sim">Sim</label>
                                        </div>
                                        <div >
                                            <input type="radio" id="naoPCD" name="vaga_para_pcd" value=false checked>
                                            <label for="nao">Não</label>
                                        </div>
                                    @endif
                                @else {{-- Nova vaga--}}
                                    <div >
                                        <input type="radio" id="simPCD" name="vaga_para_pcd" value=true >
                                        <label for="sim">Sim</label>
                                    </div>
                                    <div >
                                        <input type="radio" id="naoPCD" name="vaga_para_pcd" value=false checked>
                                        <label for="nao">Não</label>
                                    </div>
                                @endif
                                <small id="entradaEmail" class="form-text text-muted">PDC - Pessoa com deficiênca.</small>
                            </div>
                        </div>
                        <hr/>
                        <div class="btn-group">
                            <div>
                                <label for="entradaSalario">Salario</label>
                                @if(isset($vaga))
                                    <input type="text" min="1" step="any" name="salario" class=" form-control" id="nome_completo" value="{{ $vaga->salario }}" id="entrada_salario" aria-describedby="emailHelp">
                                @else
                                    <input type="text" min="1" step="any" name="salario" class=" form-control" id="nome_completo" value="{{ old('salario') }}" id="entrada_salario" aria-describedby="emailHelp" placeholder="1.000,00 ">
                                @endif
                                @error('salario')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror

                            </div>

                            <div style="margin-left:15px;">
                                <label for="entradaTipoDeRemuneracao">Tipo de Remuneração<a style="color:red"> *</a></label>
                                <select class="@error('tipo_de_remuneracao') is-invalid @enderror form-control" id="nome_completo" value="{{ old('tipo_de_remuneracao') }}" name="tipo_de_remuneracao" >
                                    @if(isset($vaga))
                                        <option value="{{ $vaga->tipo_de_remuneracao }}">{{ $vaga->tipo_de_remuneracao }}</option>
                                    @endif
                                    <option>Por Mês</option>
                                    <option>Por Semana</option>
                                    <option>Por Dia</option>
                                    <option>Por Hora</option>
                                </select>
                                @error('tipo_de_remuneracao')
                                    <div >
                                        <a style="color:red;">{{ $message }}</a>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div style="position:absolute; left:430px; margin-top:30px;">
                            @if(isset($vaga))
                                <button type="submit" class="btn btn-success">Atualizar Vaga</button>
                            @else
                                <button type="submit" class="btn btn-primary">Salvar Vaga</button>
                            @endif

                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
