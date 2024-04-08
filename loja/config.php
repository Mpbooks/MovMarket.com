<?php
$host = 'localhost'; // Endereço do servidor MySQL
$dbname = 'cadastro'; // Nome do banco de dados
$username = 'root'; // Nome de usuário do MySQL
$password = ''; // Senha do MySQL (deixe em branco se não tiver senha)

// Tentar conectar ao banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Definir o modo de erro do PDO para lançar exceções
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibir uma mensagem de erro
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>