function metodosLogin(type, element) {
            
            const tagFormulario = document.getElementById('formLogin');
            const loginEmpresa = document.getElementById('loginEmpresa');
            const loginFuncionario = document.getElementById('loginFuncionario');
            const botoes = document.querySelectorAll('.btn');

            // Iterando sobre o botão do tipo de login e removendo a classe "selecionado" dele.
            botoes.forEach(btn => btn.classList.remove('selecionado'));

            // Adcionando a classe de botão selecionado no botão clicado pelo usuário.
            element.classList.add('selecionado');

            if (type === 'empresa') {

                loginEmpresa.style.display = 'block';
                loginFuncionario.style.display = 'none';
                cadastroOpcao.style.display = 'block';
                tagFormulario.action = 'autenticacao/autenticacaoEmpresa.php'; // se o tipo for empresa, o arquivo php que fará a autenticação será especifico para ele.

            } else {

                loginEmpresa.style.display = 'none';
                loginFuncionario.style.display = 'block';
                cadastroOpcao.style.display = 'none';
                tagFormulario.action = 'autenticacao/autenticacaoFuncionario.php';

            }

        }

        // Seleciona o botão de empresa por padrão ao carregar a página.
        document.addEventListener('DOMContentLoaded', function() {
            const botaoSelecionadoPorPadrao = document.querySelector('.btn.selecionado');
            metodosLogin('empresa', botaoSelecionadoPorPadrao);
        });