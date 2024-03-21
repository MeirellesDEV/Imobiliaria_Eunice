@extends('layouts.layout_navbar')

@section('title', 'Todos os Produtos')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">

    <link rel="stylesheet" href="{{ asset('css/listar-produtos.css') }}">

    <form class="background-blur" action="imoveis" method="post" id="painel-pesquisa-lateral" style="display:none">
        @csrf
        <div id="painel-pesquisa-opcoes-lateral">
            <button type="button" id="painel-lateral-fechar" onclick="fecharPainel()">X</button>
            <p>Código do imóvel</p>
            <input type="text" name="cod_imovel" class="input-text" id="painel-titulo" placeholder="Código do imóvel">
            <p>Título do imóvel:</p>
            <input type="text" name="titulo" class="input-text" id="painel-titulo-lateral"
                placeholder="Pesquisar imóvel">
            <p>Cidade:</p>
            <input type="text" name="cidade" id="painel-local-lateral" class="input-text" placeholder="Pesquisar Localidade">
            <p>Bairro:</p>
            <input type="text" name="bairro" id="painel-local-lateral" class="input-text" placeholder="Pesquisar Localidade">
            <p>Endereço:</p>
            <input type="text" name="ruaNumero" id="painel-local-lateral" class="input-text" placeholder="Pesquisar Localidade">

            <p>Tipo de contrato</p>
            <select name="tp_contrato" id="" class="input-text">
                <option value="Todos" selected>Todos</option>
                <option value="Aluguel">Aluguel</option>
                <option value="Venda">Venda</option>
            </select>

            <p>Tipo de imóvel</p>
            <select name="id_tp_produto" id="" class="input-text">
                <option value="Todos" selected>Todos</option>
                <option value="1">Terreno</option>
                <option value="2">Casa</option>
                <option value="3">Apartamento</option>
                <option value="4">Chácara</option>
            </select>

            <div class="radio-container">
                <p class="lateral-title">Valor:</p>
                <div class="radio-options-lateral-valor">
                    <div class="radio-option-lateral">
                        <input type="radio" name="valor" id=""> <label for="">Até R$100.000</label>
                    </div>
                    <div class="radio-option-lateral">
                        <input type="radio" name="valor" id=""> <label for="">Entre R$100.000 e
                            R$300.000</label>
                    </div>
                    <div class="radio-option-lateral">
                        <input type="radio" name="valor" id=""> <label for="">Mais que
                            R$300.000</label>
                    </div>
                </div>
            </div>


            <div class="radio-container">
                <p class="lateral-title">Area:</p>
                <div class="radio-options-lateral-valor">
                    <div class="radio-option-lateral">
                        <input type="radio" name="area" id=""> <label for="">Até
                            150m²</label>
                    </div>
                    <div class="radio-option-lateral">
                        <input type="radio" name="area" id=""> <label for="">Entre 150m² e
                            250m²</label>
                    </div>
                    <div class="radio-option-lateral">
                        <input type="radio" name="area" id=""> <label for="">Mais que
                            250m²</label>
                    </div>
                </div>
            </div>


            <div id="button-buscar-container">
                <button type="submit" class="busca-painel-btn">Procurar</button>
            </div>
        </div>
    </form>

    <div id="pagina" class="enable-dark">

        <div id="painel-pesquisa-float-completo" class="background-blur">
            <div id="painel-pesquisa-titulo">
                <h1>Pesquisa avançada</h1>
            </div>

            <div id="painel-pesquisa-float">
                <form action="imoveis" method="post" id="painel-pesquisa-opcoes">
                    @csrf
                    <p>Tipo de imóvel</p>
                    <select name="id_tp_produto" id="" class="input-text">
                        <option value="Todos" seleced>Todos</option>
                        <option value="1">Terreno</option>
                        <option value="2">Casa</option>
                        <option value="3">Apartamento</option>
                        <option value="4">Chácara</option>
                    </select>
                    <div class="input-search-group">
                        <p>Código do imóvel</p>
                        <input type="text" name="cod_imovel" class="input-text" id="painel-titulo" placeholder="Código do imóvel">
                        <p>Título do imóvel</p>
                        <input type="text" name="titulo" class="input-text" id="painel-titulo" placeholder="Pesquisar imóvel">
                        <p>Cidade:</p>
                        <input type="text" name="cidade" id="painel-local-lateral" class="input-text" placeholder="Pesquisar cidade">
                        <p>Bairro:</p>
                        <input type="text" name="bairro" id="painel-local-lateral" class="input-text" placeholder="Pesquisar bairro">
                    </div>

                    <p>Tipo de contrato</p>
                    <select name="tp_contrato" id="" class="input-text">
                        <option value="Todos" selected>Todos</option>
                        <option value="Aluguel">Aluguel</option>
                        <option value="Venda">Venda</option>
                    </select>


                    <p class="search-title input-title ">Quantidade de quartos</p>
                    <div class="radio-options search-body">
                        <div class="radio-option">
                            <input type="radio" name="qtdQuartos" id="" value="1"> <label
                                for="">1</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="qtdQuartos" id="" value="2"> <label
                                for="">2</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="qtdQuartos" id="" value="3"> <label
                                for="">3+</label>
                        </div>
                    </div>

                    <p class="search-title input-title ">Quantidade de banheiros</p>
                    <div class="radio-options search-body" >
                        <div class="radio-option">
                            <input type="radio" name="qtdBanheiros" id="" value="1"> <label
                                for="">1</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="qtdBanheiros" id="" value="2"> <label
                                for="">2</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="qtdBanheiros" id="" value="3"> <label
                                for="">3+</label>
                        </div>
                    </div>
                    <p class="search-title input-title ">Quantidade de vagas</p>
                    <div class="radio-options search-body">
                        <div class="radio-option">
                            <input type="radio" name="vagas" id="" value="1"> <label
                                for="">1</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="vagas" id="" value="2"> <label
                                for="">2</label>

                        </div>
                        <div class="radio-option">
                            <input type="radio" name="vagas" id="" value="3"> <label
                                for="">3+</label>
                        </div>
                    </div>
                    <p class="search-title input-title ">Valor</p>
                    <div class="radio-options-column search-body">
                        <div class="radio-option">
                            <input type="radio" name="valor" id="" value="1"> <label
                                for="">Até
                                R$100.000</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="valor" id="" value="2"> <label
                                for="">Entre
                                R$100.000 e R$300.000</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="valor" id="" value="3"> <label
                                for="">Mais
                                que R$300.000</label>
                        </div>
                    </div>
                    <p class="search-title input-title ">Area</p>
                    <div class="radio-options-column search-body">
                        <div class="radio-option">
                            <input type="radio" name="area" id="" value="1"> <label
                                for="">Até
                                150m<sup>2</sup></label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="area" id="" value="2"> <label
                                for="">Entre
                                150m<sup>2</sup> e 250m<sup>2</sup></label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" name="area" id="" value="3"> <label
                                for="">Mais
                                que 250m<sup>2</sup></label>
                        </div>
                    </div>
                    <button type="submit" class="busca-painel-btn">Procurar</button>
                </form>
            </div>
        </div>

        <div id="pesquisa-result" class="background-blur">
            @if (session('search') != null and session('search') != 'sem filtro' )
                <div id="filtros-container">
                        <h1>Filtros:</h1>
                        @foreach ($filtro as $item)
                        <div class="filtro-content">
                            {{ $item[0] }}: {{ $item[1] }}
                                <form action="/limparFiltroIndidual" method="post">
                                    @csrf
                                    <input type="hidden" name="filtro" value="{{ $item[0] }}">
                                    <button type="submit">X</button>
                                </form>
                            </div>
                        @endforeach

                        <form action="/limparFiltro" method="post">
                            @csrf
                            <button type="submit">Limpar Todos</button>
                        </form>
                </div>
            @endif

            <div id="lista-produtos">
                @foreach ($imoveis as $item)
                @if ($item->id != 0)
                <div class="produto-container">
                            <span id="tipo-imovel">{{ $item->descricao }}</span>
                            <div class="produto-imagem">
                                @foreach ($imagens as $path)
                                    @if ($item->id == $path->chave)
                                        <div class="img" style="background-image: url('{{ asset($path->path) }}')"></div>
                                        @break
                                    @endif
                                @endforeach
                            </div>
                            <p class="">{{ $item->cod_imovel }}</p>
                            <p class="produto-titulo">{{ $item->titulo }}</p>
                            <p class="produto-descricao"><span class="material-symbols-outlined">location_on</span> <span class="produto-descricao-texto">{{ $item->cidade }}</span> </p>
                            <div class="produto-dados">

                                @if ($item->qtdDorms != 0)
                                <p id="dados-dorms"><span class="material-symbols-outlined">bed</span>{{ $item->qtdDorms }}</p>
                                @endif

                                @if ($item->qtdBanheiros != 0)
                                    <p id="dados-banheiros"><span class="material-symbols-outlined">bathtub</span>{{ $item->qtdBanheiros }}</p>
                                @endif
                                @if ($item->qtdSuites != 0)
                                    <p id="dados-suites"><span class="material-symbols-outlined">king_bed</span><span class="material-symbols-outlined">bathtub</span>{{ $item->qtdSuites }}</p>
                                @endif
                                @if ($item->qtdGaragemCobertas != 0)
                                    <p id="dados-vagas"><span class="material-symbols-outlined">garage</span><span class="material-symbols-outlined">garage_home</span>{{ $item->qtdGaragemCobertas }}</p>
                                @endif
                                @if ($item->qtdGaragemNaoCobertas != 0)
                                    <p id="dados-vagasDescobertas"><span class="material-symbols-outlined">garage</span>{{ $item->qtdGaragemNaoCobertas }}</p>
                                @endif
                                @if($item->tp_contrato == 'Aluguel')
                                    <p id="dados-locacao">Locação</p>
                                @else
                                    <p id="dados-locacao">Venda</p>
                                @endif
                                <p class="produto-valor item-area">{{ $item->areaConstruida }}m²</p>
                                @if ($item->vendidoAlugado == null)
                                    @if ($item->valorVenda == '')
                                        <p id="dados-valor" class="num-format troca-ponto">R${{ $item->valorVenda}}</p>
                                    @endif

                                    @if ($item->valorVenda == '')
                                        <p id="dados-valor" class="num-format troca-ponto">R${{ $item->valorAluguel}}</p>
                                    @endif
                                @else
                                    <p id="dados-valor" class="num-format troca-ponto">INDISPONÍVEL</p>
                                @endif
                            </div>
                            <form action="/imoveis/{{ $item->id }}" class="botao-detalhes" method="post">
                                @csrf
                                <input type="hidden" name="idImovel">
                                <button class="produto-saber-mais" type="submit">Detalhes</button>
                            </form>
                        </div>
                    @else
                    <div class="alert alert-success flash-message">
                        <p>Nenhum item encontrado com esse titulo</p>
                    </div>
                    @endif
                    @endforeach
            </div>
            <form action="/maisItens" method="post" id="mais-itens">
                @csrf
                <input type="hidden" name="mostrarMais" value="2">
                <button id="btn-mostrar-mais">Mostrar mais</button>
            </form>
        </div>
