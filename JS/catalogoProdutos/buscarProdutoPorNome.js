function buscarProdutoPorNome() {

    const produtoNome = document.getElementById('buscarProdutoNome').value.trim();

    if (produtoNome) {
        fetch(`../PHP/buscarProdutos/buscarProdutosPorNome.php?produtoNome=${produtoNome}`)
            .then(resposta => resposta.text())
            .then(dados => {

                try {

                    const jsonDados = JSON.parse(dados);


                    if (jsonDados.produtos) {

                        renderizarProdutos(jsonDados.produtos, jsonDados.tipoConta);

                    } else {

                        document.getElementById('containerProdutos').innerHTML = `<div>${jsonDados.erro}</div>`;

                    }

                } catch (erro) {

                    console.error('Erro ao parsear JSON:', erro, 'Resposta recebida:', dados);
                    toastr.error('Erro ao buscar produto.');

                }
            })
            .catch(erro => {

                console.error('Erro ao buscar produto:', erro);
                toastr.error('Erro ao buscar produto.');

            });

    } else {

        toastr.warning('Por favor, insira um nome de produto válido.');

    }

}



function renderizarProdutos(produtos, tipoConta) {

    let containerProdutos = document.getElementById('containerProdutos');
    containerProdutos.innerHTML = '';

    if (Array.isArray(produtos) && produtos.length > 0) {
        produtos.forEach(produto => {

            let produtoHTML = `
                <div class='produtoEspecifico'>
                    <a class='linkDoProduto' href='../PHP/detalhesProduto.php?id=${produto.codigoProduto}&from=catalogo'>
                        <img src='data:image/png;base64,${produto.imagemProduto}' alt='${produto.nomeProduto}' class='imagemProduto'>
                        <div class="nomeProduto">${produto.nomeProduto}</div>
                    </a>
                    <div class='botoesProduto'>`;

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
