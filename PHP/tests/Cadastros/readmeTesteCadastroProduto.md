# TESTES UNITÁRIOS DE CADASTRO DE PRODUTOS COM PHP UNIT:


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de cadastro de produtos implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de cadastro de produtos estejam funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS: 
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo "testeCadastroProduto.php" contém 3 métodos de testes para verificar a funcionalidade de cadastro de produto. Cada teste foca em diferentes cenários, como cadastro válido, valor do produto inválido e dados obrigatórios faltando.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Cadastro de Produto Válido:
O método "testCadastroProdutoValido()" verifica se um produto com todos os dados válidos pode ser cadastrado corretamente. O teste espera que o cadastro retorne true.

## 2 -> Teste de Cadastro de Produto com Valor Inválido:
O método "testCadastroProdutoValorInvalido()" verifica se o sistema rejeita o cadastro de um produto com um valor inválido. O teste espera que a função de cadastro retorne false.

## 3 -> Teste de Cadastro de Produto com Dados Obrigatórios Faltando:
O método "testCadastroProdutoDadosIncompletos()" verifica se o sistema rejeita o cadastro de um produto quando dados obrigatórios estão faltando. O teste espera que a função de cadastro retorne false.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Cadastros/TesteCadastroProduto.php


# RESULTADO DOS TESTES:

## 1 -> testCadastroProdutoValido()
Descrição: verifica se um produto válido é cadastrado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2 -> testCadastroProdutoValorInvalido()
Descrição: verifica se o sistema rejeita um cadastro com valor inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 3 -> testCadastroProdutoDadosIncompletos()
Descrição: verifica se o sistema rejeita um cadastro com dados obrigatórios faltando.

Resultado Esperado: false.

Resultado Obtido: false.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de cadastro de produtos estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.