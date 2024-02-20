@extends('layouts.layout_navbar')

@section('title','Contato')

@section('content')

<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">
<link rel="stylesheet" href="{{ asset('css/contato.css') }}">

    <div id="modalContato" class="contato-container">
        <div id="contato-titulo">
            <h1 class="contato-title">Fale conosco!</h1>
        </div>

        <form action="/contato" method="POST" id="contato-content" autocomplete="off">
            @csrf
            <input type="text" name="nome" id="" class="contato-input" placeholder="nome" required>
            <input type="text" name="telefone" id="" class="contato-input" placeholder="telefone" required>
            <input type="email" name="email" id="" class="contato-input" placeholder="email">
            
            <select name="motivo" id="" class="contato-motivo contato-input">
                <option value="Compra" class="contato-option">Comprar</option>
                <option value="Venda" class="contato-option">Alugar</option>
                <!-- <option value="Anuncio" class="contato-option">Anuncio</option> -->
            </select>
            
            <input type="text" name="cod_imovel_form" id="" class="contato-input" placeholder="Código do imóvel" required>

            <textarea name="mensagem" id="" cols="30" rows="10" class="contato-input" style="resize:none" placeholder="mensagem" required></textarea>
            <button type="submit" class="contato-enviar">Enviar</button>

            <div id="divisor">
                <hr>
                <p>ou</p>
                <hr>
            </div>

            <a href="https://wa.me/5512991852310" target="_blank" style="text-align: center; text-decoration: none;" class="contato-enviar-whatsapp">Fale por Whatsapp</a>
        </form>
    </div>

@endsection