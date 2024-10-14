   
    // Função para verificar o status de edição
    function verificarStatusEdicao() {

        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('statusEdicaoContaCliente');

        if (status === 'sucesso') {

            toastr.success('Edição da conta feita com sucesso!');

        } else if (status === 'erro') {

            toastr.error('Erro na edição da conta. Por favor, tente novamente.');

        }

        if (status) {

            urlParams.delete('statusEdicaoContaCliente');
            window.history.replaceState({}, document.title, window.location.pathname + "?" + urlParams.toString());

        }

    }
    
    document.addEventListener('DOMContentLoaded', function() {
        verificarStatusEdicao();
        configurarBuscaEmpresa();
        buscarTodasEmpresas();
    });