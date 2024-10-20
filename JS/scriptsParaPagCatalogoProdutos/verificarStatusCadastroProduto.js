// Função para verificar o status de edição
function verificarStatusCadastroProduto() {

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('statusCadastroProduto');

    if (status === 'sucesso') {

        toastr.success('Cadastro do produto feito com sucesso!');

    } else if (status === 'erro') {

        toastr.error('Erro no cadastro do produto. Por favor, tente novamente.');

    }

    if (status) {

        urlParams.delete('statusCadastroProduto');
        window.history.replaceState({}, document.title, window.location.pathname + "?" + urlParams.toString());

    }

}

document.addEventListener('DOMContentLoaded', function() {
    verificarStatusCadastroProduto()
});