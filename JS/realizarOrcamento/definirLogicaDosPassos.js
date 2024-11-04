 // Função para abrir o passo correspondente.
 function abrirPassoAPassoOrcamento(evento, nomeDoPassoAPassoCorrespondente) {
    var indice, conteudoTabela, linksTabela;

    // Pegando todos os elementos que possuem essa classe
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");

    // Iterando sobre cada um dos elementos que têm a classe "conteudoPassoAPasso" e ocultando da tela
    for (indice = 0; conteudoTabela.length > indice; indice++) {
        conteudoTabela[indice].style.display = "none";
    };

    // Pegando todos os elementos que têm essa classe
    linksTabela = document.getElementsByClassName("linksTabela");

    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela" e removendo a classe "ativo"
    for (indice = 0; linksTabela.length > indice; indice++) {
        linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");
    };

    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";
    evento.currentTarget.className += " ativo";
};

function avancarParaPasso3() {
    abrirPassoAPassoOrcamento({ currentTarget: document.querySelector("button[onclick*='passo3']") }, 'passo3');
};

function voltarParaPasso2() {
    abrirPassoAPassoOrcamento({ currentTarget: document.querySelector("button[onclick*='passo2']") }, 'passo2');
};

function voltarParaPasso1() {
    abrirPassoAPassoOrcamento({ currentTarget: document.querySelector("button[onclick*='passo1']") }, 'passo1');
};


function abrirPassoAPasso(evento, nomeDoPassoAPassoCorrespondente, adicionarClasseAtivo = true) {
    
    var indice, conteudoTabela, linksTabela;

    // Pegando todos os elementos que possuem essa classe.
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");

    // Iterando sobre cada um dos elementos que têm a classe "conteudoPassoAPasso" e ocultando da tela.
    for (indice = 0; conteudoTabela.length > indice; indice++) {
        conteudoTabela[indice].style.display = "none";
    }

    // Pegando todos os elementos que têm essa classe.
    linksTabela = document.getElementsByClassName("linksTabela");

    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela" e removendo a classe "ativo".
    for (indice = 0; linksTabela.length > indice; indice++) {

        linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");

    }

    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";

    if (adicionarClasseAtivo) {

        evento.currentTarget.className += " ativo";

    }

}

function avancarParaPasso(nomeDoPassoAPassoCorrespondente) {

    var botaoCorrespondente = document.querySelector(`button[onclick*='${nomeDoPassoAPassoCorrespondente}']`);

    abrirPassoAPasso({ currentTarget: botaoCorrespondente }, nomeDoPassoAPassoCorrespondente);

}

function voltarParaPasso(nomeDoPassoAPassoCorrespondente) {

    var botaoCorrespondente = document.querySelector(`button[onclick*='${nomeDoPassoAPassoCorrespondente}']`);

    abrirPassoAPasso({ currentTarget: botaoCorrespondente }, nomeDoPassoAPassoCorrespondente);

}




// Carregando o passo 1 como padrão ao abrir a página de Realizar Orçamento.
document.addEventListener('DOMContentLoaded', function () {
    abrirPassoAPassoOrcamento({ currentTarget: document.getElementById("passoPadrao") }, 'passo1');
});
