@extends('layouts.font_import')

@section('title','Gerenciador de imóveis')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">

<link rel="stylesheet" href="{{ asset('css/manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/reload.js') }}"></script>
<script src="{{ asset('js/numformat.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div id="imovel-header">
    <p id="hello-user">Olá, {{ $usuario->name }}</p>
    <section id="header-botoes">
        <button class="nav-btn" id="novo-imovel" onclick="window.location.href='/admin/cadastrar'">Adicionar</button>

        <select name="opcao" class="nav-btn" id="dropdown">
            <option value="" selected disabled>Menu</option>
            <option value="" data-url="/">Home</option>
            <option value="" data-url="/admin/contatos">Requisições</option>
            <option value="" data-url="/admin/editUsuario">Perfil</option>
            <option value="" data-url="/cadastro">Cadastrar usuário</option>
            <option value="" data-url="/admin/clientes">Página de clientes</option>
            <option value="" data-url="/logout">Sair</option>

        </select>

        <form action="logout" method="POST">
            @csrf
            <button class="nav-btn" id="sair" type="submit" style="display: none"></button>
        </form>
    </section>

</div>

<div id="pesquisa"> {{--div pai--}}
    <form action="admin" method="post">
        @csrf
        <div class="search-container"> {{--div filho--}}
            <input type="text" name="search" id="search" placeholder="Pesquisar imóvel">
            <button type="submit" id="search-button"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

@if($itens)
<div id="imoveis-lista">
    @foreach($itens as $item)
    <div class="imovel-container">
        <div class="imovel-content">
            <section id="content-num-001" class="content-info">
                @if($paths[0]->chave != 0)
                @foreach ($paths as $path)
                @if($item->id == $path->chave)
                <div class="img produto-item-flex" style="background-image: url('{{asset($path->path)}}')"></div>
                @endif
                @endforeach
                @endif

                <section id="informacoes" class="produto-item-flex">
                    <p id="imovel-titulo" style="color: gray; margin-bottom: 7px;">{{ $item->cod_imovel }}</p>
                    <p id="imovel-titulo">{{ $item->titulo }}</p>
                    <p id="imovel-descricao" class="imovel-descricao">{{ $item->descricao }}</p>
                    @if($item->tp_contrato == "Venda")
                        <p id="imovel-valor">R$ <span class="num-format troca-ponto">{{ $item->valorVenda}}</span></p>
                    @elseif($item->tp_contrato == "Aluguel")
                        <p id="imovel-valor">R$ <span class="num-format troca-ponto">{{ $item->valorAluguel }}</span></p>
                    @else
                        <p id="imovel-valor">R$ <span class="num-format troca-ponto">{{ $item->valorVenda }}</span> / R$<span class="num-format troca-ponto">{{ $item->valorAluguel }}</span></p>
                    @endif
                </section>

                <section id="imovel-botoes" class="produto-item-flex">

                    <form action="admin/edit/{{ $item->id }}" method="post" id="imovel-editar" class="imovel-btn">
                        @csrf
                        <button type="submit" id="imovel-editar-btn" class="imovel-btn"><span class="btn-texto">Editar</span></button>
                    </form>


                    <form action="/admin/vendidoAlugado/{{ $item->id }}" method="POST" id="form-vender">
                        @csrf

                        @if($item->vendidoAlugado != null)
                        <input type="text" name="type" value="1" style="display: none">
                        <button type="submit" id="disable-vender" class="imovel-btn disable-venda">INDISPONÍVEL</button>
                        @else
                        <button type="submit" id="imovel-vender" class="imovel-btn">Vender/alugar</button>
                        @endif

                    </form>

                    <button id="imovel-remover" onclick="excluir(this);" class="imovel-btn"><span class="btn-texto">Remover</span></button>
                    <form action="/deletar/{{ $item->id }}" method="POST" style="display:none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="remover" class="imovel-btn" style="display: none"></button>
                    </form>

                    <form action="/admin/desVenderAlugar/{{ $item->id }}" method="post">
                        @csrf
                        <button type="submit" style="display: none"></button>
                    </form>


                </section>
            </section>
        </div>
    </div>
    @endforeach
</div>
@endif


{{-- <div id="conteudo">
    <p>{{ $item->id }}</p>
<p>{{ $item->descricao }}</p>
<p>{{ $item->area }}</p>
</div> --}}


@if(session('success'))
<div class="alert alert-success" id="flash-message">
    {{ session('success') }}
</div>
@endif

@if(session('editado'))
<div class="alert alert-success" id="flash-message">
    {{ session('editado') }}
</div>
@endif

@if(session('excluir'))
<div class="alert alert-success" id="flash-message">
    {{ session('excluir') }}
</div>
@endif

@if(session('vendidoAlugado'))
<div class="alert alert-success" id="flash-message">
    {{ session('vendidoAlugado') }}
</div>
@endif

<script src="{{ asset('js/check-scroll.js') }}"></script>
<script src="{{ asset('js/dropDown.js') }}"></script>

<script>
    const imoveis_desc_list = document.getElementsByClassName('imovel-descricao')
    if (!widthLowerThan(600)) {
        lim = 10
    } else {
        lim = 20
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

    for (i = 0; i < imoveis_desc_list.length; i++) {

        if (imoveis_desc_list[i].innerHTML.length > lim) {

            imoveis_desc_list[i].innerHTML = limitarStringPorPalavras(imoveis_desc_list[i].innerHTML, lim) + "...";
        }

    }
</script>

<script>
    trocaPonto()
</script>
