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
  


// Função para buscar orçamentos e atualizar o conteúdo da página com as informações do(s)orçamento(s) pesquisados.
function buscarOrcamentos(url) {

  fetch(url)
  .then(resposta => resposta.json())
  .then(dados => {

      const orcamentosDiv = document.getElementById('orcamentos');
      orcamentosDiv.innerHTML = '';

      if (Array.isArray(dados)) {

          // Criando os elementos HTML com as informações dos orçamentos encontrados
          dados.forEach(orcamento => {

              const orcamentoElement = document.createElement('div');
              orcamentoElement.classList.add('orcamento');
              orcamentoElement.innerHTML = `
                  <p>Número do Orçamento: ${orcamento.numeroOrcamento}</p>
                  <p>Valor: ${formatarValor(orcamento.valorOrcamento)}</p>
                  <p>Data de Criação: ${formatarData(orcamento.dataCriacao)}</p>
                  <p>Status: ${orcamento.status}</p>
                  <p>Nome da Empresa: ${orcamento.nomeCliente}</p>
                  <p>Quantidade total de itens: ${orcamento.quantidadeTotal}</p>
                  <a href='../PHP/editarStatusOrcamento.php?numeroOrcamento=${orcamento.numeroOrcamento}' class='linkVerMaisInfo'>Ver mais informações</a>
              `;

              orcamentosDiv.appendChild(orcamentoElement);

          });

      } else if (dados.mensagem) {

          // Renderizar mensagem de erro se nenhum orçamento for encontrado.
          orcamentosDiv.innerHTML = `<p>${dados.mensagem}</p>`;

      } else {

          // Renderizar erro genérico se a resposta não for uma array nem contiver uma mensagem
          orcamentosDiv.innerHTML = '<p>Ocorreu um erro na busca por orçamentos.</p>';

      }

  })
  .catch(error => console.error('Erro:', error));
  
}


// Eventos de clicks para selecionar o tipo de busca que deseja realizar.
document.getElementById('buscarNumero').addEventListener('click', () => {

  criarCampoBusca('Insira o número do orçamento', 'inputNumero', 'buscarNumero');

  document.querySelector('.btnBuscar').addEventListener('click', () => {

      // Passando o número digitado no input de busca para a função que busca o orçamento pelo número.
      const numeroOrcamento = document.getElementById('inputNumero').value;
      buscarOrcamentos(`../PHP/buscarOrcamentos/buscarOrcamentoPorNumero.php?numeroOrcamento=${numeroOrcamento}`);

  });

});

document.getElementById('buscarEmpresa').addEventListener('click', () => {

  criarCampoBusca('Insira o nome da empresa', 'inputEmpresa', 'buscarEmpresa');

  document.querySelector('.btnBuscar').addEventListener('click', () => {

      // Passando o número digitado no input de busca para a função que busca o orçamento pelo nome da empresa/razão social.
      const nomeEmpresa = document.getElementById('inputEmpresa').value;
      buscarOrcamentos(`../PHP/buscarOrcamentos/buscarOrcamentoPorRazaoSocial.php?nomeEmpresa=${nomeEmpresa}`);

  });

});


  // Função para formatar a data no formato brasileiro
  function formatarData(data) {

    const dataObj = new Date(data);
    return dataObj.toLocaleDateString('pt-BR');

};

// Função para formatar o valor em formato brasileiro
function formatarValor(valor) {

    return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

};
