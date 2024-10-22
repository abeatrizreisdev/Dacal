 // Função para abrir o passo correspondente.
 function abrirPassoAPassoOrcamento(evento, nomeDoPassoAPassoCorrespondente) {

    var indice, conteudoTabela, linksTabela;

    // Pegando todos os elementos que possuem esssa classe.
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");
    // Iterando sobre cada um dos elementos que tem a classe "conteudoTabela".
    for (indice = 0; indice < conteudoTabela.length; indice++) {
        // E ocultando da tela o seu conteudo.
        conteudoTabela[indice].style.display = "none";
    };

    // Pegando todos os elementos que tem essa classe.
    linksTabela = document.getElementsByClassName("linksTabela");
    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela".
    for (indice = 0; indice < linksTabela.length; indice++) {
        // E adcionando uma nova classe com o nome "ativo", para poder exibir o conteudo dela, o que significa que o cliente clicou naquele passo em especifico.
        linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");
    };

    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";
    evento.currentTarget.className += " ativo";
    
};

function avancarParaPasso3() {

    // Redirecionar para o passo 3 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo3';
    
};

function voltarParaPasso2() {

    // Redirecionar para o passo 2 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo2';

};

function voltarParaPasso1() {

    // Redirecionar para o passo 1 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo1';
    
};

// Essa é a função responsável por exibir o conteudo de um dos 3 passo a passo de realização do orçamento, dependendo do passo que o usuário clicar.
function abrirPassoAPasso(evento, nomeDoPassoAPassoCorrespondente) {

    var indice, conteudoTabela, linksTabela;

    // Pegando todos os elementos que possuem essa classe
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");

    // Iterando sobre cada um dos elementos que têm a classe "conteudoPassoAPasso" e ocultando da tela
    for (indice = 0; indice < conteudoTabela.length; indice++) {
        conteudoTabela[indice].style.display = "none";
    };

    // Pegando todos os elementos que têm essa classe
    linksTabela = document.getElementsByClassName("linksTabela");

    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela" e removendo a classe "ativo"
    for (indice = 0; indice < linksTabela.length; indice++) {
        linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");
    };

    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";
    evento.currentTarget.className += " ativo";
};


// Carregando o passo 1 como padrão ao abrir a página de Realizar Orçamento.
document.addEventListener('DOMContentLoaded', function () {
    abrirPassoAPassoOrcamento({ currentTarget: document.getElementById("passoPadrao") }, 'passo1');
});
