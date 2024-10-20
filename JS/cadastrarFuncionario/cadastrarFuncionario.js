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
            <div class="labelOne">
                <label for="telefone">Telefone:</label>
                 <input type="tel" class="input" name="telefone" placeholder="Digite o telefone" required>
            </div>
         </div>
         <div class="labelCadastro">

             <div class="labelOne">
                 <label for="endereco">Endereço:</label>
                 <input type="text" class="Endereco" name="endereco" placeholder="Digite o endereço" required>
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

