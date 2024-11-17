# TESTES UNITÁRIOS DE CADASTRO DE CLIENTES COM PHP UNIT:


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de cadastro de clientes implementados no sistema, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que a funcionalidade de cadastro de clientes esteja funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo "testeCadastroEmpresa.php" contém vários métodos de testes para verificar a funcionalidade de cadastro de clientes. Cada teste foca em diferentes cenários, como cadastro válido, CNPJ inválido e dados incompletos.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Cadastro de Cliente válido:
O método "testCadastroClienteValido()" verifica se um cliente com todos os dados válidos pode ser cadastrado corretamente. O teste espera que o cadastro retorne true.

## 2 -> Teste de Cadastro de Cliente com CNPJ inválido:
O método "testCadastroClienteCnpjInvalido()" verifica se o sistema rejeita o cadastro de um cliente com um CNPJ inválido. O teste espera que a função de cadastro retorne false.

## 3 -> Teste de Cadastro de Cliente com Dados Obrigatórios Faltando:
O método "testCadastroClienteDadosIncompletos()" verifica se o sistema rejeita o cadastro de um cliente quando ao menos um dado obrigatório está faltando. O teste espera que uma exceção seja lançada.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Cadastros/TesteCadastroEmpresa.php


# RESULTADO DOS TESTES:

## 1 -> testCadastroClienteValido()
Descrição: Verifica se um cliente válido é cadastrado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2 -> testCadastroClienteCnpjInvalido()
Descrição: verifica se o sistema rejeita um cadastro de um cliente com CNPJ inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 3 -> testCadastroClienteDadosIncompletos()

Descrição: verifica se o sistema rejeita um cadastro de um cliente com um dado obrigatório faltando.

Resultado Esperado: Exceção com mensagem "Erro. A razão social não pode ser vazia.".

Resultado Obtido: Exceção com mensagem "Erro. A razão social não pode ser vazia.".


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de cadastro de clientes estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.