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

// Verificar se foi enviado um ID de produto via parâmetro GET
if (isset($_GET['produto_id']) && !empty($_GET['produto_id'])) {
    $produto_id = $_GET['produto_id'];

    // Consulta SQL para obter avaliações do produto específico
    $sql = "SELECT * FROM avaliacoes WHERE produto_id = :produto_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $stmt->execute();

    // Obter resultado da consulta
    $avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Se nenhum ID de produto foi fornecido, mostrar mensagem de erro
    echo "ID do produto não especificado.";
    exit; // Encerrar o script
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações do Produto</title>

   <style>
    
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
   </style>

</head>
<body>
    <h1>Avaliações do Produto</h1>

    <?php if (isset($avaliacoes) && !empty($avaliacoes)) : ?>
    <ul>
        <?php foreach ($avaliacoes as $avaliacao) : ?>
            <li>
                <strong><?= htmlspecialchars($avaliacao['nome']) ?>:</strong>
                <?php
                $rating = intval($avaliacao['rating']);
                for ($i = 0; $i < $rating; $i++) {
                    echo '★'; // Exibir estrelas correspondentes ao rating
                }
                ?>
                <br>
                <?= htmlspecialchars($avaliacao['comentario']) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Nenhuma avaliação encontrada para este produto.</p>
<?php endif; ?>

    <hr>

    <h2>Adicionar Avaliação</h2>
   

<form action="processar_avaliacao.php" method="post">
    <input type="hidden" name="produto_id" value="<?= htmlspecialchars($produto_id) ?>">
    <label for="nome">Seu Nome:</label>
    <input type="text" id="nome" name="nome" required><br>
    <label for="comentario">Comentário:</label><br>
    <textarea id="comentario" name="comentario" rows="4" cols="50" required></textarea><br>
    <label for="rating">Avaliação (estrelas):</label>
    <select id="rating" name="rating" required>
        <option value="1">★</option>
        <option value="2">★★</option>
        <option value="3">★★★</option>
        <option value="4">★★★★</option>
        <option value="5">★★★★★</option>
    </select><br>
    <button type="submit">Enviar Avaliação</button>
</form>

</body>
</html>
