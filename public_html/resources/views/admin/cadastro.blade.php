@extends('layouts.font_import')

@section('title','Cadastrar produto')

@section('content')
<link rel="stylesheet" href="{{ asset('css/font-standards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cadastro-imovel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/imagem.js') }}"></script>
    <script src="{{ asset('js/numformat.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <button id="btn-voltar" onclick="window.location.href = '/admin'">Voltar</button>

    <div id="titleAdicionar">
        <h2>Adicionar</h2>
    </div>

    <div id="abas">
        <button id="btn-aba-casa" onclick="openCasa()" class="aba-option">Casa/Ap/Chácara</button>
        <!-- <button id="btn-aba-apartamento" onclick="openApartamento()" class="aba-option">Pt. Comercial</button> -->
        <button id="btn-aba-terreno" onclick="openTerreno()" class="aba-option">Terreno</button>
    </div>

    <form id="adicionar-casa-container" class="add-layout" action="cadastrar" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <!-- <input type="hidden" name="id_produto" value="2" > -->

        <p style="font-size: 20px !important;">Destaque</p>
        <div class="check-item">
            <div class="toggle-container">
                <input type="checkbox" name="destaque" id="toggle" class="checkbox-input">
                <label for="toggle" class="toggle"></label>
            </div>
        </div>

        <p for="" id="titulo-label" class="add-label">Título</p>
        <input type="text" id="casa-titulo-input" name="titulo" class="add-input" required>

        <p>Tipo do imóvel</p>
        <select name="id_produto" id="tipo-produto-ddl" class="add-input">
            <option value="2" selected>Casa</option>
            <option value="3">Apartamento</option>
            <option value="4">Chácara</option>
        </select>

        <p>Em condomínio</p>
        <select name="em_conominio" id="tipo-produto-ddl" class="add-input">
            <option value="sim" selected>Sim</option>
            <option value="nao" selected>Não</option>
        </select>

        <p for="" id="desc-label" class="add-label">Descrição</p>
        <textarea name="descricao" id="casa-desc-input" cols="30" rows="10" class="add-input" required></textarea>

        <p id="qtd-banheiros-label" class="slider-label">Quantidade de banheiros:</p>
        <input type="number" name="qtd_banheiros" min="0" max="20" value="1" id="sliderBanheiro" class="add-input" required>

        <p id="qtd-banheiros-label" class="slider-label">Quantidade de suites:</p>
        <input type="number" name="qtd_suites" min="0" max="20" value="1" id="sliderSuite" class="add-input" required>

        <!--<p id="qtd-quartos-label" class="slider-label">Quantidade de quartos:</p>-->
        <!--<input type="number" name="qtd_quartos" min="0" max="20" value="1" id="sliderQuartos" class="add-input" required>-->

        <p id="qtd-vagas-label" class="slider-label">Quantidade de Garagem com Cobertura:</p>
        <input type="number" name="qtdGaragemCobertas" min="0" max="20" value="1" id="sliderVagas" class="add-input" required>

        <p id="qtd-vagas-label" class="slider-label">Quantidade de Garagem sem Cobertura:</p>
        <input type="number" name="qtdGaragemNaoCobertas" min="0" max="20" value="1" id="sliderVagasNaoCoberto" class="add-input" required>

        <p id="qtd-salas-label" class="slider-label">Quantidade de Salas:</p>
        <input type="number" name="qtdSalas" min="0" max="20" value="1" id="sliderSalas" class="add-input" required>

        <p id="qtd-dorms-label" class="slider-label">Quantidade de Dormitórios:</p>
        <input type="number" name="qtdDorms" min="0" max="20" value="1" id="sliderDorms" class="add-input" required>

        <p id="qtd-vagas-label" class="slider-label">Quantidade de Sacadas:</p>
        <input type="number" name="qtdSacadasCobertas" min="0" max="50" value="1" id="sliderVagasCasa" class="add-input">

        <p id="qtd-num_andares-label" class="slider-label">Número de andares:</p>
        <input type="number" name="qtdNumAndares" min="0" max="50" value="1" id="sliderNumAndares" class="add-input">

        <p id="qtd-num_andar-label" class="slider-label">Número do andar:</p>
        <input type="number" name="qtdAndar" min="0" max="50" value="1" id="sliderNumAndar" class="add-input">

        <p id="local-label">Cidade</p>
        <input name="cidade" type="text" id="casa-local-input" class="add-input" required>

        <p id="local-label">Bairro</p>
        <input name="bairro" type="text" id="casa-local-input" class="add-input" required>

        <p id="local-label">Rua e Numero</p>
        <input name="ruaNumero" type="text" id="casa-local-input" class="add-input" required>

        <p id="local-label">CEP</p>
        <input name="cep" maxlength="8" minlength="8" type="text" id="casa-local-input" min="1" class="add-input" oninput="formatarCEP(this)" required>

        <p id="tam-area-label">Tamanho da área (m<sup>2</sup>)</p>
        <input name="area" type="text" id="casa-tam-area-input" min="1" class="add-input input-format" step=".01" lang="pt-BR">

        <p id="tam-area-label">Tamanho da área util (m<sup>2</sup>)</p>
        <input name="areaUtil" type="text" id="casa-tam-area-input" min="1" class="add-input input-format" step=".01" lang="pt-BR">

        <p id="tam-area-label">Tamanho da área construída (m<sup>2</sup>)</p>
        <input name="areaConstruida" type="text" id="casa-tam-area-input" min="1" class="add-input input-format" step=".01" lang="pt-BR">

        <p id="tam-area-label">Tamanho da área do terreno (m<sup>2</sup>)</p>
        <input name="areaTerreno" type="text" id="casa-tam-area-input" min="1" class="add-input input-format" step=".01" lang="pt-BR">

        <p>Aluguel ou Venda</p>
        <select name="aluguel_venda" id="aluguel_venda" class="add-input" required>
            <option value="Aluguel">Aluguel</option>
            <option value="Venda">Venda</option>
            <option value="Aluguel/Venda">Aluguel/Venda</option>
        </select>


        <input type="text" name="valor-aluguel" id="valor-aluguel" class="add-input input-format" step=".01" lang="pt-BR"  placeholder="Valor de aluguel" required style="margin-top:">

        <input type="number" name="valor-venda" id="valor-venda" class="add-input input-format" step=".01" lang="pt-BR" placeholder="Valor de venda" required style="margin-top:">

        <p id="valor-label">Valor condominio</p>
        <input type="number" name="valorCondominio" id="casa-valor-input" class="add-input input-format" lang="pt-BR" step=".01">

        <p id="valor-label">IPTU mensal</p>
        <input type="text" name="iptu" id="casa-valor-input" class="add-input input-format" lang="pt-BR" step=".01">

        <p id="valor-label">Caracterísitcas do imóvel</p>
        <div class="checkbox">
            <div class="check-item">
                <input type="checkbox" name="elevadores" id="elevadores"><label for="elevadores">Elevador</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="agua" id="agua"><label for="agua">Agua</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="energia" id="energia"><label for="energia">Energia</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="mesanino" id="mesanino"><label>Mezanimo</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="esgoto" id="esgoto"><label for="esgoto">Esgoto</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="murado" id="murado"><label for="murado">Murado</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="pavimentacao" id="pavimentacao"><label for="pavimentacao">Pavimentação</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="gasEncanado" id="gasEncanado"><label for="gasEncanado">Gás encanado</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="entradaServico" id="entradaServico"><label for="entradaServico">Entrada de serviço</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="areaServico" id="areaServico"><label for="areaServico">Área de serviço</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="banheiroEmpregada" id="banheiroEmpregada"><label for="banheiroEmpregada">Banheiro Empregada</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="cozinha" id="cozinha"><label for="cozinha">Cozinha</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="cozinhaPlanejada" id="cozinhaPlanejada"><label for="cozinhaPlanejada">Cozinha Planejada</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="copa" id="copa"><label for="copa">Copa</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="despensa" id="despensa"><label for="despensa">Despensa</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="lavanderias" id="lavanderias"><label for="lavanderias">Lavanderia</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="guarita" id="guarita"><label for="guarita">Guarita</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="varanda" id="varanda"><label for="varanda">Varanda</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="varandaGourmet" id="varandaGourmet"><label for="varandaGourmet">Varanda Gourmet</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="cozinhaConjugada" id="cozinhaConjugada"><label for="cozinhaConjugada">Cozinha conjugada</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="pisoFrio" id="pisoFrio"><label for="pisoFrio">Piso Frio</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="porcelanato" id="porcelanato"><label for="porcelanato">Porcelanato</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="lavado" id="lavado"><label for="lavado">Lavabo</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="roupeiro" id="roupeiro"><label for="roupeiro">Roupeiro</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="suiteMaster" id="suiteMaster"><label for="suiteMaster">Suite Master</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="closet" id="closet"><label for="closet">Closet</label>
            </div>
            <!--<div class="check-item">-->
            <!--    <input type="checkbox" name="entradaServico" id="entradaServico"><label for="entradaServico">Entrada de serviço</label>-->
            <!--</div>-->
            <div class="check-item">
                <input type="checkbox" name="escritorio" id="escritorio"><label for="escritorio">Escritorio</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="jardim" id="jardim"><label for="jardim">Jardim</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="moveisPlanejados" id="moveisPlanejados"><label for="moveisPlanejados">Moveis planejados</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="portaoEletronico" id="portaoEletronico"><label for="portaoEletronico">Portão eletronico</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="porteiroEletronico" id="porteiroEletronico"><label for="porteiroEletronico">Porteiro eletronico</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="areaLazer" id="areaLazer"><label for="areaLazer">Área de lazer</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="tvCabo" id="tvCabo"><label for="tvCabo">TV a Cabo</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="arCondicionado" id="arCondicionado"><label for="arCondicionado">Ar Condicionado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="aguaSolar" id="aguaSolar"><label for="aguaSolar">Agua Aquecida por Energia Solar</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="mobiliado" id="mobiliado"><label for="mobiliado">Mobiliado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="depEmpregados" id="depEmpregados"><label for="depEmpregados">Dep. Empregados</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="lareira" id="lareira"><label for="lareira">Lareira</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="caseiro" id="caseiro"><label for="caseiro">Caseiro</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="edicula" id="edicula"><label for="edicula">Edícula</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="sacada" id="sacada"><label for="sacada">Sacada</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="piscinaCondominio" id="piscinaCondominio"><label for="piscinaCondominio">Piscina Condomínio</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="terraco" id="terraco"><label for="terraco">Terraço</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="hidromassagem" id="hidromassagem"><label for="hidromassagem">Hidromassagem</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="vagaFixa" id="vagaFixa"><label for="vagaFixa">Vaga Fixa</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="dormEmpregado" id="dormEmpregado"><label for="dormEmpregado">Dorm. de empregados</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="carpeteAcri" id="carpeteAcri"><label for="carpeteAcri">Carpete de acrilico</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="carpeteMadeira" id="carpeteMadeira"><label for="carpeteMadeira">Carpete de madeira</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="carpeteNylon" id="carpeteNylon"><label for="carpeteNylon">Carpete de nylon</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="corredor" id="corredor"><label for="corredor">Corredor</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="vagaRotativa" id="vagaRotativa"><label for="vagaRotativa">Vaga Rotativa</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="jardimInverno" id="jardimInverno"><label for="jardimInverno">Jardim de Inverno</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="closet" id="closet"><label for="closet">Closet</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoAquecido" id="pisoAquecido"><label for="pisoAquecido">Piso Aquecido</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoArdosia" id="pisoArdosia"><label for="pisoArdosia">Piso Ardosia</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoBioquete" id="pisoBioquete"><label for="pisoBioquete">Piso Bioquete</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoCarpete" id="pisoCarpete"><label for="pisoCarpete">Piso Carpete</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoCeramica" id="pisoCeramica"><label for="pisoCeramica">Piso cerâmica</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoCimentoQueimado" id="pisoCimentoQueimado"><label for="pisoCimentoQueimado">Piso Cimento Queimado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoEmborrachado" id="pisoEmborrachado"><label for="pisoEmborrachado">Piso Emborrachado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoTacoMadeira" id="pisoTacoMadeira"><label for="pisoTacoMadeira">Piso de Taco de Madeira</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="contraPiso" id="contraPiso"><label for="contraPiso">Contra Piso</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="pisoTabua" id="pisoTabua"><label for="pisoTabua">Piso de Tábua</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="granito" id="granito"><label for="granito">Granito</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="laminado" id="laminado"><label for="laminado">Piso Laminado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="marmore" id="marmore"><label for="marmore">Mármore</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioCozinha" id="armarioCozinha"><label for="armarioCozinha">Armário Cozinha</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioCorredor" id="armarioCorredor"><label for="armarioCorredor">Armário Corredor</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioCloset" id="armarioCloset"><label for="armarioCloset">Armário Closet</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioQuarto" id="armarioQuarto"><label for="armarioQuarto">Armário Quarto</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioBanheiro" id="armarioBanheiro"><label for="armarioBanheiro">Armário Banheiro</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioSala" id="armarioSala"><label for="armarioSala">Armário Sala</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioEscritorio" id="armarioEscritorio"><label for="armarioEscritorio">Armário Escritório</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioDepEmp" id="armarioDepEmp"><label for="armarioDepEmp">Armário Dep. Empregado</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="armarioAreaServico" id="armarioAreaServico"><label for="armarioAreaServico">Armário Área de Serviço</label>
            </div>

            <div class="check-item">
                <input type="checkbox" name="salaCinema" id="salaCinema"><label for="salaCinema">Sala de Cinema</label>
            </div>
        </div>

        <p id="valor-label">Características da área comum</p>
        <div class="checkbox">
            <div class="check-item">
                <input type="checkbox" name="churrasqueira" id="churrasqueira"><label for="churrasqueira">Churrasqueira</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="adega" id="adega"><label for="adega">Adega</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="quadra" id="quadra"><label for="quadra">Quadra Esportiva</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="sauna" id="sauna"><label for="sauna">Sauna</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="vestiario" id="vestiario"><label for="vestiario">Vestiário</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="campFut" id="campFut"><label for="campFut">Campo de Futebol</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="quintal" id="quintal"><label for="quintal">Quintal</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="piscina" id="piscina"><label for="piscina">Piscina</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaJogos" id="salaJogos"><label for="salaJogos">Sala de Jogos</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaFestas" id="salaFestas"><label for="salaFestas">Salão de Festas</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaGinastica" id="salaGinastica"><label for="salaGinastica">Sala de Ginástica</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="playground" id="playground"><label for="playground">Playground</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="portaria24" id="portaria24"><label for="portaria24">Portaria 24h</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="estacionamentoVisita" id="estacionamentoVisita"><label for="estacionamentoVisita">Estacionamento para Visita</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="portaoEletronico" id="portaoEletronico"><label for="portaoEletronico">Portão eletronico</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="alarme" id="alarme"><label for="alarme">Alarme</label>
            </div>
        </div>

        <p id="local-label">Informações extras (separar por ponto e vírgula)</p>
        <input name="extraInfo" type="text" id="casa-local-input" class="add-input" maxlength="3000">

        <hr class="cadastro-divisor">

        <p id="imagem-label">Imagem <span class="image-warning">(Adicionar todas as imagens de uma vez)</span></p>
        <input type="file" name="imagem[]" id="imagemCasa" multiple required>

        <input type="file" name="imagemCasaPrincipal" id="imagemCasaPrincipal" style="display: none" required>

        <div id="imagePreviewCasa"></div>

        <div class="divBtnEnviar">
            <button type="submit" id="btn-casa-enviar" class="btn-add-prod">SALVAR</button>
        </div>
    </form>

