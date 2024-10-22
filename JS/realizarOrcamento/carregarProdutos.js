// Função que pega os produtos cadastrados do back-end e passa os produtos para outra função renderizar os produtos conforme o id da categoria.
function carregarProdutos(categoria_id) {

    fetch('../PHP/buscarProdutos/buscarProdutosPorCategoria.php?categoria_id=' + categoria_id)
    .then(resposta => resposta.json())
    .then(produtos => {
    
        console.log('Resposta do servidor:', produtos); 
        renderizarProdutos(produtos);
    
    })
    .catch(erro => {
    
        console.error('Erro:', erro);
    
        });
    
};


// Função que cria o html com os dados do produto para exibir para o usuário.    
function renderizarProdutos(produtos) {
    
    let containerProdutos = document.getElementById('containerProdutos');
    containerProdutos.innerHTML = ''; 
    
    if (Array.isArray(produtos) && produtos.length > 0) {
    
        produtos.forEach(produto => {
    
            // Aqui os elementos html do produto, com suas classes e id para estilizar no css da página "realizarOrcamento", no passo 1, dentro da div: "<div id="containerProdutos"> .
            let produtoHTML = `
                    <div class='produtoEspecifico'>
                        <a class='linkDoProduto' href='./buscarProdutos/detalhesProduto.php?id=${produto.codigoProduto}'>
                            <img src='data:image/png;base64,${produto.imagemProduto}' alt='${produto.nomeProduto}'>
                        </a>
                        <div class='botoesProduto'>
                            <a class='botao' id='botaoVisualizar' href='./buscarProdutos/detalhesProduto.php?id=${produto.codigoProduto}'><button>Visualiza Detalhes</button></a>
                        </div>
                    </div>`;
                
            containerProdutos.innerHTML += produtoHTML;
    
        });
    
    } else {
    
        containerProdutos.innerHTML = "<div>Nenhum produto encontrado para esta categoria.</div>";
    
    };

   
    
};