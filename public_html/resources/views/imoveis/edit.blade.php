@extends('layouts.layout_navbar')

@section('title','Detalhes do Produto')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">
<link rel="stylesheet" href="{{ asset('css/produto.css') }}">
<link rel="stylesheet" href="{{ asset('css/carrossel-slider.css') }}">

<script src="{{ asset('js/mostrar-interesse.js') }}"></script>
<script src="{{ asset('js/tela-cheia.js') }}"></script>
<script src="{{ asset('js/numformat.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

<button id="mostrar" onclick="changeVisibility()">Tenho interesse!</button>

<div id="fullscreen" style="display: none;" class="fs-switch">
    <div id="fechar-icone-container" onclick="fechar_fullscreen()" style="left: 10px; top: 10px;" class="fs-switch">
        <img src="{{ asset('img/fechar-icone.svg') }}" alt="" id="fechar-imagem">
    </div>

    <div id="carrossel-content" class="slider-wrapper fs-switch" draggable="false">
        <div class="slider-fs" draggable="false">

            @foreach ($imagens as $index => $path)
            @if($detalhes->id == $path->chave)
            <img src="{{asset($path->path)}}" alt="" id="{{asset($path->path)}}-fs" draggable="false">
            @endif
            @endforeach
        </div>
    </div>
    <div id="carrossel-galeria" style="max-width: 80%; overflow-x: scroll; flex-wrap:nowrap;">
        @foreach ($imagens as $index => $path)
        @if($detalhes->id == $path->chave)
        <a class="galeria-item" style="background-image: url('{{asset($path->path)}}')" style="width:200px; height:100px" href="#{{asset($path->path)}}-fs" onclick="document.getElementById('carrossel-content').focus()"></a>
        @endif
        @endforeach
    </div>
</div>

