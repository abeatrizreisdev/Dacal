function excluirProduto(idProduto) {
    const formData = new FormData();
    formData.append('idProduto', idProduto);

    fetch('../PHP/excluirProduto/excluirProduto.php', {
        method: 'POST',
        body: formData
    })
    .then(resposta => {
        if (!resposta.ok) {
            throw new Error('Erro na requisição');
        }
        return resposta.text();
    })
    .then(texto => {
        console.log('Resposta do servidor:', texto);
        try {
            const dados = JSON.parse(texto);
            if (dados.status === 'success') {
                toastr.success(dados.message);
                setTimeout(() => {
                    window.location.reload(); // Recarrega a página após a exclusão do produto.
                }, 2000);
            } else {
                toastr.error(dados.message);
            }
        } catch (erro) {
            console.error('Erro ao analisar JSON:', erro);
            toastr.error('Ocorreu um erro inesperado. Por favor, tente novamente.');
        }
    })
    .catch(error => {
        toastr.error('Ocorreu um erro ao excluir o produto');
        console.error('Erro:', error);
    });
}