<!-- TERRENO -->
    <form id="adicionar-terreno-container" class="add-layout" action="cadastrar" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <input type="hidden" name="id_produto" value="1">

        <p style="font-size: 20px !important;">Destaque</p>
        <div class="check-item">
            <div class="toggle-container">
                <input type="checkbox" name="destaque" id="toggle" class="checkbox-input">
                <label for="toggle" class="toggle"></label>
            </div>
        </div>

        <p for="" id="titulo-label" class="add-label">Título</p>
        <input name="titulo" type="text" id="trn-titulo-input" class="add-input" required>

        <p for="" id="desc-label" class="add-label">Descrição</p>
        <textarea name="descricao" id="trn-desc-input" cols="30" rows="10" class="add-input" required></textarea>

        <p id="local-label">Cidade</p>
        <input name="cidade" type="text" id="casa-local-input" min="1" class="add-input" required>

        <p id="local-label">Bairro</p>
        <input name="bairro" type="text" id="casa-local-input" min="1" class="add-input" required>

        <p id="local-label">Rua e Numero</p>
        <input name="ruaNumero" type="text" id="casa-local-input" min="1" class="add-input" required>

        <p id="local-label">CEP</p>
        <input name="cep" maxlength="8" minlength="8" type="text" id="casa-local-input" min="1" class="add-input" oninput="formatarCEP(this)" required>

        <p id="tam-area-label">Tamanho da área (m<sup>2</sup>)</p>
        <input name="area" type="text" id="trn-tam-area-input" min="1" class="add-input input-format" required>

        <p id="tam-area-label">Metragem da Frente</p>
        <input name="metragemFrente" type="text" id="trn-tam-area-input" min="1" class="add-input input-format" required>

        <p id="tam-area-label">Metragem Lateral</p>
        <input name="metragemFundo" type="text" id="trn-tam-area-input" min="1" class="add-input input-format" required>

        <p id="tam-area-label">Lateral Esquerda</p>
        <input name="metragemDireita" type="text" id="trn-tam-area-input" min="1" class="add-input input-format" required>

        <p id="tam-area-label">Lateral Direita</p>
        <input name="metragemEsquerda" type="text" id="trn-tam-area-input" min="1" class="add-input input-format" required>

        <p id="tam-area-label">Posição do terreno</p>
        <select name="posTerreno" id="tipo-produto-ddl" class="add-input">
            <option value="nao" selected>Não assinalada</option>
            <option value="meio de quadra">meio de quadra</option>
            <option value="esquina">esquina</option>
            <option value="divisa com muro">divisa com muro</option>
        </select>

        <p id="tam-area-label">Forma do terreno</p>
        <select name="formaTerreno" id="tipo-produto-ddl" class="add-input">
            <option value="nao" selected>Não assinalada</option>
            <option value="regular">regular</option>
            <option value="irregular">irregular</option>
            <option value="poligonal">poligonal</option>
        </select>

        <p id="tam-area-label">Vegetação</p>
        <select name="vegetacao" id="tipo-produto-ddl" class="add-input">
            <option value="nao" selected>Não assinalada</option>
            <option value="mato">mato</option>
            <option value="gramado">gramado</option>
            <option value="limpo">limpo</option>
        </select>

        <p id="tam-area-label">Proteção</p>
        <select name="protecao" id="tipo-produto-ddl" class="add-input">
            <option value="nao" selected>Não assinalada</option>
            <option value="muro">muro</option>
            <option value="cerca">cerca</option>
            <option value="divisão com prédio">divisão com prédio</option>
        </select>

        <p id="tam-area-label">Topografia</p>
        <select name="topografia" id="tipo-produto-ddl" class="add-input">
            <option value="nao" selected>Não assinalada</option>
            <option value="plano">plano</option>
            <option value="aclive">aclive</option>
            <option value="declive">declive</option>
        </select>



        <p id="valor-label">Valor</p>
        <input type="text" name="valor" id="trn-valor-input" class="add-input input-format" lang="pt-BR" required>

        <p id="valor-label">Valor condominio</p>
        <input type="text" name="valorCondominio" id="casa-valor-input" class="add-input input-format" lang="pt-BR">

        <p id="valor-label">IPTU mensal</p>
        <input type="text" name="iptu" id="casa-valor-input" class="add-input input-format" lang="pt-BR">

        <p>Características do Terreno</p>
        <div class="checkbox">
            <div class="check-item">
                <input type="checkbox" name="acessoEnergia" id="acessoEnergia"><label for="acessoEnergia">Acesso a Energia Elétrica</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="escola" id="escola"><label for="escola">Escola</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="comercio" id="comercio"><label for="comercio">Comércio</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="aguaEncanada" id="aguaEncanada"><label for="aguaEncanada">Água Encanada</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="sistemaEsgoto" id="sistemaEsgoto"><label for="sistemaEsgoto">Sistema de Esgoto</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="pavimentacao" id="pavimentacao"><label for="pavimentacao">Pavimentação</label>
            </div>
        </div>

        <p id="valor-label">Infraestrutura da área comum</p>
        <div class="checkbox">
            <div class="check-item">
                <input type="checkbox" name="churrasqueira" id="churrasqueira"><label for="churrasqueira">Churrasqueira</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="adega" id="adega"><label for="adega">Adega</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="quadra" id="quadra"><label for="quadra">Quadra Esportiva</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="sauna" id="sauna"><label for="sauna">Sauna</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="vestiario" id="vestiario"><label for="vestiario">Vestiário</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="campFut" id="campFut"><label for="campFut">Campo de Futebol</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="quintal" id="quintal"><label for="quintal">Quintal</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="piscina" id="piscina"><label for="piscina">Piscina</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaJogos" id="salaJogos"><label for="salaJogos">Sala de Jogos</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaFestas" id="salaFestas"><label for="salaFestas">Salão de Festas</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="salaGinastica" id="salaGinastica"><label for="salaGinastica">Sala de Ginástica</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="playground" id="playground"><label for="playground">Playground</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="portaria24" id="portaria24"><label for="portaria24">Portaria 24h</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="estacionamentoVisita" id="estacionamentoVisita"><label for="estacionamentoVisita">Estacionamento para Visita</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="portaoEletronico" id="portaoEletronico"><label for="portaoEletronico">Portão eletronico</label>
            </div>
            <div class="check-item">
                <input type="checkbox" name="alarme" id="alarme"><label for="alarme">Alarme</label>
            </div>


        </div>

        <p id="local-label">Informações extras (separar por ponto e vírgula)</p>
        <input name="extraInfo" type="text" id="casa-local-input" class="add-input" maxlength="3000">

        <hr class="cadastro-divisor">
        <p>Imagem <span class="image-warning">(Adicionar todas as imagens de uma vez)</span></p>
        <input type="file" name="imagem[]" id="imagemTerreno" multiple required>

        <input type="file" name="imagemTerrenoPrincipal" id="imagemTerrenoPrincipal" style="display: none">

        <div id="imagePreviewTerreno"></div>

        <div class="divBtnEnviar">
            <button type="submit" id="btn-trn-enviar" class="btn-add-prod">SALVAR</button>
        </div>
    </form>

    <script src="{{ asset('js/cadastro-abas.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/imagemPrincipalAlert.js') }}"></script>


    <script>
        function formatarCEP(input) {
            // Remove caracteres não numéricos
            let cep = input.value.replace(/\D/g, '');

            // Adiciona a máscara
            if (cep.length === 8) {
                cep = cep.replace(/(\d{5})(\d{3})/, '$1-$2');
                input.value = cep;
            }
        }
    </script>

