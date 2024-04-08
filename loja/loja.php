<?php
ob_start();
require('../cart/sheep_core/config.php');
?>

<?php
session_start();

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


// Lógica para verificar se o usuário está logado e se o produto está nos favoritos
$isFavoriteArray = [];
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    foreach ($ler->getResultado() as $produto) {
        $productId = $produto->id;
        $sql = "SELECT * FROM favoritos WHERE user_id = '$userId' AND product_id = '$productId'";
        $result = $conn->query($sql);
        $isFavoriteArray[$productId] = mysqli_num_rows($result) > 0;
    }
}

// Código HTML para exibir produtos
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovMarket</title>
    <link rel="stylesheet" href="loja.css" >
    <link rel="stylesheet" href="nike.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
/>



<style>
    
.rating-stars {
    display: flex;
    align-items: center;
}

.ri-star-fill {
    font-size: 15px;
    color: #ffd700; /* Cor das estrelas preenchidas (amarelo) */
}


/* Estilização das estrelas preenchidas até a média */
.rating-stars {
    display: flex;
    align-items: center;
}

.rating-count {
    margin-left: 80px;
    font-size: 14px;
    color: #888;
}
</style>

</head>

<body>
    <div id="page" class="site">

      <aside class="site-off desktop-hide">
        <div class="off-canvas">
            <div class="canvas-head flexitem">
                <div class="logo"><a href="#">
                <span class="circle"></span>Mov.Market</a></div>
                <a href="#" class="t-close flexcenter" >
                   <i class="ri-close-line sair" ></i>
                </a>
            </div>
            <div class="departments"></div>
            <nav></nav>
            <div class="thetop-nav"></div>
        </div>
      </aside>

        <header>
       <div class="header-top mobile-hide">
        <div class="container">
            <div class="wrapper flexitem">
                <div class="left">
                   <ul class="flexitem main-links">
                   <li><a href="https://api.whatsapp.com/send?phone=5521980258526&text=Tenho%20uma%20d%C3%BAvida!">Entre em contato</a></li>
                    <li><a href="#destaque">Produtos em Destaque</a></li>
                    <li><a href="../cart/login.html">Conta gerente</a></li>
                  
                   </ul>
                </div>
                <div class="right">
                    <ul class="flexitem">
                        <li class="main-links">
                        <li><a href="../cart/logi.html">Minha conta</a></li>
                            <li><a href="../cart/cadastro.html">Cadastrar</a></li>
                        
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
       </div>

       <div class="header-nav">
        <div class="container">
            <div class="wrapper flexitem">
                <a href="#" class="trigger desktop-hide"><span class="i ri-menu-2-line"></span></a>
                <div class="left  flexitem">
                    <div class="logo"><a href="loja.php"><i class="ri-shopping-bag-4-line "></i>
                        <span class="circle"></span>MovMarket</a>
                     <!-- Ícone de pesquisa -->
<span class="icon-large lupa search-icon"><i class="ri-search-line"></i></span>

<!-- Modal de pesquisa -->
<div id="searchModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Pesquisar Produtos</h3>
        <form action="pesquisa.php" method="get" class="se">
            <input type="search" placeholder="Procurar produtos" name="q">
            <button type="submit">Procurar</button>
        </form>
    </div>
