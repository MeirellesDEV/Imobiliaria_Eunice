const painelPesquisa = document.querySelector('#painel-pesquisa-lateral');
const botaoPesquisa = document.querySelector('#mobile-buscar');
const body = document.querySelector('body');

function abrirPainel() {
    painelPesquisa.style.display = 'flex';
    body.style.overflowY = 'hidden';
    botaoPesquisa.style.display = 'none';
}

function fecharPainel() {
    painelPesquisa.style.display = 'none';
    body.style.overflowY = 'auto';
    botaoPesquisa.style.display = 'block';
}


