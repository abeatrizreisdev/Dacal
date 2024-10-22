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

    };

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

    };

};