</div>


                     </div>
                     
                    <nav class="mobile-hide">
                        <ul class="flexitem second-links">
                            <li><a href="loja.php">Home</a></li>
                                                  
                            <li  class="has-child">
                                <a href="#">Mulher
                                    <div class="icon-small"><i class="ri-arrow-down-s-line"></i></div>
                                </a>
                                <div class="mega">
                                    <div class="container">
                                        <div class="wrapper">
                                            <div class="flexcol">
                                                <div class="row">
                                                    <h4>Roupas </h4>
                                                    <ul>
                                                        <li><a href="buscar_produtos.php?categoria=vestidos">Vestidos</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=jaquetas_&_casacos">Jaquetas & Casacos</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=calças_&_capri">Calças & Capri</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=sueteres">Suéteres</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=shorts">Shorts</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=fantasia">Fantasia</a></li>
                                                        <li><a href="moletons">Moletons</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="flexcol">
                                                <div class="row">
                                                    <h4>Joias</h4>
                                                    <ul>
                                                        <li><a href="buscar_produtos.php?categoria=acessorios">Acessórios</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=bolsas">Bolsas</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=colares">Colares</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=argolas">Argolas</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=brincos">Brincos</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=braceletes">Braceletes</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=joias_corporais">Joias Corporais</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="flexcol">
                                                <div class="row">
                                                    <h4>Beleza</h4>
                                                    <ul>
                                                       
                                                        <li><a href="buscar_produtos.php?categoria=maquiagens_&_cosmeticos">Maquiagens & Cosméticos</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=skin_care">Skin Care</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=cuidado_capilar">Cuidado Capilar</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=oleos_essenciais">Óleos Essenciais</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=fragrancias">Fragrâncias</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=sabonetes_&_bombas_de_banho">Sabonetes & Bombas de Banho</a></li>
                                                        <li><a href="buscar_produtos.php?categoria=mascaras_faciais">Máscaras Faciais </a></li>
                                                        <li><a href="buscar_produtos.php?categoria=kits_de_spa">Kits de spa </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="flexcol products">
                                                <div class="row">
                                                    <div class="media">
                                                        <div class="thumbnail object-cover">
                                                            <a href="#">
                                                            <img src="assets/products/apparel4.jpg" alt=""></div>
                                                        </a>
                                                    </div>
                                                    <div class="text-content">
                                                        <h4>Mais procurados</h4>
                                                        <a href="#" class="primary-button">Ver</a>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>                                       
                                    </div>
                                </div>
                            </li>
                            <li><a href="buscar_produtos.php?categoria=moda_masculina">Homens</a></li>
                            <li>
                                <a href="buscar_produtos.php?categoria=outros" >Outros
                                    <div class="fly-item"><span>Novo!</span></div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
               <!-- <div class="right">
                    <ul class="flexitem second-links">
                        <li class="mobile-hide"><a href="#">
                            <p class="favorite">Favoritos</p>
                            <div class="icon-large cart"><i class="ri-heart-line coracao"></i></div>
                            <div class="fly-item"><span class="item-number"><p>0</p></span></div>
                        </a></li>
                      
                    </ul>
                </div>-->
            </div>
        </div>
       </div>

       <div class="header-main mobile-hide">
        <div class="container">
            <div class="wrapper flexitem">
                <div class="left">
                    <div class="dpt-cat">
                        <div class="dpt-head">
                            <div class="main-text">Todas as Categorias</div>
                            <div class="mini-text mobile-hide">  <?php
        // Aqui vem o código PHP para contar o número de produtos
        // Configurações de conexão com o banco de dados
        $server = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'cadastro';

        // Conexão com o banco de dados
        $conn = new mysqli($server, $usuario, $senha, $banco);

        // Verifica se houve algum erro na conexão
        if ($conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
        }

        // Consulta SQL para contar o número de produtos
        $sql = "SELECT COUNT(*) AS total_produtos FROM produtos";

        // Executa a consulta
        $resultado = $conn->query($sql);

        // Verifica se a consulta retornou resultados
        if ($resultado->num_rows > 0) {
            // Obtém o resultado da consulta
            $row = $resultado->fetch_assoc();
            $total_produtos = $row['total_produtos'];

            echo "<p>  Total de $total_produtos Produtos</p>";
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?> </div>
                            <a href="#" class="dpt-trigger mobile-hide">
                                <i class="ri-menu-3-line ri-xl"></i>
                            </a>
                        </div>
                        <div class="dpt-menu">
                            <ul class="second-links">
                                <li class="has-child beauty">
                                    <a href="#">
                                        <div class="icon-large"><i class="ri-bear-smile-line"></i></div>
                                        Beleza
                                        <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        <li><a href="buscar_produtos.php?categoria=maquiagens_&_cosmeticos">Maquiagens</a></li>
                                        <li><a href="buscar_produtos.php?categoria=skin_care">Skin Care</a></li>
                                        <li><a href="buscar_produtos.php?categoria=cuidado_capilar">Cuidado capilar</a></li>
                                        <li><a href="buscar_produtos.php?categoria=fragrancias">Fragrâcias</a></li>
                                        <li><a href="buscar_produtos.php?categoria=cuidados_de_pe_e_maos">Cuidados de pés e mãos</a></li>
                                        <li><a href="buscar_produtos.php?categoria=acessorios">Acessórios</a></li>
                                        <li><a href="buscar_produtos.php?categoria=depilacao">Depilação</a></li>
                                       
                                    </ul>
                                </li>
                                <li class="has-child electric">
                                    <a href="#">
                                        <div class="icon-large"><i class="ri-bluetooth-connect-line"></i></div>
                                        Eletrônicos
                                        <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        <li><a href="buscar_produtos.php?categoria=jogos">Jogos</a></li>
                                        <li><a href="buscar_produtos.php?categoria=computador">Acessórios para computador</a></li>
                                        <li><a href="buscar_produtos.php?categoria=cameras">Câmeras</a></li>
                                        <li><a href="buscar_produtos.php?categoria=fones_de_ouvidos">Fones de Ouvidos</a></li>
                                        <li><a href="buscar_produtos.php?categoria=caixas_de_som">Caixas de som</a></li>
                                        <li><a href="buscar_produtos.php?categoria=videos_projetores">Vídeos Projetores</a></li>
                                        <li><a href="buscar_produtos.php?categoria=carregadores">Carregadores</a></li>
                                    </ul>
                                </li>
                                <li class="has-child fashion">
                                    <a href="#">
                                        <div class="icon-large"><i class="ri-t-shirt-air-line"></i></div>
                                      Moda Feminina
                                        <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                    <ul>
                                        
                                        <li><a href="buscar_produtos.php?categoria=sapatos_femininos">Sapatos Femininos</a></li>
                                        
                                        <li><a href="buscar_produtos.php?categoria=relogios">Relógios</a></li>
                                        <li><a href="buscar_produtos.php?categoria=bolsas_de_mao">Bolsas de mão</a></li>
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=moda_masculina">
                                        <div class="icon-large"><i class="ri-shirt-line"></i></div>
                                        Moda Masculina
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=moda_para_meninas">
                                        <div class="icon-large"><i class="ri-user-5-line"></i></div>
                                        Moda para Meninas
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=moda_para_meninos">
                                        <div class="icon-large"><i class="ri-user-6-line"></i></div>
                                        Moda para Meninos
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=saude">
                                        <div class="icon-large"><i class="ri-heart-pulse-line"></i></div>
                                       Saúde
                                    </a>
                                </li>
                                <li class="has-child homekit">
                                    <a href="#">
                                        <div class="icon-large"><i class="ri-home-8-line"></i></div>
                                       Casa & Cozinha
                                        <div class="icon-small"><i class="ri-arrow-right-s-line"></i></div>
                                    </a>
                                   <div class="mega">
                                    <div class="flexcol">
                                        <div class="row">
                                            <h4><a href="#">Cozinha & Jantar</a></h4>
                                            <ul>
                                                <li><a href="buscar_produtos.php?categoria=cozinha">Cozinha</a></li>
                                                <li><a href="buscar_produtos.php?categoria=sala_de_jantar">Sala de Jantar</a></li>
                                                <li><a href="buscar_produtos.php?categoria=despensa">Despensa</a></li>
                                                
                                                <li><a href="buscar_produtos.php?categoria=cafe_da_manha">Café da Manhã</a></li>
                                            </ul>
                                        </div>
                                        <div  class="row">
                                            <h4><a href="#">Vivendo</a></h4>
                                            <ul>
                                                <li><a href="buscar_produtos.php?categoria=sala_de_estar">Sala de Estar</a></li>                                         
                                                <li><a href="buscar_produtos.php?categoria=quintal">Quintal</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                   
                                   <div class="flexcol">
                                    <div class="row">
                                        <h4><a href="#">Cama & Banho</a></h4>
                                        <ul>
                                            <li><a href="buscar_produtos.php?categoria=banheiro">Banheiro</a></li>
                                            
                                            <li><a href="buscar_produtos.php?categoria=quarto">Quarto</a></li>
                                            <li><a href="buscar_produtos.php?categoria=armario">Armário</a></li>
                                            <li><a href="buscar_produtos.php?categoria=bebe_&_criancas">Bebê & Crianças</a></li>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h4><a href="#">Utilitários</a></h4>
                                        <ul>
                                            <li><a href="buscar_produtos.php?categoria=lavanderia">Lavanderia</a></li>
                                            <li><a href="buscar_produtos.php?categoria=garagem">Garagem</a></li>
                                 
                                        </ul>
                                </div>
                                </div>
                                   </div>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=animais_de_estimacao">
                                        <div class="icon-large"><i class="ri-android-line"></i></div>
                                     Animais de Estimação
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=esportes">
                                        <div class="icon-large"><i class="ri-basketball-line"></i></div>
                                       Esportes
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=nao_fisico">
                                        <div class="icon-large"><i class="ri-links-line"></i></div>
                                      Não Físicos
                                    </a>
                                </li>
                                <li>
                                    <a href="buscar_produtos.php?categoria=outros">
                                        <div class="icon-large"><i class="ri--line"></i></div>
                                      Outros
                                    </a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                <div class="search-box">
                    <form action="pesquisa.php" method="get" class="search">       
                        <span class="icon-large lupa" ><i class="ri-search-line"></i></span>
                        <input type="search" placeholder="Procurar produtos" name="q">
                        <button type="submit">Procurar</button>
               </form>
                </div>
                </div>
            </div>
        </div>
       </div>
        </header>

        <main>
       <div class="slider">
        <div class="container">
            <div class="wrapper">
                <div class="myslider swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                        <div class="item">
                            <div class="image object-cover">
                            <img src="assets/slider/slider0.jpg" alt="">
                            </div>
                            <div class="text-content flexcol">
                                    <h4>Tênis</h4>
                                    <h2><span>Fique na Moda</span><br><span>Novos tênis a venda</span></h2>
                                    <a href="#" class="primary-button">Compre Agora</a>
                                </div>
                        </div>
                         
                    </div>

                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image object-cover">
                                    <img src="assets/slider/slider5.jpg" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h4>Vestidos</h4>
                                    <h2 class="vestido"><span >Novos Vestidos</span><br><span>Lindos vestidos a venda</span></h2>
                                    <a href="#" class="primary-button">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image object-cover">
                                    <img src="assets/slider/slider7.jpg" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h4>Animais</h4>
                                    <h2><span>Cuide bem do seu Pet</span><br><span>Vários acessórios pro seu animalzinho </span></h2>
                                    <a href="#" class="primary-button">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="item">
                                <div class="image object-cover">
                                    <img src="assets/slider/slider6.jpg" alt="">
                                </div>
                                <div class="text-content flexcol">
                                    <h4>Tecnologia</h4>
                                    <h2><span>Acessórios para computador</span><br><span>Diversos Produtos</span></h2>
                                    <a href="buscar_produtos.php?categoria=esportes" class="primary-button">Compre Agora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
       </div>

       
               <div class="trending">
                <div class="container">
                    <div class="wrapper">
                        <div class="sectop flexitem">
                            <h2><span class="circle"></span><span>Produtos em Destaque</span></h2>
                        </div>
                        <div class="column">
                            <div class="flexwrap">
                            <div class="row products big">
                                <div id="page" class="sites">
                                    <div class="produtos">
                                        <div class="itens">
                                            <div class="titles">
                                                <div class="brand"></div>
                                                <h2>Nike-Air Force </h2>
                                            </div>
                                            <div class="imagens">
                                                <img src="nike.png" alt="" class="ima">
                                            </div>
                                            <div class="meta">
                                                <div class="size">
                                                    
                                                </div>
                                                <div class="preco">
                                                    R$285.72
                                                </div>
                                                <div class="comprar">
                                                    <button>
                                                        <span class="compra">Comprar</span>
                                                        <i class="ri-arrow-right-line ri-2x"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    </div>


    <div class="row products mini" id="destaque">
        <?php
        // Conexão com o banco de dados
        $server = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'cadastro';

        $conn = new mysqli($server, $usuario, $senha, $banco);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha ao se comunicar aos bancos de dados: " . $conn->connect_error);
        }

        // Consulta SQL para recuperar os produtos
        $sql = "SELECT * FROM gerente";
        $result = $conn->query($sql);

        // Exibe os produtos
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="item">';
                echo '<div class="media">';
                echo '<div class="thumbnail object-covers">';
                echo '<a href="' . $row['link'] . '">';
                echo '<img src="' . $row['imagem'] . '" alt="' . $row['nome'] . '">';
                echo '</a>';
                echo '</div>';
                echo '<div class="hoverable">';
                echo '<ul>';
             //   echo '<li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>';
             //   echo '<li><a href="#"><i class="ri-eye-line"></i></a></li>';
               // echo '<li><a href="#"><i class="ri-shuffle-line"></i></a></li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '<div class="content">';
                echo '<h3 class="main-link"><a href="' . $row['link'] . '">' . $row['nome'] . '</a></h3>';
                echo '<div class="rating">';
                echo '<div class="stars"></div>';
                echo '<span class="mini-text">90</span>';
                echo '</div>';
                echo '<div class="price">';
                echo '<span class="current">R$ ' . $row['valor'] . '</span>';
                echo '</div>';
                echo '<div class="mini-text">';
                echo '<p>2967 vendidos</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }else{
            echo "Nenhum produto encontrado.";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>


    <div class="row products mini">
        <?php
        // Conexão com o banco de dados
        $server = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'cadastro';

        $conn = new mysqli($server, $usuario, $senha, $banco);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha ao se comunicar aos bancos de dados: " . $conn->connect_error);
        }

        // Consulta SQL para recuperar os produtos
        $sql = "SELECT * FROM gerente2";
        $result = $conn->query($sql);

        // Exibe os produtos
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="item">';
                echo '<div class="media">';
                echo '<div class="thumbnail object-covers">';
                echo '<a href="' . $row['link'] . '">';
                echo '<img src="' . $row['imagem'] . '" alt="' . $row['nome'] . '">';
                echo '</a>';
                echo '</div>';
                echo '<div class="hoverable">';
                echo '<ul>';
              //  echo '<li class="active"><a href="#"><i class="ri-heart-line"></i></a></li>';
               // echo '<li><a href="#"><i class="ri-eye-line"></i></a></li>';
               // echo '<li><a href="#"><i class="ri-shuffle-line"></i></a></li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '<div class="content">';
                echo '<h3 class="main-link"><a href="#">' . $row['nome'] . '</a></h3>';
                echo '<div class="rating">';
                echo '<div class="stars"></div>';
                echo '<span class="mini-text"></span>';
                echo '</div>';
                echo '<div class="price">';
                echo '<span class="current">R$ ' . $row['valor'] . '</span>';
                echo '</div>';
                echo '<div class="mini-text">';
                echo '<p>2967 vendidos</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Nenhum produto encontrado.";
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>
           
    
   

               
        <!--Trending--->
                    
        <div class="features">
            <div class="container">
                <div class="wrapper">
                    <div class="column">
                        
                        <div class="sectop flexitem">
                            <h2><span class="circle"></span><span>Todos os Produtos</span></h2>
                           
                        </div>

                        <div class="product-list">
                        <?php


