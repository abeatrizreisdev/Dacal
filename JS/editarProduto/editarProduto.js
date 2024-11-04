document.addEventListener("DOMContentLoaded", function() {

    var urlParams = new URLSearchParams(window.location.search);
    var produtoId = urlParams.get('id');

    if (!produtoId) {
        document.querySelector('.quadrado').innerHTML = "ID do produto não especificado.";
        return;
    }

    fetch('./buscarProdutos/pegarProduto.php?id=' + produtoId)
        .then(resposta => resposta.json())
        .then(produto => {

            if (produto.error) {
                document.querySelector('.quadrado').innerHTML = produto.error;
                return;
            }

            // Preencher os campos do formulário com os dados do produto.
            document.getElementById('imagemPreview').src = '../' + produto.imagemProduto;
            document.querySelector('input[name="imagemAtual"]').value = produto.imagemProduto;
            document.querySelector('input[name="idProduto"]').value = produto.codigoProduto;
            document.getElementById('nomeProduto').value = produto.nomeProduto;
            document.getElementById('precoProduto').value = produto.valorProduto;
            document.getElementById('categoriaProduto').value = produto.categoria;
            document.getElementById('descricaoProduto').value = produto.descricaoProduto;

        })
        .catch(erro => console.log('Erro:', erro));

    // Adiciona o listener para submissão do formulário.
    document.querySelector('form').addEventListener('submit', function(event) {

        event.preventDefault(); // Impedir o envio padrão do formulário.

        var formData = new FormData(this);

        fetch('crud/receberFormulariodeEdicaoProduto/processarEdicaoProduto.php', {
            method: 'POST',
            body: formData
        })
        .then(resposta => resposta.json())
        .then(dados => {
            
            if (dados.sucesso) {

                toastr.success(dados.mensagem);
                setTimeout(function() { 
                    window.location.href = 'catalogoProdutos.php'; 
                }, 2000); // 2 segundos de atraso.

            } else {

                toastr.error('Erro na edição do produto.');

            }

        })
        .catch(erro => console.log('Erro:', erro));
    });

});
