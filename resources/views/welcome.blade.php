<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" media="screen" href="css/welcome.css"/>
        <link type="text/css" rel="stylesheet" media="screen" href="css/layoutRodape.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Colinas Jobs</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <!-- MENU -->
        <div class="flex-center position-ref full-height menuPrincipal">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Entrar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Cadastrar</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        <!--X MENU X-->
        <!-- CONTEUDO -->
        <div class="areaBuscaEBotoes">
            <div class="tab">
                <button class="tablinks personalizandoBotaoCandidato active" onclick="openConteudo(event, 'Sou_Candidato')">Sou Candidato</button><button class="personalizandoBotaoEmpresa" onclick="openConteudo(event, 'Sou_Empresa')">Sou Empresa</button>
            </div>
            <div class="tab area_selecao">
                <div id="Sou_Candidato" class="tabcontent areaCorCandidato" style="display: block">
                    <p class="texto_sou_candidato">Queremos ver você de emprego novo.</p>
                    <div class="campos_candidato">
                    <!-- Buscar oportunidade -->
                    <form action="{{ route('buscarNaoLogado')}}" method="GET">
                        <div class="campo_texto1">
                            <input type="text" name="campo_texto1" placeholder="Gerente, Motorista, Estágio"><br>
                        </div>
                        <div class="campo_texto2">
                            <input type="text" name="campo_texto2" placeholder="Garanhuns, Lajedo, Jupi"><br>
                        </div>
                        <button type="submit" class="buttonPesquisar">Buscar</button>
                    </form>
                    <!--x Buscar oportunidade x-->
                    </div>
                </div>
                <div id="Sou_Empresa" class="tabcontent areaCorEmpresa" style="display: none">
                    <p class="texto_sou_empresa">Encontre o candidato ideal.</p>
                    <div class="campos_empresa">
                        <!-- Buscar candidato -->
                        <form action="{{ route('buscarNaoLogadoCandidato')}}" method="GET">
                            <div>
                                <input style="width:505px";type="text" name="campo_texto3" placeholder="Gerente, Motorista, Estágio"><br>
                            </div>
                            <button class="buttonPesquisar" type="submit">Buscar</button>
                        </form>
                        <!--x Buscar candidato x-->
                    </div>
                </div>
            </div>
                  <script>
                        function openConteudo(evt, cityName) {
                          var i=0, tabcontent, tablinks;
                          tabcontent = document.getElementsByClassName("tabcontent");
                          for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";

                          }
                          tablinks = document.getElementsByClassName("tablinks");
                          for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                          }
                          document.getElementById(cityName).style.display = "block";
                          evt.currentTarget.className += " active";
                        }

                      </script>
        </div>
        {{-- Imagem de fundo --}}
        <div id="SLIDE_BG"></div>
        <div>
            <div class="container_backgound_color"> <!--cor do fundo: cinza-->
                <div class="container">
                    <div id="logo_rodape">
                        <a id="text_logo">Colinas Jobs</a>
                    </div>
                    <div id="institucional">
                        <p>Institucional</p>
                        <a>Quem somos?</a> <br>
                        <a>Por que usar Colinas Jobs?</a> <br>
                        <a>Aviso legal</a> <br>
                        <a>Politica de privacidade</a> <br>
                    </div>
                    <div id="candidato">
                        <p>Candidato</p>
                        <a>Ajuda para candidato</a> <br>
                        <a>Anunciar currículo</a> <br>
                        <a>Busca de emprego</a> <br>
                    </div>
                    <div id="empresa">
                        <p>Empresa</p>
                        <a>Ajuda para empresas</a> <br>
                        <a>Anunciar vagas de emprego</a> <br>
                        <a>Busque candidatos</a> <br>
                    </div>
                    </div>
            </div>
            <div class="container_rodape_credito">
                <p class="texto_rodape_credito"> Copyright © 2019 - Colinas Jobs. Todos os direitos reservados.</p>
            </div>
        </div>
    </body>
</html>