</div>
<img src="{{ asset('img/pesquisa.svg') }}" alt="" id="mobile-buscar" onclick="abrirPainel()" class="background-blur">
<script src="{{ asset('js/mostrarPainel.js') }}"></script>
<script src="{{ asset('js/numformat.js') }}"></script>

<script>
    const imoveis_desc_list = document.getElementsByClassName('produto-descricao-texto')
    const imoveis_title_list = document.getElementsByClassName('produto-titulo')

    // console.log(widthLowerThan(600))
    if (!widthLowerThan(600)) {
        lim = 5
    }
    else {
        lim = 8
    }


    function limitarStringPorPalavras(str, numeroPalavras) {
        const palavras = str.split(' ');
        const palavrasLimitadas = palavras.slice(0, numeroPalavras);
        return palavrasLimitadas.join(' ');
    }
    function widthLowerThan(largura) {
        if (window.screen.availWidth > largura) { return true }
        else return false
    }

    for(i=0; i<imoveis_desc_list.length; i++) {

        if(imoveis_desc_list[i].innerHTML.length > lim) {

            imoveis_desc_list[i].innerHTML = limitarStringPorPalavras(imoveis_desc_list[i].innerHTML , lim) + "...";
        }

    }
    for(i=0; i<imoveis_title_list.length; i++) {

        if(imoveis_title_list[i].innerHTML.length > lim) {

            imoveis_title_list[i].innerHTML = limitarStringPorPalavras(imoveis_title_list[i].innerHTML , lim) + "...";
        }

    }

    // Caso área esteja zerada:
    let areas = document.getElementsByClassName('item-area')

    for(item of areas) {
        if(item.innerHTML == '0m²') {
            item.style.display = 'none'
        }
    }

</script>

<script>
    trocaPonto()

</script>

@endsection
