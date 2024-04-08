<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    include_once('config.php'); // Inclui o arquivo de configuração com a conexão ao banco de dados
    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM mensagens WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id']; // Armazena o ID do usuário na sessão

        // Redireciona para a página de produtos favoritos
        header('Location: ../loja/loja.php');
        exit();
    } else {
        // Credenciais inválidas, redireciona de volta para o formulário de login
        header('Location: log.html');
        exit();
    }
} else {
    // Redireciona de volta para o formulário de login se os dados não foram enviados corretamente
    header('Location: log.html');
    exit();
}
?>
