# TESTE DE CADASTRO DE FUNCIONÁRIOS COM PHP UNIT:

# Objetivo:
Este documento fornece uma visão dos testes da funcionalidade de cadastro de funcionários implementado no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que a funcionalidade de cadastro de funcionários estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados: 
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes: 
O arquivo TesteCadastroFuncionario.php contém vários métodos de testes para verificar a funcionalidade de cadastro de funcionários. Cada teste foca em diferentes cenários, como cadastro válido, CPF inválido e dados incompletos.


# Descrição dos Métodos de Testes: 
1 -> Teste de Cadastro de Funcionário Válido:
O método testCadastroFuncionarioValido() verifica se um funcionário com todos os dados válidos pode ser cadastrado corretamente. O teste espera que o cadastro retorne true.

2 -> Teste de Cadastro de Funcionário com CPF Inválido:
O método testCadastroFuncionarioCpfInvalido() verifica se o sistema rejeita o cadastro de um funcionário com um CPF inválido. O teste espera que a função de cadastro retorne false.

3 -> Teste de Cadastro de Funcionário com Dados Obrigatórios Faltando:
O método testCadastroFuncionarioDadosIncompletos() verifica se o sistema rejeita o cadastro de um funcionário quando dados obrigatórios estão faltando. O teste espera que a função de cadastro retorne false.


# Comando para Rodar os Testes: 
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Cadastros/TesteCadastroFuncionario.php


# Resultado dos Testes:
1 -> testCadastroFuncionarioValido()
Descrição: Verifica se um funcionário é cadastrado corretamente.
Resultado Esperado: true
Resultado Obtido: true

2 -> testCadastroFuncionarioCpfInvalido()
Descrição: Verifica se o sistema rejeita um cadastro com CPF inválido.
Resultado Esperado: false
Resultado Obtido: false

3 -> testCadastroFuncionarioDadosIncompletos()
Descrição: Verifica se o sistema rejeita um cadastro com dados obrigatórios de senha e bairro faltando.
Resultado Esperado: false
Resultado Obtido: false


# Conclusão dos Testes:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de cadastro de funcionários estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.