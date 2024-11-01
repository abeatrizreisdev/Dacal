<?php
require "../../conexaoBD/conexaoBD.php";
require "../crudFuncionario.php";
require "../../entidades/funcionario.php";
require "../../conexaoBD/configBanco.php";

// Configuração inicial do admin
$admin_nome = 'Administrador';
$admin_telefone = '123456789';
$admin_email = 'admin@exemplo.com';
$admin_senha = '12345678';
$admin_tipoConta = 'admin';
$admin_cpf = '08675381557';
$admin_bairro = 'Centro';
$admin_cep = '48110000';
$admin_estado = 'BA';
$admin_cidade = 'Catu';
$admin_numeroEndereco = '100';
$admin_logradouro = 'Rua Principal';

// Conexão com o banco de dados
$conexao = new ConexaoBD();
$conexao->setHostBD(BD_HOST);
$conexao->setPortaBD(BD_PORTA);
$conexao->setEschemaBD(BD_ESCHEMA);
$conexao->setSenhaBD(BD_PASSWORD);
$conexao->setUsuarioBD(BD_USERNAME);
$conexao->getConexao(); // Iniciando a conexão com o banco.

$crudFuncionario = new CrudFuncionario($conexao);

// Hash da senha
$hashed_password = password_hash($admin_senha, PASSWORD_DEFAULT);

// Instanciando o objeto Funcionario e passando os valores
$admin = new Funcionario();
$admin->setNome($admin_nome);
$admin->setTelefone($admin_telefone);
$admin->setEmail($admin_email);
$admin->setSenha($hashed_password); // Senha já hashada
$admin->setCpf($admin_cpf);
$admin->setTipoConta($admin_tipoConta);
$admin->setLogradouro($admin_logradouro);
$admin->setBairro($admin_bairro);
$admin->setCep($admin_cep);
$admin->setEstado($admin_estado);
$admin->setCidade($admin_cidade);
$admin->setNumeroEndereco($admin_numeroEndereco);

// Cadastrar o administrador no banco de dados
$cadastroRealizado = $crudFuncionario->cadastrarFuncionario([
    'nome' => $admin->getNome(),
    'email' => $admin->getEmail(),
    'senha' => $admin->getSenha(), // Senha hashada
    'telefone' => $admin->getTelefone(),
    'tipoConta' => $admin->getTipoConta(),
    'cpf' => $admin->getCpf(),
    'estado' => $admin->getEstado(),
    'cidade' => $admin->getCidade(),
    'bairro' => $admin->getBairro(),
    'logradouro' => $admin->getLogradouro(),
    'cep' => $admin->getCep()
]);

if ($cadastroRealizado) {
    echo json_encode(['sucesso' => true, 'mensagem' => 'Administrador cadastrado com sucesso.']);
} else {
    echo json_encode(['erro' => true, 'mensagem' => 'Erro ao cadastrar o administrador.']);
}
?>