<script>
    // Sistema de datas
    const dataTypes = [document.getElementById('valor-aluguel'), document.getElementById('valor-venda')]

    document.getElementById('aluguel_venda').addEventListener('change', function()
    {
        if (document.getElementById('aluguel_venda').value == 'Venda') {
            dataTypes[0].style.display = 'none'
            dataTypes[1].style.display = 'block'
        }
        else if (document.getElementById('aluguel_venda').value == 'Aluguel') {
            dataTypes[0].style.display = 'block'
            dataTypes[1].style.display = 'none'
        }
        else if (document.getElementById('aluguel_venda').value == 'Aluguel/Venda') {
            dataTypes[0].style.display = 'block'
            dataTypes[1].style.display = 'block'
        }
    })

    if (document.getElementById('aluguel_venda').value == 'Venda') {
        dataTypes[0].style.display = 'none'
        dataTypes[1].style.display = 'block'
    }
    else if (document.getElementById('aluguel_venda').value == 'Aluguel') {
        dataTypes[0].style.display = 'block'
        dataTypes[1].style.display = 'none'
    }
    else if (document.getElementById('aluguel_venda').value == 'Aluguel/Venda') {
        dataTypes[0].style.display = 'block'
        dataTypes[1].style.display = 'block'
    }

</script>

@endsection