$ler = new Ler();
$ler->Leitura('produtos', "ORDER BY data DESC");
if ($ler->getResultado()) {
    foreach ($ler->getResultado() as $produto) {
        $produto = (object) $produto;
    


// Configurações de conexão com o banco de dados
$host = 'localhost';
$dbname = 'cadastro';
$username = 'root';
$password = '';

// Cria uma instância do PDO para estabelecer a conexão
try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// Configura o PDO para lançar exceções em caso de erros
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
// Em caso de erro na conexão, exibe uma mensagem de erro
die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}



         // Consulta SQL para obter a média das estrelas e o total de avaliações para o produto atual
         $sql = "SELECT 
         AVG(rating) AS media_avaliacoes,
         COUNT(*) AS total_avaliacoes
     FROM
         avaliacoes
     WHERE
         produto_id = :produto_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':produto_id', $produto->id, PDO::PARAM_INT);
$stmt->execute();
$avaliacao = $stmt->fetch(PDO::FETCH_ASSOC);
$media_avaliacoes = $avaliacao['media_avaliacoes'];

?>
    <form action="filtros/criar.php" method="post">
        <div class="products main ">
            <div class="item">
                <div class="media">
                    <div class="thumbnail object-covers">
                        <a href="<?=$produto->link?>">
                            <img class="imagem" src="<?=HOME?>/uploads/<?= $produto->capa?>" alt="<?=$produto->nome?>">
                        </a>
                    </div>
                  
                    <div class="hoverable">
                        <ul>
                        <li class="active">
                       
