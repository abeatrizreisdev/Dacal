# TESTE DE EDIÇÃO DE FUNCIONÁRIOS COM PHP UNIT


# Objetivo
Este documento fornece uma visão detalhada dos testes de edição de funcionários implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de edição de funcionários estejam funcionando corretamente.


# Pré-requisitos:
Necessário ter o PHP 8.1.25 ou superior no PC; instalar o Composer para gerenciamento de dependências do PHP; e PHPUnit para execução dos testes.


# Instalar as Dependências do Projeto com o Composer (O PHPUnit será instalado também):
No diretório raiz do projeto, execute o seguinte comando no terminal (usei no VSCode): composer install


# Verificar a Instalação do PHPUnit no Projeto:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# Configurar o Banco de Dados:
Edite o arquivo configBanco.php e atualize as configurações do banco de dados conforme necessário.


# Estrutura dos Testes
O arquivo TesteEdicaoFuncionario.php contém vários métodos de testes para verificar a funcionalidade de edição de funcionários. Cada teste foca em diferentes cenários, como edição válida, CPF inválido e dados obrigatórios faltando.


# Descrição dos Métodos de Testes
1. Teste de Edição de Funcionário Válido
O método testEdicaoFuncionarioValido() verifica se um funcionário com todos os dados válidos pode ser editado corretamente. O teste espera que a edição retorne true.

2. Teste de Edição de Funcionário com CPF Inválido
O método testEdicaoFuncionarioCpfInvalido() verifica se o sistema rejeita a edição de um funcionário com um CPF inválido. O teste espera que a função de edição retorne false.

3. Teste de Edição de Funcionário com Dados Obrigatórios Faltando
O método testEdicaoFuncionarioDadosIncompletos() verifica se o sistema rejeita a edição de um funcionário quando dados obrigatórios estão faltando. O teste espera que a função de edição retorne false.


# Comando para Rodar os Testes
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto:
php vendor/bin/phpunit PHP/tests/Edicoes/TesteEdicaoFuncionario.php


# Resultado dos Testes
1. testEdicaoFuncionarioValido()
Descrição: Verifica se um funcionário é editado corretamente.
Resultado Esperado: true
Resultado Obtido: true

2. testEdicaoFuncionarioCpfInvalido()
Descrição: Verifica se o sistema rejeita uma edição com CPF inválido.
Resultado Esperado: false
Resultado Obtido: false

3. testEdicaoFuncionarioDadosIncompletos()
Descrição: Verifica se o sistema rejeita uma edição com dados obrigatórios faltando.
Resultado Esperado: false
Resultado Obtido: false


# Conclusão dos Testes
Todos os testes foram executados com sucesso, confirmando que a funcionalidade de edição de funcionário está funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.