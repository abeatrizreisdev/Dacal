# TESTES UNITÁRIOS DE CADASTRO DE FUNCIONÁRIOS COM PHP UNIT:

# OBJETIVO:
Este documento fornece uma visão dos testes da funcionalidade de cadastro de funcionários implementado no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que a funcionalidade de cadastro de funcionários estejam funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS: 
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES: 
O arquivo "testeCadastroFuncionario.php" contém 3 métodos de testes para verificar a funcionalidade de cadastro de funcionário. Cada teste foca em diferentes cenários, como cadastro válido, CPF inválido e dados incompletos.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Cadastro de Funcionário Válido:
O método "testCadastroFuncionarioValido()" verifica se um funcionário com todos os dados válidos pode ser cadastrado corretamente. O teste espera que o cadastro retorne true.

## 2 -> Teste de Cadastro de Funcionário com CPF Inválido:
O método "testCadastroFuncionarioCpfInvalido()" verifica se o sistema rejeita o cadastro de um funcionário com um CPF inválido. O teste espera que a função de cadastro retorne false.

## 3 -> Teste de Cadastro de Funcionário com Dados Obrigatórios Faltando:
O método "testCadastroFuncionarioDadosIncompletos()" verifica se o sistema rejeita o cadastro de um funcionário quando ao menos um dado obrigatório está faltando. O teste espera que a função de cadastro retorne false.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Cadastros/TesteCadastroFuncionario.php


# RESULTADO DOS TESTES:

## 1 -> testCadastroFuncionarioValido()
Descrição: verifica se um funcionário válido é cadastrado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2 -> testCadastroFuncionarioCpfInvalido()
Descrição: verifica se o sistema rejeita um cadastro com CPF inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 3 -> testCadastroFuncionarioDadosIncompletos()
Descrição: verifica se o sistema rejeita um cadastro com dados obrigatórios de senha e bairro faltando.

Resultado Esperado: false.

Resultado Obtido: false.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de cadastro de funcionários estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.