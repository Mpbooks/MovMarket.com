<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Se o usuário não estiver logado, redireciona para o formulário de login
    header('Location: log.html');
    exit();
}

include_once('config.php'); // Inclui o arquivo de configuração com a conexão ao banco de dados

$usuario_id = $_SESSION['usuario_id'];

// Consulta SQL para obter os produtos favoritos do usuário atual
$sql = "SELECT p.* FROM produtos p INNER JOIN produtos_favoritos pf ON p.id = pf.produto_id WHERE pf.usuario_id = $usuario_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Favoritos</title>
</head>
<body>
    <h2>Produtos Favoritos</h2>
    
    <?php if ($result->num_rows > 0) { ?>
        <ul>
            <?php while ($produto = $result->fetch_assoc()) { ?>
                <li>
                    <a href="detalhes_produto.php?id=<?= $produto['id'] ?>">
                        <?= $produto['nome'] ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>Nenhum produto favorito encontrado.</p>
    <?php } ?>
    
    <a href="logout.php">Sair</a> <!-- Link para realizar o logout -->
</body>
</html>
