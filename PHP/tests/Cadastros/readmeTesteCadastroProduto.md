# TESTE DE CADASTRO DE PRODUTOS COM PHP UNIT:


# Objetivo:
Este documento fornece uma visão detalhada dos testes de cadastro de produtos implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de cadastro de produtos estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes:
O arquivo TesteCadastroProduto.php contém vários métodos de testes para verificar a funcionalidade de cadastro de produtos. Cada teste foca em diferentes cenários, como cadastro válido, valor inválido e dados obrigatórios faltando.


# Descrição dos Métodos de Testes:
1 -> Teste de Cadastro de Produto Válido:
O método testCadastroProdutoValido() verifica se um produto com todos os dados válidos pode ser cadastrado corretamente. O teste espera que o cadastro retorne true.

2 -> Teste de Cadastro de Produto com Valor Inválido:
O método testCadastroProdutoValorInvalido() verifica se o sistema rejeita o cadastro de um produto com um valor inválido. O teste espera que a função de cadastro retorne false.

3 -> Teste de Cadastro de Produto com Dados Obrigatórios Faltando:
O método testCadastroProdutoDadosIncompletos() verifica se o sistema rejeita o cadastro de um produto quando dados obrigatórios estão faltando. O teste espera que a função de cadastro retorne false.


# Comando para Rodar os Testes:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Cadastros/TesteCadastroProduto.php


# Resultado dos Testes:
1 -> testCadastroProdutoValido()
Descrição: Verifica se um produto é cadastrado corretamente.
Resultado Esperado: true
Resultado Obtido: true

2 -> testCadastroProdutoValorInvalido()
Descrição: Verifica se o sistema rejeita um cadastro com valor inválido.
Resultado Esperado: false
Resultado Obtido: false

3 -> testCadastroProdutoDadosIncompletos()
Descrição: Verifica se o sistema rejeita um cadastro com dados obrigatórios faltando.
Resultado Esperado: false
Resultado Obtido: false


# Conclusão dos Testes:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de cadastro de produtos estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.