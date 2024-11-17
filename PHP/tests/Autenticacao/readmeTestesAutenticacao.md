# TESTES UNITÁRIOS DE AUTENTICAÇÃO COM PHP UNIT:

# OBJETIVO:
Este documento fornece uma visão detalhada dos testes de autenticação implementados no projeto, incluindo os resultados esperados e obtidos para cada teste. O objetivo é garantir que as funcionalidades de autenticação para clientes e funcionários estejam funcionando corretamente.


# PRÉ REQUISITOS: 
Necessário ter o PHP 8.1.25 ou superior no pc; instalar no pc o Composer, para gerenciamento de dependências para o PHP; PHPUnit, frameworks para testes.


# INSTALAR AS DEPENDÊNCIAS DO PROJETO COM O Composer, O PHPUnit SERÁ INSTALADO TAMBÉM:
No diretório raiz do projeto, execute o comando no terminal (usei no vscode): composer install


# VERIFICAR A INSTALAÇÃO DO PHPUnit NO PROJETO:
Utilize o comando no terminal: php vendor/bin/phpunit --version


# CONFIGURAR O BANCO DE DADOS:
Editar o arquivo "configBanco.php" e atualizar as configurações do banco de dados.


# ESTRUTURA DOS TESTES:
O arquivo "TesteAutenticacao.php" tem 8 métodos de testes para verificar a funcionalidade de autenticação de conta do tipo Empresa(Cliente) e Funcionário. Cada teste foca em diferentes cenários, como tentativas de autenticações válidas e inválidas.


# DESCRIÇÃO DOS MÉTODOS DE TESTES:

## 1 -> Teste de Autenticação de Empresa com CNPJ e Senha válidos:
O método "testLoginEmpresaValido()" verifica se uma empresa pode ser autenticada com um CNPJ e senha válidos. O teste espera que a função de autenticação retorne um array associativo com os dados da empresa.

## 2 -> Teste de Autenticação de Empresa com CNPJ inválido e Senha válida:
O método "testLoginEmpresaCnpjInvalido()" verifica se a autenticação falha quando um CNPJ inválido e uma senha válida são fornecidos. O teste espera que a função de autenticação retorne o valor null.

## 3 -> Teste de Autenticação de Empresa com CNPJ e Senha inválidos:
O método "testLoginEmpresaCnpjSenhaInvalidos()" verifica se a autenticação falha quando um CNPJ e senha inválidos são fornecidos. O teste espera que a função de autenticação retorne null.

## 4 -> Teste de Autenticação de Empresa com CNPJ válido e Senha inválida:
O método "testLoginEmpresaSenhaInvalida()" verifica se a autenticação falha quando um CNPJ válido e uma senha inválida são fornecidos. O teste espera que a autenticação retorne null.

## 5 -> Teste de Autenticação de Funcionário com CPF e Senha válidos:
O método "testLoginFuncionarioValido()" verifica se um funcionário pode ser autenticado com um CPF e senha válidos. O teste espera que a função de autenticação retorne um array associativo com os dados do funcionário autenticado.

## 6 -> Teste de Autenticação de Funcionário com CPF inválido e Senha válida:
O método "testLoginFuncionarioCpfInvalido()" verifica se a autenticação falha quando um CPF inválido e uma senha válida são fornecidos. O teste espera que a autenticação retorne null.

## 7 -> Teste de Autenticação de Funcionário com CPF Válido e Senha Inválida:
o método "testLoginFuncionarioSenhaInvalida()" verifica se a autenticação falha quando um CPF válido e uma senha inválida são fornecidos. O teste espera que a autenticação retorne null.

## 8 -> Teste de Autenticação de Funcionário com CPF e Senha Inválidos:
O método "testLoginFuncionarioCPFeSenhaInvalidos()" verifica se a autenticação falha quando um CPF e uma senha inválidos são fornecidos. O teste espera que a autenticação retorne null.


# COMANDO PARA RODAR OS TESTES:
Para rodar os testes, execute o seguinte comando no terminal a partir do diretório raiz do projeto: php vendor/bin/phpunit PHP/tests/Autenticacao/TesteAutenticacao.php


# RESULTADO DOS TESTES:

## 1 -> testLoginEmpresaValido()
Descrição: verifica se uma empresa é autenticada com CNPJ e senha válidos.

Resultado Esperado: array associativo com dados da empresa.

Resultado Obtido: array associativo com dados da empresa.

## 2 -> testLoginEmpresaCnpjInvalido()
Descrição: verifica se a autenticação falha com CNPJ inválido e senha válida.

Resultado Esperado: null.

Resultado Obtido: null.

## 3 -> testLoginEmpresaCnpjSenhaInvalidos()
Descrição: verifica se a autenticação falha com CNPJ e senha inválidos.

Resultado Esperado: null.

Resultado Obtido: null.

## 4 -> testLoginEmpresaSenhaInvalida()
Descrição: verifica se a autenticação falha com CNPJ válido e senha inválida.

Resultado Esperado: null.

Resultado Obtido: null.

## 5 -> testLoginFuncionarioValido()
Descrição: verifica se um Funcionário é autenticado com cnnpj e senha válidos.

Resultado Esperado: array associativo com dados do funcionário autenticado.

Resultado Obtido: array associativo com dados do funcionário autenticado.

## 6 -> testLoginFuncionarioCpfInvalido()
Descrição: verifica se a autenticação falha com CPF inválido e senha válida.

Resultado Esperado: null.

Resultado Obtido: null.

## 7 -> testLoginFuncionarioSenhaInvalida()
Descrição: verifica se a autenticação falha com CPF válido e senha inválida.

Resultado Esperado: null.

Resultado Obtido: null.

## 8 -> testLoginFuncionarioCPFeSenhaInvalidos()
Descrição: verifica se a autenticação falha com CPF e senha inválidos.

Resultado Esperado: null.

Resultado Obtido: null.


# CONCLUSÃO DOS TESTES:
Todos os testes foram executados com sucesso, confirmando que as funcionalidades de autenticação estão funcionando conforme o esperado. Não foram encontrados problemas durante a execução dos testes, e todos os resultados obtidos estavam de acordo com os resultados esperados.