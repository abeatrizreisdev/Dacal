
// Carregar todos os funcionários cadastrados.
fetch('../PHP/crud/retornarDados/retornarTodosFuncionarios.php')
  .then(resposta => resposta.json())
  .then(dados => {
    // Aqui você terá os dados dos funcionários em formato JSON na variável 'data'
    console.log(dados); // Para verificar os dados no console do navegador
    // ... Código para renderizar os dados na página ...

    const container = document.getElementById('container-funcionarios');

    dados.forEach(funcionario => {
    const div = document.createElement('div');
    div.classList.add('funcionario');
    div.innerHTML = `
        <p>Nome: ${funcionario.nome}</p>
        <p>CPF: ${funcionario.cpf}</p>
        <p>Usuário: ${funcionario.tipoConta}</p>
        `;
    container.appendChild(div); 
    });

    }).catch(erro => {

    console.error('Erro ao buscar funcionários:', erro);

    });


