<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Verifica se todos os campos foram preenchidos
    if (!empty($_POST['nome']) && !empty($_POST['valor']) && !empty($_POST['link']) && !empty($_FILES['imagem'])) {
        // Conexão com o banco de dados (já estabelecida previamente)
        $server = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'cadastro';

        $conn = new mysqli($server , $usuario,$senha, $banco);

        // Verifica a conexão
        if($conn->connect_error){
            die("Falha  ao se  comunicar aos bancos  de  dados: ".$conn->connect_error);
        }

        // Processa e salva a imagem
        $nome_imagem = $_FILES['imagem']['name'];
        $caminho_temporario = $_FILES['imagem']['tmp_name'];
        $caminho_salvar = '../cart/uploads' . $nome_imagem; // Caminho onde a imagem será salva
        move_uploaded_file($caminho_temporario, $caminho_salvar);

        // Insere os dados do produto no banco de dados
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $link = $_POST['link'];

        $sql = "INSERT INTO gerente2 (nome, valor, link, imagem) VALUES ('$nome', '$valor', '$link', '$caminho_salvar')";
        if ($conn->query($sql) === TRUE) {
            header('Location: loja.php');
        } else {
            echo "Erro ao adicionar o produto: " . $conn->error;
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Por favor, preencha todos os campos!";
    }
}
?>