</li> 
                        </ul>
                            
                                    
                                </div>
                            </div>
                            <div class="content">
                               
                                <h3 class="main-links"><a href="<?=$produto->link?>"><?=$produto->nome?></a></h3>
                                <a href="avaliacoes.php?produto_id=<?=$produto->id?>">
                                <div class="rating-stars rating" data-rating="<?= $media_avaliacoes ?>">
<span class="ri-star-line"></span>
<span class="ri-star-line"></span>
<span class="ri-star-line"></span>
<span class="ri-star-line"></span>
<span class="ri-star-line"></span>
</div>


            </a>

            


                                  <div class="price">
                                    <span class="current">R$<?=$produto->valor?></span>
                                    <span class="normal mini-text"></span>
                                  </div>                                      
                                  </div>
                            </div>
                        </div>
        </form>
        <?php
        }
}
    ?>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

   </div>
            </div>
         </div>

        </main>

        

    </div>


     <footer>

     <div class="footer-info">
        <div class="container">
            <div class="wrapper">
                <div class="flexcol">
                    <div class="logo">
                        <a href="loja.php"><span class="circle"></span>Mov.Market</a>
                    </div>
                    <div class="socials">
                        <ul class="flexitem">
                            <li><a href=""><i class="ri-tiktok-line"></i></a></li>
                            <li><a href=""><i class="ri-twitter-line"></i></a></li>
                            <li><a href=""><i class="ri-instagram-line"></i></a></li>
                            <li><a href=""><i class="ri-youtube-line"></i></a></li>
                        </ul>
                    </div>
                </div>
                <p class="mini-text">Copyright  2024 © | Dev MovMarket - Todos os direitos reservados.</p>
            </div>
        </div>
     </div>

     </footer>



     <script>
