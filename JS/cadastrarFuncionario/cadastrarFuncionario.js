    // Função para buscar os estados na api do ibge.
    function buscarEstados() {

        fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
            .then(resposta => resposta.json())
            .then(estados => {

                const estadoSelect = document.getElementById('estado');

                estados.forEach(estado => {

                    const option = document.createElement('option');
                    option.value = estado.sigla; // Use a sigla dos estados brasileiros como valor.
                    option.textContent = estado.nome;
                    option.setAttribute('data-uf', estado.id); // Adiciona o ID da UF para a busca de municípios.
                    estadoSelect.appendChild(option);

                });

            })
            .catch(erro => {

                console.error('Erro ao buscar estados:', erro);
                toastr.error('Erro ao carregar estados.');

            });

    }

    // Função que busca as cidades de acordo com a sigla do estado selecionado.
    function buscarMunicipios(sigla) {

        const estadoSelect = document.querySelector(`option[value="${sigla}"]`);
        const uf = estadoSelect.getAttribute('data-uf');
        
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
            .then(resposta => resposta.json())
            .then(municipios => {

                const municipioSelect = document.getElementById('municipio');
                municipioSelect.innerHTML = '<option value="">Selecione um município</option>';

                municipios.forEach(municipio => {

                    const option = document.createElement('option');
                    option.value = municipio.nome;
                    option.textContent = municipio.nome;
                    municipioSelect.appendChild(option);

                });

            })
            .catch(erro => {

                console.error('Erro ao buscar municípios:', erro);
                toastr.error('Erro ao carregar municípios.');

            });

    }

    function popUpCadastrarFuncionario() {

        // Cria uma sobreposição
        var overlay = document.createElement('div');
        overlay.classList.add('overlay'); // Adiciona a classe de sobreposição
        document.body.appendChild(overlay); // Adiciona a sobreposição ao corpo

        // elemento div para o pop-up
        var popup = document.createElement('div');
        popup.classList.add('popup'); // classe para estilizar

        // conteúdo do pop-up
        popup.innerHTML = `
            <div class="geralCadastro">
                <h1 class="cadastroTitulo">Formulário de Cadastro de Funcionário</h1>
                <p class="cadastroGeral">Preencha os campos abaixo:</p>
                <form id="formCadastroFuncionario">
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <label for="nome">Nome:</label>
                            <input type="text" class="input" name="nome" placeholder="Digite o nome" required>
                        </div>
                        <div class="labelOne">
                            <label for="cpf">CPF:</label>
                            <input type="text" class="input" name="cpf" placeholder="Digite o CPF" required>
                        </div>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <label for="telefone">Telefone:</label>
                            <input type="text" class="input" name="telefone" placeholder="Digite o telefone" required>
                        </div>
                        <div class="labelOne">
                            <label for="senha">Senha:</label>
                            <input type="password" class="input" name="senha" placeholder="Digite a senha" required>
                        </div>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <label for="email">Email:</label>
                            <input type="text" class="inputE" name="email" placeholder="Digite o endereço de E-mail" required>
                        </div>
                    </div>
                    <br>
                    <div class="labelCadastro">
                        <p class="tituloEndereco">Endereço</p>
                        <select name="estado" id="estado" class="inputAPI" required>
                            <option value="">Selecione um estado</option>
                        </select>
                        <select name="municipio" id="municipio" class="inputAPI" required>
                            <option value="">Selecione um município</option>
                        </select>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <p>Logradouro</p>
                            <input type="text" class="logradouro" name="logradouro" class="input" placeholder="Digite a rua" required>
                        </div>
                        <div class="labelOne">
                            <p>Nº</p>
                            <input type="text" class="numeroEndereco" name="numeroEndereco" class="input" placeholder="nº" required>
                        </div>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <p>Bairro</p>
                            <input type="text" class="bairro" name="bairro" class="input" placeholder="Digite o bairro" required>
                        </div>
                        <div class="labelOne">
                            <p>CEP</p>
                            <input type="text" class="cep" name="cep" class="input" placeholder="Digite o CEP" required>
                        </div>
                    </div>
                    <button type="submit" class="Cadastrar">Cadastrar Funcionario</button>
                </form>
            </div>
        `;

        // Adiciona o pop-up ao corpo da página
        document.body.appendChild(popup);

        // Adiciona um botão para fechar o pop-up
        var fecharBtn = document.createElement('button');
        fecharBtn.textContent = 'Fechar Página';
        fecharBtn.classList.add('fecharBtn');

        fecharBtn.onclick = function () {

            popup.remove(); // Remove o pop-up
            overlay.remove(); // Remove a sobreposição

        };

        popup.appendChild(fecharBtn);

        // Adiciona o event listener ao formulário
        document.getElementById('formCadastroFuncionario').addEventListener('submit', function (event) {

            event.preventDefault(); // Impede o envio padrão do formulário.
            const formData = new FormData(this);

            fetch('../PHP/crud/receberFormulariosDeCadastros/enviarDadosCadastroFuncionario.php', {
                method: 'POST',
                body: formData
            })
                .then(resposta => resposta.json())
                .then(dados => {

                    if (dados.sucesso) {

                        toastr.success(dados.mensagem || 'Funcionário cadastrado com sucesso.');
                        setTimeout(() => {
                            window.location.href = '../PHP/gerenciarContas.php'; // Redirecionar para a página de gerencia de contas.
                        }, 2000); // Espera de 2 segundos antes de redirecionar.

                    } else if (dados.cpfInvalido) {

                        toastr.error(dados.mensagem || 'CPF inválido.');

                    } else if (dados.erro) {

                        toastr.error(dados.mensagem || 'Erro ao cadastrar o funcionário.');
                       // setTimeout(() => {
                          //  window.location.href = '../PHP/gerenciarContas.php'; // Redirecionar para a página de erro.
                      //  }, 2000); // Espera de 2 segundos antes de redirecionar.

                    }

                })
                .catch(erro => {

                    console.error('Erro:', erro);
                    toastr.error('Erro ao cadastrar o funcionário. Por favor, tente novamente mais tarde.');

                });

        });

        // Chama a função para buscar os estados quando o pop-up é carregado
        buscarEstados();

        // Adiciona o event listener para carregar os municípios quando um estado for selecionado
        document.getElementById('estado').addEventListener('change', function() {

            const estadoId = this.value;

            if (estadoId) {

                buscarMunicipios(estadoId);

            } else {

                document.getElementById('municipio').innerHTML = '<option value="">Selecione um município</option>';

            }

        });
        
    }
