@extends('layouts.font_import')

@section('title','Cadastro')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<button id="voltar-btn" onclick="window.location.href = '/'"><span class="material-symbols-outlined">undo</span></button>
    <div class="login-container">
        <form action="cadastro" class="register-content" method="POST">
            @csrf

            <img src="{{ asset('img/icone.png') }}" alt="" class="icone">

            <h1>CADASTRE-SE</h1>
            <p>Por favor, forneça todas as informações necessárias para concluir o cadastro.</p>

            <div class="registro-input-layout">
                <input type="text" autocomplete="off" name="nome" id="cadastro-nome" class="input-reg" placeholder="Insira seu nome">
                <input type="tel" autocomplete="off" name="telefone" id="cadastro-celular" placeholder="12 999999999" class="input-reg" maxlength="12" required>
            </div>

            <div class="registro-input-layout">
                <input type="email" autocomplete="off" id="email" class="input-reg" placeholder="Insira seu email" name="email" required>
                <input type="email" autocomplete="off" id="email_conf" class="input-reg" placeholder="Confirme seu email" name="email_conf" required>
            </div>

            <div class="registro-input-layout">
                <input type="password" autocomplete="off" id="cadastro-senha" class="input-reg" placeholder="Insira sua senha" name="senha" require>
                <input type="password" autocomplete="off" id="cadastro-conf-senha" class="input-reg" placeholder="Confirme sua senha" name="confirmSenha" require>
            </div>

            <button id="btn-registrar" class="btn-reg">CADASTRAR</button>

            @if($erro)
                <div class="alert alert-danger">
                    {{ $erro }}
                </div>
            @endif

        </form>
    </div>

@endsection
