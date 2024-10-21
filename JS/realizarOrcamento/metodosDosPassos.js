// Função para buscar produto pelo seu id/código do produto.
function buscarProdutoPorId() {

    const produtoId = document.getElementById('buscarProdutoId').value.trim();

    if (produtoId) {

        fetch(`../PHP/buscarProdutos/buscarProdutoPorId.php?produto_id=${produtoId}`)
            .then(resposta => resposta.text())
            .then(dados => {

                document.getElementById('containerProdutos').innerHTML = dados;

            })
            .catch(erro => {

                console.error('Erro ao buscar produto:', erro);
                toastr.error('Erro ao buscar produto.');

            });
    } else {

        toastr.warning('Por favor, insira um ID de produto válido.');

    }

};

// Função para buscar produto pelo nome do produto.
function buscarProdutoPorNome() {

    const produtoNome = document.getElementById('buscarProdutoNome').value.trim();

    if (produtoNome) {

        fetch(`../PHP/buscarProdutos/buscarProdutosPorNome.php?produtoNome=${produtoNome}`)
            .then(resposta => resposta.text())
            .then(dados => {

                document.getElementById('containerProdutos').innerHTML = dados;

            })
            .catch(erro => {

                console.error('Erro ao buscar produto:', erro);
                toastr.error('Erro ao buscar produto.');

            });
    } else {

        toastr.warning('Por favor, insira um nome de produto válido.');

    }

};

// Função para recalcular e atualizar dinamicamente o valor total e a quantidade total
function atualizarTotais() {

    const totalElemento = document.getElementById('total');
    const quantidadeTotalElemento = document.getElementById('quantidadeTotal');
    
    let total = 0;
    let quantidadeTotal = 0;

    document.querySelectorAll('.produto').forEach(produto => {

        const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');

        if (produtoQuantidadeInput) {

            const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
            const produtoValor = parseFloat(produto.querySelector('.valor').textContent.trim());
            total += produtoQuantidade * produtoValor;
            quantidadeTotal += produtoQuantidade;

        };

    });

    totalElemento.textContent = total.toFixed(2);
    quantidadeTotalElemento.textContent = quantidadeTotal;

};


function removerProduto(produtoId) {

    fetch(`../PHP/arquivosParaRealizarOrcamento/removerProdutoOrcamento.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ produtoId: produtoId })
    })
    .then(respostaRequisicao => respostaRequisicao.json())
    .then(dados => {

        if (dados.success) {

            toastr.success('Produto removido com sucesso!');
            document.getElementById(`produto-${produtoId}`).remove();
            atualizarTotais(); // Atualiza os totais após remover o produto

            const totalElemento = document.getElementById('total');
            let total = 0;
            
            document.querySelectorAll('.produto').forEach(produto => {

                const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');

                if (produtoQuantidadeInput) {

                    const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
                    const produtoValor = parseFloat(produto.querySelector('.valor').textContent.trim());
                    total += produtoQuantidade * produtoValor;
               
                }
            });

            totalElemento.textContent = total.toFixed(2);
        } else {

            toastr.error('Erro ao remover produto: ' + dados.message);

        }

    })
    .catch(erro => console.error('Erro ao remover produto:', erro));

}



function alterarQuantidade(produtoId, delta) {

    const inputQuantidade = document.querySelector(`input[data-produto-id="${produtoId}"]`);
    let quantidadeAtual = parseInt(inputQuantidade.value);
    quantidadeAtual += delta;

    if (quantidadeAtual < 1) quantidadeAtual = 1; // Garantir que a quantidade não seja menor que 1

    inputQuantidade.value = quantidadeAtual;

    // Atualiza a quantidade no backend
    fetch('../PHP/arquivosParaRealizarOrcamento/editarQuantidadeProduto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ produtoId: produtoId, quantidade: quantidadeAtual })
    })
    .then(resposta => resposta.json())
    .then(dados => {
        if (dados.success) {

            atualizarTotais(); // Atualiza os totais após alterar a quantidade.
            // Atualiza o valor total dinamicamente, conforme for alterando a quantidade do produto.

            const valorProduto = parseFloat(document.querySelector(`#produto-${produtoId} .valor`).textContent.trim());
            const totalElemento = document.getElementById('total');
            let total = 0;
            
            document.querySelectorAll('.produto').forEach(produto => {

                const produtoQuantidadeInput = produto.querySelector('input[data-produto-id]');

                if (produtoQuantidadeInput) {
                    const produtoQuantidade = parseInt(produtoQuantidadeInput.value);
                    const produtoValor = parseFloat(produto.querySelector('.valor').textContent.trim());
                    total += produtoQuantidade * produtoValor;
                }

            });

            totalElemento.textContent = total.toFixed(2);

        } else {

            toastr.error('Erro ao atualizar a quantidade: ' + data.message);

        }
    })
    .catch(error => console.error('Erro ao atualizar a quantidade:', error));
}

// Função para abrir o passo correspondente.
function abrirPassoAPassoOrcamento(evento, nomeDoPassoAPassoCorrespondente) {

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

// Função para cancelar o orçamento e redirecionar para a página inicial
function cancelarOrcamento() {

    fetch('../PHP/excluirOrcamento/excluirOrcamento.php', {
        method: 'POST'
    })
    .then(resposta => resposta.json())
    .then(dados => {

        if (dados.success) {

            toastr.success('Orçamento cancelado com sucesso!');

            setTimeout(() => {
                window.location.href = 'homeEmpresa.php';
            }, 1500);

        } else {

            toastr.error('Erro ao cancelar o orçamento.');

        }
    })
    .catch(error => {

        console.error('Erro ao cancelar o orçamento:', error);
        toastr.error('Erro ao cancelar o orçamento.');

    });

}

function avancarParaPasso3() {

    // Redirecionar para o passo 3 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo3';
    
}

function voltarParaPasso2() {

    // Redirecionar para o passo 2 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo2';

}

function voltarParaPasso1() {

    // Redirecionar para o passo 1 sem excluir o orçamento.
    window.location.href = 'realizarOrcamento.php#passo1';
    
}

function visualizarProduto(produtoId) {
    window.location.href = '../PHP/buscarProdutos/detalhesProduto.php?id=' + produtoId;
}

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
