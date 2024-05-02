@extends('layouts.font_import')

@section('title','Cadastrar Cliente')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">
<link rel="stylesheet" href="{{ asset('css/request.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div id="popup-informacoes" style="display:none">
    <button id="btn-popup-fechar" onclick="fecharInfo()">X</button>
    <h1>Informações</h1>
    <div class="cliente-dados">
        <div class="cliente-dados-container">
            <p class="dados-info" id="dados-id" style="display: none">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Nome</p>
            <p class="dados-info" id="dados-nome">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Email</p>
            <p class="dados-info" id="dados-email">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Telefone</p>
            <p class="dados-info" id="dados-telefone">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Finalidade</p>
            <p class="dados-info" id="dados-finalidade">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Tipo do imóvel</p>
            <p class="dados-info" id="dados-tipoImovel">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Endereço</p>
            <p class="dados-info" id="dados-endereco">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Valor</p>
            <p class="dados-info" id="dados-valor">XXXXXX</p>
        </div>
        <div class="cliente-dados-container">
            <p class="dados-title">Mensagem</p>
            <p class="dados-info" id="dados-mensagem">XXXXXX</p>
        </div>

    </div>
    <div class="cliente-botoes">
        <button title="Apaga o contato da lista, use caso já tenha resolvido" class="cliente-btn" id="cliente-apagar" onclick="deletar(event)">Apagar</button>
        <button title="Marca o contato como solucionado, mas não o apaga da lista" class="cliente-btn" id="cliente-solucionar" onclick="solucionar(event)">Solucionar</button>
    </div>
</div>

<form action="\admin\clientes\solucionar" method="post" style="position: absolute;">
    @csrf
    <input type="hidden" id="solucionar" name="solucionar">
    <button id="btn-solucionar" type="submit" style="display: none"></button>
</form>

<form action="\admin\clientes\delete" method="post" style="position: absolute;">
    @csrf
    <input type="hidden" id="deletar" name="deletar">
    <button id="btn-deletar" type="submit" style="display: none"></button>
