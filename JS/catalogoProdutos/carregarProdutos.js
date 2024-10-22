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

}

function renderizarProdutos(produtos) {

    let containerProdutos = document.getElementById('containerProdutos');
    containerProdutos.innerHTML = ''; 

    if (Array.isArray(produtos) && produtos.length > 0) {

        produtos.forEach(produto => {

            // Aqui os elementos html do produto, com suas classes e id para estilizar no css da página "catalogoProdutos.php".
            let produtoHTML = `
                <div class='produtoEspecifico'>
                    <a class='linkDoProduto' href='./buscarProdutos/detalhesProduto.php?id=${produto.codigoProduto}'>
                        <img src='data:image/png;base64,${produto.imagemProduto}' alt='${produto.nomeProduto}'>
                    </a>
                    <div class='botoesProduto'>
                        <a class='botao' id='botaoVisualizar' href='./buscarProdutos/detalhesProduto.php?id=${produto.codigoProduto}'><button>Visualizar</button></a>
                        <a class='botao' id='botaoRemover'><button onclick='excluirProduto(${produto.codigoProduto})'>Remover</button></a>
                        <a class='botao' id='botaoEditar' href='./editarProduto.php?id=${produto.codigoProduto}'><button>Editar</button></a>
                    </div>
                </div>`;
            
            containerProdutos.innerHTML += produtoHTML;

        });

    } else {

        containerProdutos.innerHTML = "<div>Nenhum produto encontrado para esta categoria.</div>";

    }

}
