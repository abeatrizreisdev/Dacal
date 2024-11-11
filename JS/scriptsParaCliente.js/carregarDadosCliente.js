document.addEventListener("DOMContentLoaded", function() {

    const geralDiv = document.querySelector('.geral');
    const idCliente = geralDiv.getAttribute('data-id-cliente');

    if (idCliente) {

        fetch(`../PHP/buscarCliente/buscarClientePeloId.php?idCliente=${idCliente}`)
            .then(resposta => resposta.json())
            .then(dados => {

                if (dados.erro) {

                    console.error('Erro:', dados.erro);

                } else {
                    
                    document.getElementById('idCliente').value = dados.idCliente;
                    document.getElementById('razaoSocial').value = dados.razaoSocial;
                    document.getElementById('cnpjEmpresa').value = dados.cnpj;
                    document.getElementById('nomeFantasia').value = dados.nomeFantasia;
                    document.getElementById('inscricaoEstadual').value = dados.inscricaoEstadual;
                    document.getElementById('telefone').value = dados.telefone;
                    document.getElementById('logradouro').value = dados.logradouro;
                    document.getElementById('numeroEndereco').value = dados.numeroEndereco;
                    document.getElementById('bairro').value = dados.bairro;
                    document.getElementById('cep').value = dados.cep;
                    document.getElementById('idClienteEmail').value = dados.idCliente;
                    document.getElementById('trocarEmail').value = dados.email;
                    document.getElementById('idClienteSenha').value = dados.idCliente;
                    document.getElementById('trocarSenha').value = dados.senha;
                    
                    // Carregando estados da api do ibge e comparando com o estado da empresa cadastrada para pré-selecionar no formulário de perfil o estado e o municipio.
                    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
                        .then(res => res.json())
                        .then(estados => {

                            let estadoSelect = document.getElementById('estado');

                            estados.forEach(estado => {

                                let option = document.createElement('option');

                                option.value = estado.sigla;
                                option.textContent = estado.nome;

                                if (estado.sigla === dados.estado) {

                                    option.selected = true;

                                }

                                estadoSelect.appendChild(option);

                            });

                            // Carregar municípios
                            fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${dados.estado}/municipios`)
                                .then(res => res.json())
                                .then(municipios => {

                                    let municipioSelect = document.getElementById('municipio');

                                    municipios.forEach(municipio => {

                                        let option = document.createElement('option');
                                        option.value = municipio.nome;
                                        option.textContent = municipio.nome;

                                        if (municipio.nome === dados.municipio) {

                                            option.selected = true;

                                        }

                                        municipioSelect.appendChild(option);

                                    });

                                });

                        });

                }

            })
            .catch(erro => console.error('Erro ao carregar os dados:', erro));

    } else {

        console.error('ID do cliente não encontrado.');

    }

});
