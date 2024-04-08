@extends('layouts.layout_navbar')

@section('title','Imobiliária Eunice')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">

<link rel="stylesheet" href="{{ asset('css/pagina-principal.css') }}">
<script src="{{ asset('js/reload.js') }}"></script>
<script src="{{ asset('js/caroselDestaque.js') }}"></script>
<script src="{{ asset('js/numformat.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,1,-25" />

<div id="error">
    <h1 class="error-msg">O que você procura não está aqui!</h1>
    <p class="error-txt">Volte a navegar</p>
</div>

<div class="options">
    <a href="/" class="option">Página principal</a>
    <a href="/imoveis" class="option">Imóveis</a>
    <a href="/contato" class="option">Contato</a>
</div>
</section>

<style>
    #error {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .options{
        display: flex;
        justify-content: center;
        gap: 1rem;  
    }
</style>

<!--
@if(session('email'))
    <div class="alert alert-success flash-message">
        {{ session('email') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 -->

 <script>
    const imoveis_desc_list = document.getElementsByClassName('endereco-localidade')
    const imoveis_title_list = document.getElementsByClassName('endereco-info-tipo')

    if (!widthLowerThan(600)) {
        lim = 10
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

</script>

<script>
    trocaPonto()
</script>

@endsection
