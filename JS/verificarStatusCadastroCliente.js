// Função para verificar o status de edição
function verificarStatusCadastroProduto() {

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('statusCadastroCliente');

    if (status === 'sucesso') {

        toastr.success('Cadastro do Cliente feito com sucesso!');

    } else if (status === 'erro') {

        toastr.error('Erro no cadastro do Cliente. Por favor, tente novamente.');

    }

    if (status) {

        urlParams.delete('statusCadastroCliente');
        window.history.replaceState({}, document.title, window.location.pathname + "?" + urlParams.toString());

    }

}

document.addEventListener('DOMContentLoaded', function() {
    verificarStatusCadastroProduto()
});