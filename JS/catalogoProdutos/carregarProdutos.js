
function carregarTodosProdutos() {

    fetch('../PHP/buscarProdutos/buscarTodosProdutos.php')
        .then(resposta => resposta.json())
        .then(data => {
            renderizarProdutos(data.produtos, data.tipoConta);
        })
        .catch(erro => {
            console.error('Erro:', erro);
        });

}

function carregarProdutos(categoria_id) {

    let url = categoria_id === 0 
        ? '../PHP/buscarProdutos/buscarTodosProdutos.php' 
        : '../PHP/buscarProdutos/buscarProdutosPorCategoria.php?categoria_id=' + categoria_id;

    fetch(url)
        .then(resposta => resposta.json())
        .then(data => {
            renderizarProdutos(data.produtos, data.tipoConta);
        })
        .catch(erro => {
            console.error('Erro:', erro);
        });

};


function renderizarProdutos(produtos, tipoConta) {

    let containerProdutos = document.getElementById('containerProdutos');
    containerProdutos.innerHTML = '';

    if (Array.isArray(produtos) && produtos.length > 0) {
        produtos.forEach(produto => {
            
            // Inserindo o html com a imagem do produto.
            let produtoHTML = `
                <div class='produtoEspecifico'>
                    <a class='linkDoProduto' href='../PHP/detalhesProduto.php?id=${produto.codigoProduto}&from=catalogo'>
                        <img src='data:image/png;base64,${produto.imagemProduto}' alt='${produto.nomeProduto}' class='imagemProduto'>
                        <div class="nomeProduto">${produto.nomeProduto}</div>
                    </a>
                    <div class='botoesProduto'>`;
            
            // Dependendo do tipo do usuário, cria o html dos botões.
            if (tipoConta === 'admin' || tipoConta === 'funcionario') {

                produtoHTML += `
                    <a class='botao' id='botaoVisualizar' href='../PHP/detalhesProduto.php?id=${produto.codigoProduto}&from=catalogo'><button>Visualizar</button></a>
                    <a class='botao' id='botaoRemover'><button onclick='excluirProduto(${produto.codigoProduto})'>Remover</button></a>
                    <a class='botao' id='botaoEditar' href='./editarProduto.php?id=${produto.codigoProduto}'><button>Editar</button></a>`;

            } else {

                produtoHTML += `
                    <a class='botao' id='botaoVisualizar' href='../PHP/detalhesProduto.php?id=${produto.codigoProduto}&from=catalogo'><button>Visualizar Detalhes</button></a>`;

            }

            produtoHTML += `
                    </div>
                </div>`;
            containerProdutos.innerHTML += produtoHTML;
            
        });

    } else {

        containerProdutos.innerHTML = "<div>Nenhum produto encontrado para esta categoria.</div>";

    }

}

// Carrega a categoria "Geral" por padrão, exibindo todos os produtos cadastrados.
document.addEventListener("DOMContentLoaded", function() {
    carregarTodosProdutos();
});