document.addEventListener('DOMContentLoaded', function() {
    const ratingStarsList = document.querySelectorAll('.rating-stars');

    ratingStarsList.forEach(ratingStars => {
        const stars = ratingStars.querySelectorAll('span');

        const mediaAvaliacao = parseFloat(ratingStars.getAttribute('data-rating'));
        const numStarsPreenchidas = Math.round(mediaAvaliacao); // Arredonda a média para o número de estrelas preenchidas

        // Loop sobre todas as estrelas do conjunto
        stars.forEach((star, index) => {
            if (index < numStarsPreenchidas) {
                // Estrelas preenchidas
                star.classList.remove('ri-star-line');
                star.classList.add('ri-star-fill');
            }
        });



       


    


        // Exibição do número total de avaliações
       const ratingCount = ratingStars.querySelector('.rating-count');
        if (ratingCount) {
           const totalAvaliacoes = parseInt(ratingCount.textContent.match(/\d+/)[0]); // Extrai o número total de avaliações do texto
           ratingCount.textContent = `(${totalAvaliacoes})`;
        }
    });
});

</script>

    <script>
        // Obtém referências aos elementos do DOM
const searchIcon = document.querySelector('.search-icon');
const modal = document.getElementById('searchModal');
const closeModal = document.querySelector('.close-modal');

