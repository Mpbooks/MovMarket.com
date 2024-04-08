<?php
ob_start();
require('config.php');

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM mensagens WHERE email = '$email' AND senha = '$password'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) < 1) {
        header('Location: logi.html'); // Redireciona de volta para a página de login se as credenciais estiverem incorretas
        exit();
    } else {
        session_start();
        $_SESSION['email'] = $email; // Armazena o e-mail do usuário na sessão
        header('Location: ../cart/painel/index.php'); // Redireciona para a página de produtos após o login bem-sucedido
        exit();
    }
} else {
    header('Location: logi.html'); // Redireciona de volta para a página de login se as credenciais estiverem ausentes
    exit();
}
ob_end_flush();
?>