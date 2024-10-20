// Essa é a função responsável por exibir o conteudo de um dos 3 passo a passo de realização do orçamento, dependendo do passo que o usuário clicar.
function abrirPassoAPasso(evento, nomeDoPassoAPassoCorrespondente) {
    
    var indice, conteudoTabela, linksTabela;
    
    // Pegando todos os elementos que possuem esssa classe.
    conteudoTabela = document.getElementsByClassName("conteudoPassoAPasso");

    // Iterando sobre cada um dos elementos que tem a classe "conteudoTabela".
    for (indice = 0; indice < conteudoTabela.length; indice++) {

      // E ocultando da tela o seu conteudo.
      conteudoTabela[indice].style.display = "none";

    }
    
    // Pegando todos os elementos que tem essa classe.
    linksTabela = document.getElementsByClassName("linksTabela");

    // Iterando sobre todos os elementos que foram pegos com a classe "linksTabela".
    for (indice = 0; indice < linksTabela.length; indice++) {

      // E adcionando uma nova classe com o nome "ativo", para poder exibir o conteudo dela, o que significa que o cliente clicou naquele passo em especifico.
      linksTabela[indice].className = linksTabela[indice].className.replace(" ativo", "");

    }
    
    document.getElementById(nomeDoPassoAPassoCorrespondente).style.display = "block";

    evento.currentTarget.className += " ativo";

  }
  
  document.getElementById("passoPadrao").click(); // Abre o primeiro passo por padrão.
  


// Essa função é muito util, porque é através dela que se o usuário clicar em alguma categoria do catalogo de produtos, não abrirá uma nova guia no navegador nem irá recarregar a página, pois por meio da api "fetch" do javascript, é chamado o arquivo php responsável por buscar os produtos da categoria que o usuário selecionar.
function carregarProdutos(categoria_id) {

    // URL para a qual a requisição é enviada. O parâmetro categoria_id é anexado à URL para especificar a categoria dos produtos que queremos buscar.
    fetch('../PHP/buscarProdutos/buscarProdutosPorCategoria.php?categoria_id=' + categoria_id)
        .then(resposta => resposta.text()) // Este método é chamado quando a requisição é completada com sucesso, convertendo a resposta em texto. Como estamos esperando um HTML como resposta, usamos text().
        .then(dados => { // "dados" é o texto (HTML) retornado pela requisição.
            document.getElementById('containerProdutos').innerHTML = dados; // Atualiza o conteúdo do elemento com o ID produtos com o HTML retornado. Isso exibe os produtos na página sem precisar recarregar.
        })
        .catch(erro => {
            console.error('Erro:', erro);
        });

}