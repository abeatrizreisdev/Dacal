function criarCampoBusca(placeholder, idInput, buttonId) {
    const buscaContainer = document.querySelector('.busca-conteiner');
    buscaContainer.innerHTML = `
      <input type="text" id="${idInput}" placeholder="${placeholder}">
      <button class="btnBuscar">Buscar</button>
    `;
  
    // Adiciona a classe "selecionado" ao botão clicado e remove dos outros
    const buttons = document.querySelectorAll('.buscar button');
    buttons.forEach(button => button.classList.remove('btnSelecionado'));
    document.getElementById(buttonId).classList.add('btnSelecionado');
}
  
  // Exibir o campo "Número do orçamento" por padrão
  criarCampoBusca('Insira o número do orçamento', 'inputNumero', 'buscarNumero');
  
  // Event listeners para os botões
  document.getElementById('buscarNumero').addEventListener('click', () => {
    criarCampoBusca('Insira o número do orçamento', 'inputNumero', 'buscarNumero');
  });
  
  document.getElementById('buscarEmpresa').addEventListener('click', () => {
    criarCampoBusca('Insira o nome da empresa', 'inputEmpresa', 'buscarEmpresa');
  });
  