// Função para exibir o modal
function openModal() {
    modal.style.display = 'block';
}

// Função para ocultar o modal
function closeModalFunc() {
    modal.style.display = 'none';
}

// Event listener para abrir o modal ao clicar no ícone de pesquisa
searchIcon.addEventListener('click', openModal);

// Event listener para fechar o modal ao clicar no botão de fechar
closeModal.addEventListener('click', closeModalFunc);

// Event listener para fechar o modal ao clicar fora do conteúdo do modal
window.addEventListener('click', function(event) {
    if (event.target == modal) {
        closeModalFunc();
    }
});
    </script>


    <script>
   let favorites = [];

function toggleFavorite(productId) {
    const index = favorites.indexOf(productId);
    if (index === -1) {
        favorites.push(productId);
    } else {
        favorites.splice(index, 1);
    }
    updateFavoritesUI();
}

function updateFavoritesUI() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    favoriteButtons.forEach(button => {
        const productId = parseInt(button.getAttribute('data-product-id'));
        if (favorites.includes(productId)) {
            button.innerHTML = '<i class="ri-heart-fill"></i>'; // Ícone de coração cheio
        } else {
            button.innerHTML = '<i class="ri-heart-line"></i>'; // Ícone de coração vazio
        }
    });
}


    </script>
     
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="script.js"></script>



</body>
</html>