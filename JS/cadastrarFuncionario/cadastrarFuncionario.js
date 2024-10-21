function abrirPopup() {
    // Cria uma sobreposição
    var overlay = document.createElement('div');
    overlay.classList.add('overlay'); // Adiciona a classe de sobreposição
    document.body.appendChild(overlay); // Adiciona a sobreposição ao corpo

    // Crie um elemento div para o pop-up
    var popup = document.createElement('div');
    popup.classList.add('popup'); // Adicione uma classe para estilizar

    // Defina o conteúdo do pop-up
    popup.innerHTML = `
              <div class="geralCadastro">
                <h1 class="cadastroTitulo">Formulário de Cadastro de Funcionário</h1>
                <p class="cadastroGeral">Preencha os campos abaixo:</p>
                <form>
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
                            <label for="endereco">Telefone:</label>
                            <input type="text" class="input" name="endereco" placeholder="Digite o numero de telefone"
                                required>
                        </div>
                        <div class="labelOne">
                            <label for="telefone">Senha:</label>
                            <input type="tel" class="input" name="telefone" placeholder="Digite o telefone" required>
                        </div>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <label for="endereco">Email:</label>
                            <input type="text" class="inputE" name="endereco" placeholder="Digite o endereço de E-mail"
                                required>
                        </div>
                    </div>
                    <br>
                    <div class="labelCadastro">
                        <p class="tituloEndereco">Endereço</p>
                        <input type="text" name="estado" class="inputsAPI" required>
                        <input type="text" name="municipio" class="inputsAPI" required>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <p>Logradouro</p>
                            <input type="text" class="logradouro" name="logradouro" class="input" placeholder="Digite a rua"required>
                        </div>
                        <div class="labelOne">
                            <p>Nº</p>
                            <input type="text" class="numeroEndereco" name="numeroEndereco" class="input" placeholder="nº" required>
                        </div>
                    </div>
                    <div class="labelCadastro">
                        <div class="labelOne">
                            <p>Bairro</p>
                            <input type="text" class="bairro" name="bairro" class="input" placeholder="Digite o bairro"required>
                        </div>
                        <div class="labelOne">
                            <p>CEP</p>
                            <input type="text" class="cep" name="cep" class="input" placeholder="Digite o CEP"required>
                        </div>
                    </div>
                    <button type="submit" class="Cadastrar">Cadastrar Funcionario</button>
                </form>
            </div>
    `;

    // Adicione o pop-up ao corpo da página
    document.body.appendChild(popup);

    // Adicione um botão para fechar o pop-up
    var fecharBtn = document.createElement('button');
    fecharBtn.textContent = 'Fechar Página';
    fecharBtn.classList.add('fecharBtn');
    fecharBtn.onclick = function () {
        popup.remove();     // Remove o pop-up
        overlay.remove();   // Remove a sobreposição
    };
    popup.appendChild(fecharBtn);
}

