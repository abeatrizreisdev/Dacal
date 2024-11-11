document.addEventListener("DOMContentLoaded", function() {

    // Obtém a div com a classe 'dadosGerais' para acessar o atributo data-id-funcionario
    const geralDiv = document.querySelector('.dadosGerais');
    const idFuncionario = geralDiv.getAttribute('data-id-funcionario');


    if (idFuncionario) {

        // Faz a requisição para buscar os dados do funcionário pelo ID
        fetch(`../PHP/buscarFuncionario/buscarFuncPorId.php?idFuncionario=${idFuncionario}`)
            .then(resposta => resposta.json()) // Converte a resposta para JSON
            .then(dados => {

                if (dados.erro) {

                    console.error('Erro:', dados.erro); // Mostra o erro no console se houver

                } else {

                    // Preenche os campos do formulário com os dados recebidos
                    document.getElementById('idGeral').value = dados.id;
                    document.getElementById('nome').value = dados.nome;
                    document.getElementById('CPF').value = dados.cpf;
                    document.getElementById('telefone').value = dados.telefone;
                    document.getElementById('logradouro').value = dados.logradouro;
                    document.getElementById('numeroEndereco').value = dados.numeroEndereco;
                    document.getElementById('bairro').value = dados.bairro;
                    document.getElementById('cep').value = dados.cep;
                    document.getElementById('idEmail').value = dados.id;
                    document.getElementById('trocarEmail').value = dados.email;
                    document.getElementById('idSenha').value = dados.id;
                    document.getElementById('trocarSenha').value = dados.senha;

                    // Faz a requisição para carregar os estados da API do IBGE.
                    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
                        .then(res => res.json()) // Converte a resposta para JSON.
                        .then(estados => {

                            let estadoSelect = document.getElementById('estado');
                            estados.forEach(estado => {
                                let option = document.createElement('option');
                                option.value = estado.sigla;
                                option.textContent = estado.nome;

                                if (estado.sigla === dados.estado) {
                                    option.selected = true; // Seleciona o estado do funcionário.
                                }

                                estadoSelect.appendChild(option);

                            });

                            // Faz a requisição para carregar os municípios do estado selecionado.
                            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${dados.estado}/municipios`)
                                .then(res => res.json()) // Converte a resposta para JSON.
                                .then(municipios => {

                                    let municipioSelect = document.getElementById('municipio');
                                    municipios.forEach(municipio => {
                                        let option = document.createElement('option');
                                        option.value = municipio.nome;
                                        option.textContent = municipio.nome;
                                        municipioSelect.appendChild(option);
                                    });

                                    // Seleciona o município do funcionário após carregar todos os municípios.
                                    let municipioEncontrado = municipios.find(municipio => municipio.nome === dados.cidade);

                                    if (municipioEncontrado) {

                                        municipioSelect.value = municipioEncontrado.nome;

                                    }

                                });

                        });
                }
            })
            .catch(erro => console.error('Erro ao carregar os dados:', erro)); // Mostra os erros no console.

    } else {

        console.error('ID do funcionário não encontrado.'); // Mostra erro se o ID do funcionário não for encontrado.

    }

   // Função para enviar dados do formulário de dados gerais
document.querySelector('.formDados').addEventListener('submit', function(evento) {

    evento.preventDefault(); // Evita que o formulário seja enviado por padrão

    const dadosFormulario = new FormData(evento.target);
    dadosFormulario.append('id', idFuncionario); // Adiciona o ID do funcionário aos dados do formulário

    fetch('../PHP/editarFuncionario/edicoesGeraisFunc.php', {
        method: 'POST', // Define o método da requisição como POST
        body: dadosFormulario // Define o corpo da requisição com os dados do formulário
    })
    .then(resposta => resposta.text())  // Captura toda a resposta como texto
    .then(texto => {

        try {

            const resultado = JSON.parse(texto);  // Tenta converter o texto da resposta para JSON

            if (resultado.status === 'erro') {

                toastr.error('Erro ao editar dados gerais: ' + resultado.mensagem); // Mostra erro em um alerta

            } else {

                toastr.success('Dados gerais editados com sucesso'); // Mostra sucesso em um alerta
                setTimeout(() => {

                    // Adiciona um timeout de 2 segundos após o sucesso
                    window.location.href="../PHP/homeFuncionario.php";

                }, 2000); 

            }

        } catch (excecao) {

            console.error('Erro ao processar resposta: ' + excecao + '\n' + texto);  // Mostra erro da resposta não processada.

        }

    })
    .catch(erro => console.error('Erro ao enviar os dados gerais: ' + erro)); // Mostra erro da requisição.

});



    // Função para enviar dados do formulário de alterar email
    document.querySelector('.alterarEmail').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        formData.append('id', idFuncionario);

        fetch('../PHP/editarFuncionario/alterarEmail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Use `.text()` para capturar toda a resposta
        .then(text => {
            try {
                const result = JSON.parse(text);  // Tente converter o texto para JSON
                console.log(result); // Log da resposta JSON
                if (result.status === 'erro') {
                    console.error('Erro ao alterar email:', result.mensagem);
                } else {
                    console.log('Email alterado com sucesso');
                }
            } catch (e) {
                console.error('Erro ao processar resposta:', e, text);  // Log da resposta não processada
            }
        })
        .catch(error => console.error('Erro ao enviar o email:', error));
    });

    // Função para enviar dados do formulário de alterar senha
    document.querySelector('.alterarSenha').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);
        formData.append('id', idFuncionario);

        fetch('../PHP/editarFuncionario/editarSenhaFunc.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Use `.text()` para capturar toda a resposta
        .then(text => {
            try {
                const result = JSON.parse(text);  // Tente converter o texto para JSON
                console.log(result); // Log da resposta JSON
                if (result.status === 'erro') {
                    console.error('Erro ao alterar senha:', result.mensagem);
                } else {
                    console.log('Senha alterada com sucesso');
                }
            } catch (e) {
                console.error('Erro ao processar resposta:', e, text);  // Log da resposta não processada
            }
        })
        .catch(error => console.error('Erro ao enviar a senha:', error));
    });
});
