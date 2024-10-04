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