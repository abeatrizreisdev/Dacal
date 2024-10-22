function fetchProdutos(metodo, categoria = '') {
    
    let url = `api.php?metodo=${metodo}`;
    if (categoria) {
        url += `&categoria=${categoria}`;
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                console.error(data.erro);
            } else {
                renderizarProdutos(data);
            }
        })
        .catch(error => {

            console.error('Erro ao buscar produtos:', error);
        });

}

function renderizarProdutos(produtos) {
    const container = document.getElementById('containerProdutos');
    container.innerHTML = ''; // Limpa o container antes de adicionar os produtos

    produtos.forEach(produto => {

        const produtoElemento = document.createElement('div');
        produtoElemento.className = 'produto';
        produtoElemento.innerHTML = `
            <h2>${produto.nome}</h2>
            <p>Categoria: ${produto.categoria}</p>
            <p>Preço: R$${produto.preco}</p>
        `;

        container.appendChild(produtoElemento);

    });

}

// Inicializa carregando todos os produtos
fetchProdutos('todos');

function carregarProdutos(categoriaId) {

    // Ajuste para passar o nome da categoria correspondente ao ID
    const categorias = ['Móveis', 'Cadeiras', 'Cozinha', 'Utensílios', 'Aparelhos'];
    const categoria = categorias[categoriaId - 1];
    fetchProdutos('categoria', categoria);

}

function buscarProdutoPorNome() {

    const nomeProduto = document.getElementById('buscarProdutoNome').value.toLowerCase();
    fetchProdutos('todos', '')
        .then(produtos => {

            const produtosFiltrados = produtos.filter(produto =>
                produto.nome.toLowerCase().includes(nomeProduto)

            );

            renderizarProdutos(produtosFiltrados);

        });

}