</form>

    @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }}
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-warning">
            {{ Session::get('success') }}
        </div>
    @endif

    <link rel="stylesheet" href="{{ asset('css/cadastro-cliente.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manager.css') }}">

    <div id="imovel-header">
        <p id="hello-user">Gerenciador de clientes</p>
        <section id="header-botoes">
            <button class="nav-btn" id="novo-imovel" onclick="window.location.href='/admin'">Voltar</button>

            <form action="logout" method="POST">
                @csrf
                <button class="nav-btn" id="sair" type="submit" style="display: none"></button>
            </form>
        </section>
    </div>

    <div id="tab-buttons">
        <button onclick="openTab(0,'block')" class="tab-button tab-selected">Cadastro</button>
        <button onclick="openTab(1,'block')" class="tab-button tab-unselected">Clientes</button>
        <button onclick="openTab(2,'block')" class="tab-button tab-unselected">Anuncio</button>
    </div>

    <div id="tabs">
        <section id="aba-cadastro">
            <form action="clientes" method="post" autocomplete="off" id="cadastro-cliente">
                <img src="{{ asset('img/watermark.png') }}" alt="" style="width:150px">
                @csrf

                <input type="text" name="nome" id="nome" placeholder="Insira o nome" class="cliente-input" required>
                <input type="text" name="email" id="email" placeholder="Insira o email" class="cliente-input" required>
                <input type="text" name="telefone" id="telefone" placeholder="Insira o telefone" class="cliente-input" required>
                <select name="tp_cliente" class="cliente-input cliente-btn" id="tipo-form">
                    <option value="proprietario">Proprietario</option>
                    <option value="cliente">Cliente</option>
                </select>
                <input type="text" name="data_contato_atendimento" id="idData-atendimento" placeholder="Data de atendimento" class="cliente-input">
                <input type="text" name="data_contato_captacao" id="idData-captacao" placeholder="Data de captacao" class="cliente-input">
                <input type="text" name="cod_imovel" id="idImovel" placeholder="Insira o código do Imovel" class="cliente-input" required>
                <textarea name="comentario" placeholder="Comentário" id="idComentario" class="cliente-input" cols="30" rows="10" style="resize: none;"></textarea>
                <button type="submit" class="cliente-input cliente-btn">Cadastrar</button>
            </form>
        </section>

        <section id="aba-clientes">
            <div class="table-div">
                <div class="input-div">
                    <input type="text" id="searchInput" oninput="searchTable()" placeholder="Pesquisar...">
                </div>
                <table cellspacing="0" id="client-table">

                    <thead class="table-header" cellspacing="0">
                        <!-- <th class="table-title"></th> -->
                        <th class="table-title">Nome <span onclick="sortTable(0)" class="material-symbols-outlined" style="cursor: pointer">swap_vert</span></th>
                        <th class="table-title">Email</th>
                        <th class="table-title">Telefone</th>
                        <th class="table-title">Tipo Cliente</th>
                        <th class="table-title">Código do Imovel</th>
                        <th class="table-title">Data de Captação</th>
                        <th class="table-title">Data de Atendimento</th>
                        <th class="table-title">Comentário</th>

                    </thead>

                    @foreach ($clientes as $cli)
                        <tr class="table-body solved">
                            <td class="body-info divider-left information-{{$cli->id}}" >{{$cli->nome}}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->email }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->telefone }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->tp_cliente }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->cod_imovel }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->dtCaptacao }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->dtAtendimento }}</td>
                            <td class="body-info divider-left information-{{$cli->id}}" >{{ $cli->comentario }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>

        <section id="aba-anuncio">
            <div class="table-div">
                <table cellspacing="0" id="client-table">
                    <thead class="table-header" cellspacing="0">
                        <th class="table-title"></th>
                        <th class="table-title">Nome</th>
                        {{-- <th class="table-title">Email</th> --}}
                        <th class="table-title">Telefone</th>
                        <th class="table-title">Finalidade</th>
                        <th class="table-title">Tipo de imóvel</th>
                        {{-- <th class="table-title">Endereço</th> --}}
                        {{-- <th class="table-title">Valor</th> --}}
                        {{-- <th class="table-title">Observação</th> --}}
                    </thead>

                    @foreach ($anuncios as $anuncio)
                        <tr class="table-body solved_new-{{$anuncio->resolvido}}" style="border-collapse:collapse">
                            <td class="body-info"><button class="button-info" id="information-{{$anuncio->id}}"  onclick="mostrarInfo(event)" >Ver</button></td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" >{{$anuncio->nome}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" style="display: none" >{{$anuncio->email}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" >{{$anuncio->telefone}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" >{{$anuncio->finalidade}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" >{{$anuncio->tpImovel}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" style="display: none" >{{$anuncio->condominio}} - {{$anuncio->endereco}} - {{$anuncio->bairro}} - {{$anuncio->cidade}} </td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" style="display: none">{{$anuncio->valor}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" style="display: none" >{{$anuncio->observacao}}</td>
                            <td class="body-info divider-left information-{{$anuncio->id}}" style="display: none" >{{$anuncio->id}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </section>

    </div>

    <script>
        //carrega as informações e então abre o painel
        function mostrarInfo(event) {
            loadInfo(event);
            const popup = document.getElementById('popup-informacoes')

            popup.style.display = 'flex'

        }

        //fecha o painel
        function fecharInfo() {
            const popup = document.getElementById('popup-informacoes')
            popup.style.display = 'none'
        }

        //carrega as informações
        function loadInfo(event) {
            const client_id = event.target.id

            //arrays
            try {

                const dados_array = [
                    document.getElementById('dados-nome'),
                    document.getElementById('dados-email'),
                    document.getElementById('dados-telefone'),
                    document.getElementById('dados-finalidade'),
                    document.getElementById('dados-tipoImovel'),
                    document.getElementById('dados-endereco'),
                    document.getElementById('dados-valor'),
                    document.getElementById('dados-mensagem')
                ]
                const info_array = document.getElementsByClassName(client_id)

                for(let i=0; i<dados_array.length; i++) {
                    dados_array[i].innerHTML = info_array[i].innerHTML
                }
                document.getElementById('dados-id').innerHTML = event.target.parentElement.parentElement.children[9].innerHTML;
            }
            catch(e) {
                console.log(e)
            }
        }

        function solucionar(event){
            var id = event.target.parentElement.parentElement.children[2].children[0].children[0].innerHTML;
            var button = document.getElementById('btn-solucionar');
            var input = document.getElementById('solucionar');

            input.value = id;
            button.click();
        }

        function deletar(event){
            var id = event.target.parentElement.parentElement.children[2].children[0].children[0].innerHTML;;
            var button = document.getElementById('btn-deletar');
            var input = document.getElementById('deletar');

            input.value = id;
            button.click();
        }

        var direction = "asc";

        function sortTable(colIndex){
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("client-table");
            switching = true;

            while(switching){
                switching = false
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++){
                    shouldSwitch = false
                    x = rows[i].getElementsByTagName("td")[colIndex]
                    y = rows[i + 1].getElementsByTagName("td")[colIndex]

                    if (x && y) {
                        if ((direction == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                            (direction == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())) {

                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if(shouldSwitch){
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i])
                    switching = true;
                }
            }
            direction = (direction == "asc") ? "desc" : "asc";
        }

        function searchTable(){
            var input, filter, table, tr, td, i, j, txtValue
            input = document.getElementById("searchInput")
            filter = input.value.toLowerCase()
            table = document.getElementById("client-table")
            tr = table.getElementsByTagName("tr")

            for (i = 0; i < tr.length; i++){
                td = tr[i].getElementsByTagName("td")

                for(j = 0; j < td.length; j++){
                    if(td[j]){
                        txtValue =  td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        }

    </script>

<script>
    //sistema de abas
    const abas = [
        document.getElementById('aba-cadastro'),
        document.getElementById('aba-clientes'),
        document.getElementById('aba-anuncio')
    ]
    const botoes = document.getElementsByClassName('tab-button')

    openTab(0,'block')

    function clearAll() {
        for(let i=0; i<abas.length; i++)  {
            abas[i].style.display = "none"
        }
    }

    function openTab(index, displayType) {
        clearAll()
        selectTab(index)
        abas[index].style.display = displayType
    }

    //efeito visual na aba
    function selectTab(index) {
        unselectAll()

        botoes[index].classList.replace('tab-unselected','tab-selected')
    }
    function unselectAll() {

        for(i=0; i<botoes.length; i++) {
            botoes[i].classList.replace('tab-selected','tab-unselected')
        }
    }

</script>

<script>
    // Sistema de datas
    const dataTypes = [document.getElementById('idData-captacao'), document.getElementById('idData-atendimento')]

    document.getElementById('tipo-form').addEventListener('change', function()
    {
        if (document.getElementById('tipo-form').value == 'cliente') {
            dataTypes[0].style.display = 'none'
            dataTypes[1].style.display = 'block'
        }
        else if (document.getElementById('tipo-form').value == 'proprietario') {
            dataTypes[0].style.display = 'block'
            dataTypes[1].style.display = 'none'
        }
    })

    if (document.getElementById('tipo-form').value == 'cliente') {
            dataTypes[0].style.display = 'none'
            dataTypes[1].style.display = 'block'
        }
        else if (document.getElementById('tipo-form').value == 'proprietario') {
            dataTypes[0].style.display = 'block'
            dataTypes[1].style.display = 'none'
        }

</script>

@endsection
