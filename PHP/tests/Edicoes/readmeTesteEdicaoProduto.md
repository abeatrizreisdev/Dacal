# TESTES UNITÁRIOS DE EDIÇÃO DE PRODUTOS COM PHP UNIT:


# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de edição de produtos implementados no sistema, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de edição de produtos estejam funcionando corretamente.


# PRÉ-REQUISITOS:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O COMPOSER (O PHPUnit SERÁ INSTALADO TAMBÉM):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# ESTRUTURA DOS TESTES:
O arquivo TesteEdicaoProduto.php contém vários métodos de testes para verificar a funcionalidade de edição de produtos. Cada teste foca em diferentes cenários, como edição válida, valor inválido e dados obrigatórios faltando.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Edição de Produto Válido:
O método "testEdicaoProdutoValido()" verifica se um produto com todos os dados válidos pode ser editado corretamente. O teste espera que a edição retorne true.

## 2 -> Teste de Edição de Produto com Valor Inválido:
O método "testEdicaoProdutoValorInvalido()" verifica se o sistema rejeita a edição de um produto com um valor inválido. O teste espera que a função de edição retorne false.

## 3 -> Teste de Edição de Produto com Dados Obrigatórios Faltando:
O método "testEdicaoProdutoDadosIncompletos()" verifica se o sistema rejeita a edição de um produto quando dados obrigatórios estão faltando. O teste espera que a função de edição retorne false.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Edicoes/testeEdicaoProduto.php


# RESULTADO DOS TESTES:

## 1 -> testEdicaoProdutoValido()
Descrição: verifica se um produto com dados válidos é editado corretamente.

Resultado Esperado: true.

Resultado Obtido: true.

## 2 -> testEdicaoProdutoValorInvalido()
Descrição: verifica se o sistema rejeita uma edição de um produto com valor inválido.

Resultado Esperado: false.

Resultado Obtido: false.

## 3 -> testEdicaoProdutoDadosIncompletos()
Descrição: verifica se o sistema rejeita uma edição de um produto com dados obrigatórios faltando.

Resultado Esperado: false.

Resultado Obtido: false.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de edição de produtos estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.