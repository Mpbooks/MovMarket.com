<?php
ob_start();
require('../sheep_core/config.php');
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$atualizaProdutos = new Ler();
$atualizaProdutos->Leitura('produtos', "WHERE id = :id", "id={$id}");
if($atualizaProdutos->getResultado()){
   foreach($atualizaProdutos->getResultado() as $produto);
   $produto = (object) $produto;
}

// Verifica se o usuário está autenticado
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: logi.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Obtém o e-mail do usuário autenticado
$usuario_email = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Adicionar Produto - Mov.Market</title>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="add.css">

    <!-- FIM DO CSS  SHEEP FRAMEWORK PHP - MAYKONSILVEIRA.COM.BR -->
</head>
<body>
    <!-- Main Content -->
    <div align="center" style="padding:20px; margin-top:120px;">
        <div class="col-md-10"> 
            <section class="section">
                <!-- inicio topo menu -->
                <?php require_once('topo.php'); ?>
                <!-- fim topo menu -->
                <br>
                <!-- Início do formulário -->
                <form action="filtros/atualizar.php" method="post" enctype="multipart/form-data">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Produtos</h4><br>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row mb-4">

                                        <div class="col-md-12" >         
                                                                        
                                <select class="form-control" name="categoria" id="cate" >
                                    <option value="vestidos">Vestidos</option>
                                    <option value="jaquetas_&_casacos">Jaquetas & Casacos</option>
                                    <option value="calças_&_capri">Calças & Capri</option>
                                    <option value="sueteres">Suéteres</option>
                                    <option value="shorts">Shorts</option>
                                    <option value="fantasia">Fantasia</option>
                                    <option value="moletons">Moletons</option>
                                    <option value="acessorios">Acessórios</option>
                                    <option value="bolsas">Bolsas</option>
                                    <option value="colares">Colares</option>
                                    <option value="argolas">Argolas</option>
                                    <option value="brincos">Brincos</option>
                                    <option value="braceletes">Braceletes</option>
                                    <option value="joias_corporais">Joias Corporais</option>
                                    <option value="maquiagens_&_cosmeticos">Maquiagens & Cosméticos</option>
                                    <option value="skin_care">Skin Care</option>
                                    <option value="cuidado_capilar">Cuidado Capilar</option>
                                    <option value="oleos_essenciais">Óleos Essenciais</option>
                                    <option value="fragrancias">Fragrâncias</option>
                                    <option value="sabonetes_&_bombas_de_banho">Sabonetes & Bombas de Banho</option>
                                    <option value="mascaras_faciais">Máscaras Faciais</option>
                                    <option value="kits_de_spa">Kits de Spa</option>
                                    <option value="cuidados_de_pe_e_maos">Cuidados de pés e mãos</option>
                                    <option value="depilacao">Depilação</option>
                                    <option value="jogos">Jogos</option>
                                    <option value="cameras">Câmeras</option>
                                    <option value="fones_de_ouvidos">Fones de Ouvidos</option>
                                    <option value="caixas_de_som">Caixas de som</option>
                                    <option value="videos_projetores">Vídeos Projetores</option>
                                    <option value="carregadores">Carregadores</option>
                                    <option value="sapatos_femininos">Sapatos Femininos</option>
                                    <option value="relogios">Relógios</option>
                                    <option value="bolsas_de_mao">Bolsas de mão</option>
                                    <option value="cozinha">Cozinha</option>
                                    <option value="sala_de_jantar">Sala de Jantar</option>
                                    <option value="despensa">Despensa</option>
                                    <option value="cafe_da_manha">Café da Manhã</option>
                                    <option value="sala_de_estar">Sala de Estar</option>
                                    <option value="quintal">Quintal</option>
                                    <option value="banheiro">Banheiro</option>
                                    <option value="quarto">Quarto</option>
                                    <option value="armario">Armário</option>
                                    <option value="bebe_&_criancas">Bebê & Crianças</option>
                                    <option value="lavanderia">Lavanderia</option>
                                    <option value="garagem">Garagem</option>
                                    <option value="moda_masculina">Moda Masculina</option>
                                    <option value="moda_para_meninas">Moda para Meninas</option>
                                    <option value="moda_para_meninos">Moda para Meninos</option>
                                    <option value="saude">Saúde</option>
                                    <option value="animais_de_estimacao">Animais de Estimação</option>
                                    <option value="esportes">Esportes</option>                                   
                                    <option value="nao_fisico">Não Físico</option>                                   
                                    <option value="outros">Outros</option>                                                                                                    
                                </select>
                               
                            </div>
</div>
                            <div class="form-group row mb-4">
                                            <div class="col-md-12">
                                                <input type="file" class="form-control" name="capa">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="nome" placeholder="Título do Produto" value="<?=$produto->nome ? $produto->nome : null?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="valor" placeholder="Valor" value="<?=$produto->valor ? $produto->valor : null?> ">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="link" placeholder="Coloque seu Link" value="<?=$produto->link ? $produto->link : null?> ">
                                            </div>
                                        </div>
                                        <!-- Campo de e-mail pré-preenchido -->
                                        <input type="hidden" name="email" value="<?= $usuario_email ?>">

                                        <input type="hidden" name="id" value="<?=$produto->id?>">
                                        <div class="form-group row mb-4">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-lg btn-primary" style="width:100%;" name="upProduto">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Fim do formulário -->
            </section>
        </div>
    </div>


      

    <script>
    const inputEntrada = document.getElementById('entrada');
    const selectCategoria = document.getElementById('categoria');
    const opcoesOriginais = Array.from(selectCategoria.options); // Salva as opções originais

    inputEntrada.addEventListener('input', function() {
        const textoDigitado = inputEntrada.value.toLowerCase();
        const opcoesFiltradas = opcoesOriginais.filter(function(opcao) {
            return opcao.value.toLowerCase().includes(textoDigitado);
        });

        // Limpa as opções atuais
        selectCategoria.innerHTML = '';

        // Adiciona as opções filtradas
        opcoesFiltradas.forEach(function(opcao) {
            selectCategoria.appendChild(opcao.cloneNode(true)); // Adiciona uma cópia da opção filtrada
        });
    });
</script>


    <script src="assets/js/custom.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>
