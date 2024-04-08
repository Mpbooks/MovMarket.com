<?php
ob_start();
require('../sheep_core/config.php');

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: logi.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mov.Market</title>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div align="center" style="padding:20px; margin-top:120px;">
        <div class="col-md-10"> 
            <section class="section">
                <?php 
                $sucesso= filter_input(INPUT_GET, 'sucesso', FILTER_VALIDATE_BOOLEAN);
                if($sucesso){
                 
                ?>
         <div class="alert alert-success">
           Produto apagado com sucesso!
         </div>
         <?php  } ?>

         <?php 
                $sucesso= filter_input(INPUT_GET, 'erro', FILTER_VALIDATE_BOOLEAN);
                if($sucesso){
                 
                ?>
         <div class="alert alert-danger">
           Falha ao apagar produto!
         </div>
         <?php  } ?>

                <?php require_once('topo.php'); ?>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Seus Produtos</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Nº</th>  
                                                <th>Capa</th>
                                                <th>Criado</th>
                                                <th>Nome</th>
                                                <th>Valor</th>
                                                <th>Editar</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Obtém o e-mail do usuário autenticado
                                            $usuario_email = $_SESSION['email'];

                                            // Consulta os produtos associados a esse usuário
                                            $ler = new Ler();
                                            $ler->Leitura('produtos', "WHERE email = '$usuario_email' ORDER BY data DESC");

                                            if ($ler->getResultado()) {
                                                foreach ($ler->getResultado() as $produto) {
                                                    $produto = (object) $produto;
                                            ?>
                                                    <tr>
                                                        <td><?= $produto->id?></td>
                                                        <td><img src="<?= HOME ?>/uploads/<?= $produto->capa?>" alt="" style="width:50px;"></td>
                                                        <td><?= date('d/m/Y', strtotime($produto->data)) ?></td>
                                                        <td><?= $produto->nome?></td>
                                                        <td>R$<?= $produto->valor?></td>

                                                        <td><a href="upProduto.php?id=<?= $produto->id?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a></td>
                                                        <td>
                                                            <form action="../painel/filtros/excluir.php" method="post">
                                                                
                                                                <input type="hidden" name="id" value="<?= $produto->id?>">
                                                                <button type="submit" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='7'>Nenhum produto encontrado.</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="assets/js/custom.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>
