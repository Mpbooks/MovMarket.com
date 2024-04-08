<?php
// Configurações de conexão com o banco de dados
$db_host = 'localhost';
$db_nome = 'cadastro';
$db_usuario = 'root';
$db_senha = '';

try {
    // Estabelecer conexão PDO
    $pdo = new PDO("mysql:host={$db_host};dbname={$db_nome}", $db_usuario, $db_senha);
    // Definir o modo de erro do PDO para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão, exibir mensagem de erro e encerrar o script
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $produto_id = $_POST['produto_id'];
    $nome = $_POST['nome'];
    $comentario = $_POST['comentario'];
    $rating = $_POST['rating'];

    // Inserir a avaliação no banco de dados
    $sql = "INSERT INTO avaliacoes (produto_id, nome, comentario, rating) VALUES (:produto_id, :nome, :comentario, :rating)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
    $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
    $stmt->execute();

    // Redirecionar de volta para a página de avaliações
    header('Location: avaliacoes.php?produto_id=' . $produto_id);
    exit;
}

 ?>