<div id="pagina-layout" class="background-blur">
    <section id="interesse" class="margin-spaced padding-spaced">
        <div id="fechar-icone-container" onclick="changeVisibility()">
            <img src="{{ asset('img/fechar-icone.svg') }}" alt="" id="fechar-icone">
        </div>
        <div id="interesse-contato-container" class="flex-center-center-column">
            <form action="/contato" method="POST" autocomplete="off">
                @csrf
                <h1>Se interessou pelo imóvel? fale conosco!</h1>
                <input name="nome" type="text" id="interesse-contato-nome" class="interesse-contato-input" placeholder="Nome" required>
                <input name="telefone" type="text" id="interesse-contato-telefone" class="interesse-contato-input" placeholder="Telefone" required>
                <input name="email" type="text" id="interesse-contato-email" class="interesse-contato-input" placeholder="Email">
                <textarea name="mensagem" id="interesse-contato-texto" cols="30" rows="10" class="interesse-contato-input" placeholder="Texto (opcional)" required></textarea>
                <input type="hidden" name="cod_imovel_form" value="{{ $detalhes->cod_imovel }}">
                <button type="submit" id="interesse-btn">Enviar</button>
            </form>
        </div>
        <div class="aviso">
            <p>Valores sujeitos a alteração sem aviso prévio, bem como sua disponibilidade. As informações contidas neste site são fornecidas pelo proprietário do imóvel e pelas concessionárias administradoras.</p>
        </div>
    </section>

    <div id="produto-layout">
        <section id="imovel-info-main" class="flex-center-center-column margin-spaced padding-spaced">
            <div id="title-imovel">
                <h1 id="imovel-titulo-label">{{ $detalhes->titulo }}</h1>
                <div id="imovel-id" style="margin-left: 10px;">
                    <span class="material-symbols-outlined">Badge</span>
                    <h3>{{ $detalhes->cod_imovel}}</h3>
                </div>
            </div>

            <div id="carrossel-container">
                <div id="carrossel-content" class="slider-wrapper principal-img" draggable="false">
                    <div class="slider" draggable="false">
                        <img src="{{asset($path->path)}}" alt="" id="{{asset($path->path)}}" draggable="false">
                    </div>
                </div>

                <img src="{{ asset('img/seta-esquerda.svg') }}" alt="" class="seta-esquerda">
                <img src="{{ asset('img/seta-direita.svg') }}" alt="" class="seta-direita">
                <img src="{{ asset('img/expand.svg') }}" alt="" class="expand">

            </div>
            <div id="carrossel-galeria" class="slider-carrossel">
                @foreach ($imagens as $index => $path)
                @if($detalhes->id == $path->chave)
                <a class="galeria-item" style="background-image: url('{{asset($path->path)}}')" style="width:200px; height:100px" href="#{{asset($path->path)}}" onclick="document.getElementById('carrossel-content').focus()"></a>
                @endif
                @endforeach
            </div>

            <div id="imovel-dados" class="flex-row">
                <h1>{{ $detalhes->tp_contrato }}</h1>
                @if($detalhes->vendidoAlugado != null)
                <h1 id="valor" class="num-format">INDISPONÍVEL</h1>
                @else
                @if($detalhes->tp_contrato == "Aluguel")
                <h1 id="valor" class="num-format troca-ponto">R${{ $detalhes->valorAluguel }}</h1>
                @else
                <h1 id="valor" class="num-format troca-ponto">R${{ $detalhes->valorVenda }}</h1>
                @endif
                @endif
            </div>
        </section>

        <section id="descricao">
            <!-- <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Tipo de contrato</h2>
                        <p id="desc-texto">{{ $detalhes->tp_contrato }}</p>
                    </div> -->

            @if($detalhes->id_tp_produto == 5)
            <!-- <div id="descricao-container" class="margin-spaced padding-spaced">
                            <h2 class="detalhes-titulo">Tipo de Comércio</h2>
                            <p id="desc-texto" class="alinhado">{{ $detalhes->tipoComercio }}</p>
                        </div> -->
            @endif
            <div id="descricao-container" class="margin-spaced padding-spaced">
                <h2 class="detalhes-titulo">Descrição do Imóvel</h2>
                <p id="desc-texto" class="alinhado">{{ $detalhes->desc }}</p>
            </div>

            <div id="descricao-container" class="margin-spaced padding-spaced">
                <h2 class="detalhes-titulo">Em Condomínio</h2>
                <p id="desc-texto" class="alinhado">{{ $detalhes->emCondominio }}</p>
            </div>

            @if($detalhes->mobiliado_ddl != "vazio")
            <div id="descricao-container" class="margin-spaced padding-spaced">
                <h2 class="detalhes-titulo">Mobiliado</h2>
                <p id="desc-texto" class="alinhado">{{ $detalhes->mobiliado_ddl }}</p>
            </div>
            @endif
            <div id="descricao-container" class="margin-spaced padding-spaced aviso">
                <h2 class="detalhes-titulo">Aviso</h2>
                <p>Os valores e demais informações poderão sofrer alterações sem prévio aviso</p>
            </div>
            <div id="descricao-container" class="margin-spaced padding-spaced">
                <h2 class="detalhes-titulo">Localização</h2>
                <p id="desc-texto">Cidade: {{ $detalhes->cidade }}</p>
                <p id="desc-texto">Bairro: {{ $detalhes->bairro }}</p>
                <p id="desc-texto">Endereço: {{ $detalhes->ruaNumero }}</p>
                <p id="desc-texto">CEP: {{ $detalhes->cep }}</p>

            </div>

            <div id="descricao-container" class="margin-spaced padding-spaced">
                <h2 class="detalhes-titulo">Informações sobre área</h2>

                <div class="area-container">
                    <!-- <div class="area-content">
                        @if ($detalhes->id_tp_produto == 2)
                        @if($detalhes->area != 0)
                        <p id="area"><span>Área total:</span> {{ $detalhes->area }} m²</p>
                        @endif
                        @else ($detalhes->id_tp_produto == 3)
                        @if($detalhes->area != 0)
                        <p id="area"><span>Área total:</span> {{ $detalhes->area }} m²</p>
                        @endif
                        @endif
                    </div> -->

                    @if ($detalhes->area != 0)
                    <div class="area-content">
                        <p id="area"><span>Área total:</span> {{ $detalhes->area }} m²</p>
                    </div>
                    @endif

                    @if ($detalhes->areaUtil != 0)
                    <div class="area-content">
                        <p id="area"><span>Área útil:</span> {{ $detalhes->areaUtil }} m²</p>
                    </div>
                    @endif

                    @if ($detalhes->areaConstruida != 0)
                    <div class="area-content">
                        <p id="area"><span>Área construída:</span> {{ $detalhes->areaConstruida }} m²</p>
                    </div>
                    @endif

                    @if ($detalhes->areaTerreno != 0)
                    <div class="area-content">
                        <p id="area"><span>Área do terreno:</span> {{ $detalhes->areaTerreno }} m²</p>
                    </div>
                    @endif

                    {{-- @if ($detalhes->elevadores != '')
                                <div class="area-content">
                                    <p id="area"><span>Elevador(es):</span> {{ $detalhes->elevadores }}</p>
                </div>
                @endif --}}



                @if ($detalhes->descricao == 'Terreno')
                @if ($detalhes->metragemFrente != 0)
                <div class="area-content">
                    <p id="area"><span>Metragem dianteira:</span> {{ $detalhes->metragemFrente }} m²</p>
                </div>
                @endif
                @if ($detalhes->metragemFundo != 0)
                <div class="area-content">
                    <p id="area"><span>Metragem Lateral:</span> {{ $detalhes->metragemFundo }} m²</p>
                </div>
                @endif
                @if ($detalhes->metragemDireita != 0)
                <div class="area-content">
                    <p id="area"><span>Metragem Direita:</span> {{ $detalhes->metragemDireita }} m²</p>
                </div>
                @endif
                @if ($detalhes->metragemEsquerda != 0)
                <div class="area-content">
                    <p id="area"><span>Metragem Esquerda:</span> {{ $detalhes->metragemEsquerda }} m²</p>
                </div>
                @endif
                @if ($detalhes->posTerreno and $detalhes->posTerreno != 'nao')
                <div class="area-content">
                    <p id="area"><span>Posição do Terreno:</span> {{ $detalhes->posTerreno }}</p>
                </div>
                @endif
                @if ($detalhes->formaTerreno and $detalhes->formaTerreno != 'nao')
                <div class="area-content">
                    <p id="area"><span>Forma do terreno:</span> {{ $detalhes->formaTerreno }}</p>
                </div>
                @endif
                @if ($detalhes->vegetacao and $detalhes->vegetacao != 'nao')
                <div class="area-content">
                    <p id="area"><span>Vegetação:</span> {{ $detalhes->vegetacao }}</p>
                </div>
                @endif
                @if ($detalhes->protecao and $detalhes->protecao != 'nao')
                <div class="area-content">
                    <p id="area"><span>Proteção:</span> {{ $detalhes->protecao }}</p>
                </div>
                @endif
                @if ($detalhes->topografia and $detalhes->topografia != 'nao')
                <div class="area-content">
                    <p id="area"><span>Topografia:</span> {{ $detalhes->topografia }}</p>
                </div>
                @endif
                @endif

                {{-- dd($detalhes->vegetacao, $detalhes->protecao, $detalhes->topografia) --}}
            </div>
    </div>

    @if ($detalhes->valorCondominio != null or $detalhes->iptuMensal)
    <div id="descricao-container" class="margin-spaced padding-spaced">
        <h2 class="detalhes-titulo">Valores</h2>

        <div class="area-container">
            @if ($detalhes->valorCondominio != null)
            <div class="area-content">
                <p>Condomínio:<span class="num-format troca-ponto">R$ {{ $detalhes->valorCondominio }}</span></p>
            </div>
            @endif

            @if ($detalhes->iptuMensal != null)
            <div class="area-content">
                <p>IPTU mensal:<span class="num-format troca-ponto">R${{ $detalhes->iptuMensal }}</span></p>
            </div>
            @endif

            @if($detalhes->tp_contrato == 'Aluguel')
            <div class="area-content">
                <p>Valor do Aluguel:<span class="num-format troca-ponto">R${{ $detalhes->valorAluguel }}</span></p>
            </div>
            @elseif($detalhes->tp_contrato == 'Venda')
            <div class="area-content">
                <p>Valor da Venda:<span class="num-format troca-ponto">R${{ $detalhes->valorVenda }}</span></p>
            </div>
            @else
            <div class="area-content">
                <p>Valor do Aluguel:<span class="num-format troca-ponto">R${{ $detalhes->valorAluguel }}</span></p>
            </div>
            <div class="area-content">
                <p>Valor da Venda:<span class="num-format troca-ponto">R${{ $detalhes->valorVenda }}</span></p>
            </div>
            @endif
        </div>
    </div>
    @endif

    @if ($detalhes->descricao != 'Terreno')
    <div id="descricao-container" class="margin-spaced padding-spaced">
        <h2 class="detalhes-titulo">Acomodações</h2>
        <div class="area-container">
            <!--@if ($detalhes->qtdQuartos != 0)-->
            <!--    <div class="area-content">-->
            <!--        <p id="quartos">{{ $detalhes->qtdQuartos }} quarto(s)</p>-->
            <!--    </div>-->
            <!--@endif-->

            @if ($detalhes->qtdBanheiros != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdBanheiros }} banheiro(s)</p>
            </div>
            @endif

            @if ($detalhes->qtdSuites != null or $detalhes->qtdSuites != 0)
            <div class="area-content">
                <p id="quartos"> {{ $detalhes->qtdSuites }} suite(s)</p>
            </div>
            @endif

            @if ($detalhes->qtdGaragemCobertas != null or $detalhes->qtdGaragemCobertas != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdGaragemCobertas }} vaga(s) cobertas</p>
            </div>
            @endif

            @if ($detalhes->qtdGaragemNaoCobertas != null or $detalhes->qtdGaragemNaoCobertas != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdGaragemNaoCobertas }} vaga(s) não cobertas</p>
            </div>
            @endif

            @if ($detalhes->qtdSacadasCobertas != null or $detalhes->qtdSacadasCobertas != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdSacadasCobertas }} sacada(s)</p>
            </div>
            @endif

            @if ($detalhes->qtdSalas != null or $detalhes->qtdSalas != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdSalas }} sala(s)</p>
            </div>
            @endif

            @if ($detalhes->qtdDorms != null or $detalhes->qtdDorms != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdDorms }} dormitório(s)</p>
            </div>
            @endif
            @if ($detalhes->qtdNumAndares != null or $detalhes->qtdNumAndares != 0)
            <div class="area-content">
                <p id="quartos">{{ $detalhes->qtdNumAndares }} andar(es)</p>
            </div>
            @endif
            @if ($detalhes->qtdAndar != null or $detalhes->qtdAndar != 0)
            <div class="area-content">
                <p id="quartos"> Localizado no andar: {{ $detalhes->qtdAndar }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif
    </section>

    <section id="mais-detalhes" class="margin-spaced padding-spaced">
        <h2 class="detalhes-titulo">Mais detalhes</h2>
        <div id="mais-detalhes-container">
            <h3>Características do Imóvel</h3>
            <div class="area-container" id="db-check-container">
                @if($detalhes->agua == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Água</p>
                </div>
                @endif

                @if($detalhes->esgoto == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Esgoto</p>
                </div>
                @endif

                @if($detalhes->sistemaEsgoto == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sistema de esgoto</p>
                </div>
                @endif


                @if($detalhes->laminado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Laminado</p>
                </div>
                @endif




                @if($detalhes->acessoDeficiente == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Acesso para Deficiente</p>
                </div>
                @endif

                @if($detalhes->geradorEnergiaImovel == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Gerador de Energia</p>
                </div>
                @endif

                @if($detalhes->sisAlar == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sistema de alarmes</p>
                </div>
                @endif


                @if($detalhes->luminarias == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Luminárias</p>
                </div>
                @endif
                @if($detalhes->recepcao == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Recepção</p>
                </div>
                @endif

                @if($detalhes->sisTel == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sistema de telefonia</p>
                </div>
                @endif

                @if($detalhes->rede == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Estrut. rede. comput.</p>
                </div>
                @endif

                @if($detalhes->energia == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Energia</p>
                </div>
                @endif

                @if($detalhes->murado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Murado</p>
                </div>
                @endif

                @if($detalhes->pavimentacao == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Pavimentação</p>
                </div>
                @endif
                @if($detalhes->gasEncanado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Gás encanado</p>
                </div>
                @endif



                <!-- {{-- @if($detalhes->qtdSacadasCobertas == 1)
                                    <div class="area-content">
                                        <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sacadas</p>
                                    </div>
                                @endif --}} -->

                @if($detalhes->areaServico == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Área de Serviço</p>
                </div>
                @endif

                @if($detalhes->banheiroEmpregada == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Wc. de empregados</p>
                </div>
                @endif

                @if($detalhes->cozinha == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Cozinha</p>
                </div>
                @endif

                @if($detalhes->cozinhaPlanejada == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Cozinha Planejada</p>
                </div>
                @endif

                @if($detalhes->despensa == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Despensa</p>
                </div>
                @endif

                @if($detalhes->lavanderias == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Lavanderia</p>
                </div>
                @endif

                @if($detalhes->guarita == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Guarita</p>
                </div>
                @endif

                @if($detalhes->areaLazer == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Área de Lazer</p>
                </div>
                @endif

                @if($detalhes->varanda == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Varanda</p>
                </div>
                @endif

                @if($detalhes->varandaGourmet == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Varanda Gourmet</p>
                </div>
                @endif

                @if($detalhes->cozinhaConjugada == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Cozinha Conjugada</p>
                </div>
                @endif
                @if($detalhes->lavado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Lavabo</p>
                </div>
                @endif

                @if($detalhes->roupeiro == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Roupeiro</p>
                </div>
                @endif

                @if($detalhes->suiteMaster == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Suíte Master</p>
                </div>
                @endif

                @if($detalhes->closet == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Closet</p>
                </div>
                @endif

                @if($detalhes->pisoFrio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso frio</p>
                </div>
                @endif

                @if($detalhes->porcelanato == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Porcelanato</p>
                </div>
                @endif
                @if($detalhes->entradaServico == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Entrada de serviço</p>
                </div>
                @endif

                @if($detalhes->escritorio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Escritorio</p>
                </div>
                @endif

                @if($detalhes->jardim == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Jardim</p>
                </div>
                @endif

                @if($detalhes->moveisPlanejados == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Moveis Planejados</p>
                </div>
                @endif

                @if($detalhes->porteiroEletronico == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Porteiro eletronico</p>
                </div>
                @endif

                @if($detalhes->tvCabo == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>TV a Cabo</p>
                </div>
                @endif

                @if($detalhes->arCondicionado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Ar Condicionado</p>
                </div>
                @endif



                @if($detalhes->aguaSolar == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Água Aquecida por Energia Solar</p>
                </div>
                @endif
                @if($detalhes->aguaEncanada == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Água encanada</p>
                </div>
                @endif

                <!-- @if($detalhes->mobiliado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Mobiliado</p>
                </div>
                @endif -->

                @if($detalhes->depEmpregados == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Dep de Empregados</p>
                </div>
                @endif

                @if($detalhes->lareira == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Lareira</p>
                </div>
                @endif

                @if($detalhes->elevadores == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Elevador</p>
                </div>
                @endif

                @if($detalhes->caseiro == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Caseiro</p>
                </div>
                @endif

                @if($detalhes->edicula == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Edicula</p>
                </div>
                @endif

                @if($detalhes->piscinaCondominio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piscina</p>
                </div>
                @endif

                @if($detalhes->terraco == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Terraço</p>
                </div>
                @endif

                @if($detalhes->hidromassagem == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Hidromassagem</p>
                </div>
                @endif

                @if($detalhes->vagaFixa == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Vaga Fixa</p>
                </div>
                @endif

                @if($detalhes->dormEmpregado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Dorm. de empregados</p>
                </div>
                @endif

                @if($detalhes->carpeteAcri == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Carpete de acrilico</p>
                </div>
                @endif

                @if($detalhes->carpeteMadeira == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Carpete de madeira</p>
                </div>
                @endif

                @if($detalhes->carpeteNylon == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Carpete de nylon</p>
                </div>
                @endif

                @if($detalhes->corredor == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Corredor</p>
                </div>
                @endif

                @if($detalhes->vagaRotativa == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Vaga Rotativa</p>
                </div>
                @endif

                @if($detalhes->jardimInverno == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Jardim de Inverno</p>
                </div>
                @endif

                @if($detalhes->pisoAquecido == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Aquecido</p>
                </div>
                @endif

                @if($detalhes->pisoArdosia == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Ardosia</p>
                </div>
                @endif

                @if($detalhes->pisoBioquete == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Bloquete</p>
                </div>
                @endif

                @if($detalhes->pisoCarpete == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Carpete</p>
                </div>
                @endif

                @if($detalhes->pisoCeramica == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Ceramica</p>
                </div>
                @endif

                @if($detalhes->pisoCimentoQueimado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Cimento Queimado</p>
                </div>
                @endif

                @if($detalhes->pisoEmborrachado == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Emborrachado</p>
                </div>
                @endif

                @if($detalhes->pisoTacoMadeira == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Taco Madeira</p>
                </div>
                @endif

                @if($detalhes->contraPiso == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Contrapiso</p>
                </div>
                @endif

                @if($detalhes->pisoTabua == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso Tabua</p>
                </div>
                @endif

                @if($detalhes->granito == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Granito</p>
                </div>
                @endif

                @if($detalhes->marmore == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Marmore</p>
                </div>
                @endif

                @if($detalhes->armarioCozinha == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários na Cozinha</p>
                </div>
                @endif

                @if($detalhes->armarioCorredor == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários no Corredor</p>
                </div>
                @endif

                @if($detalhes->armarioCloset == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários no Closet</p>
                </div>
                @endif

                @if($detalhes->armarioQuarto == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários no Quarto</p>
                </div>
                @endif

                @if($detalhes->armarioBanheiro == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários no Banheiro</p>
                </div>
                @endif

                @if($detalhes->armarioSala == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários na Sala</p>
                </div>
                @endif

                @if($detalhes->armarioEscritorio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários Escritorio</p>
                </div>
                @endif

                @if($detalhes->armarioDepEmp == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários Dep. empregado</p>
                </div>
                @endif

                @if($detalhes->armarioAreaServico == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Armários na Área de Servico</p>
                </div>
                @endif

                @if($detalhes->salaCinema == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sala de Cinema</p>
                </div>
                @endif





                @if($detalhes->acessoEnergia == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Acesso a energia Eletrica</p>
                </div>
                @endif

                @if($detalhes->escola == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Escola</p>
                </div>
                @endif

                @if($detalhes->comercio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Comércio</p>
                </div>
                @endif

                @if($detalhes->copa == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Copa</p>
                </div>
                @endif

                @if($detalhes->mesanino == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Mezanino</p>
                </div>
                @endif



            </div>
            <h3>Características da Área Comum</h3>
            <div class="area-container" id="db-check-container">
                @if($detalhes->geradorEnergia == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Gerador Energia</p>
                </div>
                @endif
                @if($detalhes->arCondicionadoCentral == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Ar condicionado central</p>
                </div>
                @endif

                @if($detalhes->adega == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Adega</p>
                </div>
                @endif

                @if($detalhes->churrasqueira == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Churrasqueira</p>
                </div>
                @endif

                @if($detalhes->quadra == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Quadra poliesportiva</p>
                </div>
                @endif

                @if($detalhes->sauna == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sauna</p>
                </div>
                @endif

                @if($detalhes->campFut == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Campo de futebool</p>
                </div>
                @endif

                @if($detalhes->vestiario == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Vestiário</p>
                </div>
                @endif

                @if($detalhes->salaJogos == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Salão de jogos</p>
                </div>
                @endif

                @if($detalhes->quintal == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Quintal</p>
                </div>
                @endif

                @if($detalhes->piscina == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piscina</p>
                </div>
                @endif

                @if($detalhes->salaFestas == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Salão de Festas</p>
                </div>
                @endif

                @if($detalhes->salaGinastica == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Salão de Ginastica</p>
                </div>
                @endif

                @if($detalhes->playground == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Playground</p>
                </div>
                @endif

                @if($detalhes->portaria24h == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Portaria 24h</p>
                </div>
                @endif

                @if($detalhes->estacionamentoVisita == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Estacionamento de visitantes</p>
                </div>
                @endif

                @if($detalhes->portaoEletronico == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Portão eletronico</p>
                </div>
                @endif

                @if($detalhes->alarme == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Alarme</p>
                </div>
                @endif

                @if($detalhes->sistemaIncendio == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Sistema de incêndio</p>
                </div>
                @endif

                @if($detalhes->aquecimentoCentral == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Aquecimento central</p>
                </div>
                @endif

                @if($detalhes->vigilancia24h == 1)
                <div class="area-content">
                    <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Vigilância 24h</p>
                </div>
                @endif


            </div>

            <h3>Outras informações</h3>
            <div class="area-container" id="extraDivCampo">
                <span id="extraInfo" style="display: none;">{{ $detalhes->extraInfo }}</span>
            </div>
        </div>
    </section>

    @if($semelhante != '0')
    <section id="semelhantes" class="margin-spaced padding-spaced">
        <div id="semelhante-container">
            <h1 class="detalhes-titulo">Conheça semelhantes</h1>
            @foreach( $semelhante as $sem )
            <div id="semelhante-produtos-itens">
                <div class="semelhante-produto-card">
                    @foreach ($imagemPrincipal as $path)
                    @if($sem->id == $path->chave)
                    <div class="img-semelhante" style="background-image: url('{{ asset($path->path) }}')"></div>
                    @endif
                    @endforeach
                    <p class="semelhante-produto-titulo">{{ $sem->titulo }}</p>
                    <p class="semelhante-produto-localidade">{{ $sem->cidade }}</p>
                    <div id="semelhante-produto-info" class="flex-row">
                        <p class="semelhante-produto-area">{{ $sem->area }}m²</p>
                        @if($sem->tp_contrato == "Aluguel")
                        <p class="semelhante-produto-vagas troca-ponto">R${{ $sem->valorAluguel }}</p>
                        @else
                        <p class="semelhante-produto-vagas troca-ponto">R${{ $sem->valorVenda }}</p>
                        @endif
                    </div>
                    <form action="/imoveis/{{ $sem->id }}" method="post">
                        @csrf
                        <input type="hidden" name="idImovel">
                        <button class="produto-saber-mais" type="submit">Detalhes</button>
                    </form>

                </div>
                @endforeach
    </section>
    @endif

</div>
</div>

<div id="ajuda-container" class="background-blur">
    <h1 class="section-title" style="text-align: center; font-size: 24px !important; margin-top: 50px">Como podemos ajudar?</h1>
    <section id="ajuda">
        <div id="ajuda-itens">
            <form class="ajuda-item" action="/" method="POST" onclick="submit()">
                @csrf
                <input type="hidden" name="infoPesquisa" value="Aluguel">
                <img src="{{ asset('img/casa.svg') }}" alt="" class="ajuda-icon">
                <p class="ajuda-info">Alugar um imóvel</p>
            </form>
            <form class="ajuda-item" action="/" method="POST" onclick="submit()">
                @csrf
                <input type="hidden" name="infoPesquisa" value="Venda">
                <img src="{{ asset('img/dinheiro.svg') }}" alt="" class="ajuda-icon">
                <p class="ajuda-info">Comprar um imóvel</p>
            </form>
            <form class="ajuda-item" onclick="window.location.href='/anuncio'">
                <img src="{{ asset('img/megafone.svg') }}" alt="" class="ajuda-icon">
                <p class="ajuda-info">Anunciar um imóvel</p>
            </form>
        </div>
    </section>
</div>

<script src="{{ asset('js/caroselDetalhe.js') }}"></script>
<script src="{{ asset('js/swiper.js') }}"></script>

<script>
    const imoveis_title_list = document.getElementsByClassName('semelhante-produto-titulo')

    if (!widthLowerThan(600)) {
        lim = 5
    } else {
        lim = 8
    }


    function limitarStringPorPalavras(str, numeroPalavras) {
        const palavras = str.split(' ');
        const palavrasLimitadas = palavras.slice(0, numeroPalavras);
        return palavrasLimitadas.join(' ');
    }

    function widthLowerThan(largura) {
        if (window.screen.availWidth > largura) {
            return true
        } else return false
    }

    for (i = 0; i < imoveis_title_list.length; i++) {

        if (imoveis_title_list[i].innerHTML.length > lim) {

            imoveis_title_list[i].innerHTML = limitarStringPorPalavras(imoveis_title_list[i].innerHTML, lim) + "...";
        }

    }
</script>

<script>
    trocaPonto()
</script>

<script>
    const extraInfoDiv = document.getElementById('extraDivCampo')
    var extraInfo = document.getElementById('extraInfo').innerHTML.split(";")

    console.log(extraInfo)

    for (info of extraInfo) {
        console.log(info)
        if (info != "") {
            extraInfoDiv.innerHTML += `<div class="area-content"> <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>${info}</p> </div>`
        }
    }
</script>

@endsection