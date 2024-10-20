

// Função para verificar o status de edição
function verificarStatusEdicaoProduto() {

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('statusEdicaoProduto');

    if (status === 'sucesso') {

        toastr.success('Edição do produto feita com sucesso!');

    } else if (status === 'erro') {

        toastr.error('Erro na edição do produto. Por favor, tente novamente.');

    }

    if (status) {

        urlParams.delete('statusEdicaoProduto');
        window.history.replaceState({}, document.title, window.location.pathname + "?" + urlParams.toString());

    }

}

document.addEventListener('DOMContentLoaded', function() {
    verificarStatusEdicaoProduto()
});