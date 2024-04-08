<?php
// Pegando os dados que estão vindo do formulário
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$number = $_POST['number'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$data_atual = date('d/m/Y');
$hora_atual = date('H:i:s');

$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'cadastro';

//CONEXÃO COM NOSSO BANCO DE DADOS
$conn = new mysqli($server , $usuario,$senha, $banco);

//VERIFICAR CONEXÃO
if($conn->connect_error){
    die("Falha  ao se  comunicar aos bancos  de  dados: ".$conn->connect_error);
}

// Verificar se o e-mail já está em uso
$sql_verificar_email = "SELECT * FROM mensagens WHERE email = ?";
$stmt_verificar_email = $conn->prepare($sql_verificar_email);
$stmt_verificar_email->bind_param("s", $email);
$stmt_verificar_email->execute();
$result_verificar_email = $stmt_verificar_email->get_result();

if ($result_verificar_email->num_rows > 0) {
    // E-mail já está em uso, exibe uma mensagem de erro
    header('Location: aviso.html');
    exit; // Para evitar que o script continue executando após exibir a mensagem de erro
}

// Preparar a inserção dos dados
$smtp = $conn->prepare ("INSERT INTO mensagens (primeironome, segundonome, email, number, senha, confirmapassword, data, hora) VALUES (?,?,?,?,?,?,?,?)");

// Verificar se a preparação da consulta foi bem-sucedida
if ($smtp === false) {
    echo "Erro na preparação da consulta: ".$conn->error;
    exit;
}

// Fazer o bind dos parâmetros e executar a inserção
$smtp->bind_param("ssssssss", $firstname, $lastname, $email, $number, $password, $confirmpassword, $data_atual, $hora_atual);

if($smtp->execute()){
    // Redirecionar para a página de loja com o nome do usuário como parâmetro na URL
    header('Location: ../loja/loja.php?nome=' . urlencode($email));
} else {
    echo "Erro de Cadastro: ".$smtp->error;
}

// Fechar as conexões e declarações preparadas
$smtp->close();
$conn->close();
?>