<?php
    session_start();
    require_once "_mysql\conn.php";
	
	// VERIFICA SE ESTÁ LOGADO - CASO ESTEJA VERIFICA SE A CONTA FOI VALIDADA
    if (isset($_SESSION['login'])) {
        $sqlValidation = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
        if ($resultValidation = $conn->query($sqlValidation)) {
	        $rowValidation = $resultValidation->fetch_assoc();
	        if($rowValidation['verificada'] == 0) {
		       header('location: /cadastro/validacao.php');
	        }
        }
    }
?>

    <!DOCTYPE html>
    <!--
	@credits: ustora and Leonardo Amaro
-->
    <html lang="pt-br">
	
    <!-- INCLUI O HEAD DO CODE -->
    <?php include "_includes/head.html" ?>

        <body>
		
		<!-- ADICIONA O CABEÇALHO A PAGINA -->
            <?php include "_includes/header.php" ?>

                <div class="slider-area">
				
                    <!-- SLIDER DA PÁGINA -->
                    <div class="block-slider block-slider4">
                        <ul class="" id="bxslider-home4">
                            <li>
                                <img src="_img/slider/banner01.jpg" alt="Slide">
                            </li>                  
                        </ul>
                    </div>
                </div>
                <!-- FIM DO SLIDE -->

               <!-- MARCAS -->
			   
               <div class="brands-area">
                    <div class="zigzag-bottom"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="brand-wrapper">
                                    <div class="brand-list">
                                        <img src="img/brand1.png" alt="">
                                        <img src="img/brand2.png" alt="">
                                        <img src="img/brand3.png" alt="">
                                        <img src="img/brand4.png" alt="">
                                        <img src="img/brand5.png" alt="">
                                        <img src="img/brand6.png" alt="">
                                        <img src="img/brand1.png" alt="">
                                        <img src="img/brand2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
                <!-- MARCAS -->

                <div class="maincontent-area">
                    <div class="zigzag-bottom"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-product">
                                    <h2 class="section-title">OFERTAS IMPERDÍVEIS</h2>
                                    <div class="product-carousel">
                                        <?php
                            //BAIXA OS PRODUTOS DA DATABASE EM ORDEM ONDE OS MAIS RECENTES APARECEM - BOA SORTE DEV :D I LOVE YOU
                                $query = "SELECT * FROM produtos ORDER BY restante ASC";
                                $i = 1;
                                if ($result = $conn->query($query)) {
                                    while($row = $result->fetch_assoc() and $i <= 20){
                                        $i ++;
                                        echo "<div class='single-product'>";
                                        echo "<div class='product-f-image'>";
                                        echo "<img src='produtos/img/". $row['id'] .".jpg' alt=''>";
                                        echo "<div class='product-hover'>";
                                        echo "<form action='/produtos/actions/apostar.php' method='POST'> <input type='text' name='produto' value=". $row['id'] ." hidden> <button class='add-to-cart-link' name='apostar' type='submit'><i class='fa fa-shopping-cart'></i>Apostar</button></form>";
										echo "<form action='/produtos/' method='GET'> <input type='text' name='id' value=". $row['id'] ." hidden> <button class='view-details-link' type='submit'><i class='fa fa-link'></i>Detalhes</button></form>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "<h2>". $row['nome'] ."</h2>";
                                        echo "<div class='product-carousel-price'>";
                                        echo "<ins>R$". $row['preco'] ."</ins><br>";

/*
                                        // FAZ UMA VERIFICAÇÃO PARA MOSTRAR SE O RESTANTE DO TEMPO DO PRODUTO VAI SER MEDIDO EM HORAS, MINUTOS OU SEGUNDOS
                                        $dias = ($row['restante'] - time()) / 86400 % 7;  $horas = ($row['restante'] - time()) / 3600 % 24;
                                        $minutos = ($row['restante'] - time()) / 60 % 60;    $segundos = ($row['restante'] - time()) / 60;

                                        if ($dias > 0) {
                                            echo "<ins style='color: #7b7474' name='tdias'>". intval($dias) . " Dias restantes</ins>";
                                        }
                                        else if ($horas > 0) {
                                            echo "<ins style='color: #7b7474' name='thoras'>". intval($horas) . " Horas restantes</ins>";
                                        }
                                        else if ($minutos > 0) {
                                            echo "<ins style='color: #7b7474' name='tminutos'>". intval($minutos) . " Minutos restantes</ins>";
                                        }
                                        else {
                                            echo "<ins style='color: #7b7474' name='tsegundos'>". intval($segundos) . " Segundos restantes</ins>";
                                        }
*/
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                }
                                else {
                                    echo "OCORREU UM ERRO DURANTE A COMUNICAÇÃO COM O BANCO DE DADOS - RECARRE A PÁGINA SE PERMANCER CONTATE UM ADMINISTRADOR";
                                }
                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-widget-area">
                    <div class="zigzag-bottom"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-product-widget">
                                    <h2 class="product-wid-title">Mais Interesses</h2>
                                    <a href="" class="wid-view-more">Ver Mais</a>
                                    <?php
                            //BAIXA OS PRODUTOS DA DATABASE EM ORDEM ONDE OS QUE COMTEM MAIS INTERESSE APARECEM - BOA SORTE DEV :D I LOVE YOU
                            $query = "SELECT * FROM produtos ORDER BY vendas DESC";
                            $i = 1;
                            if ($result = $conn->query($query)) {
                                while($row = $result->fetch_assoc() and $i <= 5){
                                    $i++;

                                    echo "<div class='single-wid-product'>";
                                    echo "<a href='single-product.html'><img src='produtos/img/". $row['id'] .".jpg' alt='' class='product-thumb'></a>";
                                    echo "<h2><a href='single-product.html'>" . $row['nome'] . "</a></h2>";
                                    echo "<div class='product-wid-rating'>";

                                    // BAIXA A QUANTIDADE DE ESTRELA "AVALIAÇÃO DO PRODUTO" E DESENHA A ESTRELA
                                    for($c = 1; $c <= $row['avaliacao']; $c++) {
                                        echo "<i class='fa fa-star'></i>";
                                    }

                                    echo "</div> ";

                                    echo "<div class='product-wid-price'>";
                                    echo "<ins>R$" . $row['preco'] . "</ins>";
                                    echo "</div> ";
                                    echo "</div> ";
                                }
                            }
                        ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-product-widget">
                                    <h2 class="product-wid-title">Visto Recentemente</h2>
                                    <a href="#" class="wid-view-more">Ver Mais</a>
                                    <div class="single-wid-product">
                                        <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt="" class="product-thumb"></a>
                                        <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                                        <div class="product-wid-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-wid-price">
                                            <ins>R$1.00</ins>
                                        </div>
                                    </div>
                                    <div class="single-wid-product">
                                        <a href="single-product.html"><img src="img/product-thumb-1.jpg" alt="" class="product-thumb"></a>
                                        <h2><a href="single-product.html">Sony Smart Air Condtion</a></h2>
                                        <div class="product-wid-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-wid-price">
                                            <ins>R$1.00</ins>
                                        </div>
                                    </div>
                                    <div class="single-wid-product">
                                        <a href="single-product.html"><img src="img/product-thumb-2.jpg" alt="" class="product-thumb"></a>
                                        <h2><a href="single-product.html">Samsung gallaxy note 4</a></h2>
                                        <div class="product-wid-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="product-wid-price">
                                            <ins>R$1.00</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-product-widget">
                                    <h2 class="product-wid-title">Menor Preço</h2>
                                    <a href="#" class="wid-view-more">Ver Mais</a>
                                    <?php
                            //BAIXA OS PRODUTOS DA DATABASE EM ORDEM ONDE OS QUE COMTEM O MENOR PREÇO APARECEM - BOA SORTE DEV :D I LOVE YOU
                            $query = "SELECT * FROM produtos ORDER BY preco ASC";
                            $i = 1;
                            if ($result = $conn->query($query)) {
                                while($row = $result->fetch_assoc() and $i <= 5){
                                    $i++;

                                    echo "<div class='single-wid-product'>";
                                    echo "<a href='single-product.html'><img src='produtos/img/". $row['id'] .".jpg' alt='' class='product-thumb'></a>";
                                    echo "<h2><a href='single-product.html'>" . $row['nome'] . "</a></h2>";
                                    echo "<div class='product-wid-rating'>";

                                    // BAIXA A QUANTIDADE DE ESTRELA "AVALIAÇÃO DO PRODUTO" E DESENHA A ESTRELA
                                    for($c = 1; $c <= $row['avaliacao']; $c++) {
                                        echo "<i class='fa fa-star'></i>";
                                    }

                                    echo "</div> ";

                                    echo "<div class='product-wid-price'>";
                                    echo "<ins>R$" . $row['preco'] . "</ins>";
                                    echo "</div> ";
                                    echo "</div> ";
                                }
                            }
                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End product widget area -->

                
                <!-- INCLUINDO FOOTER -->
                <?php include "_includes/footer.html" ?>
                <!-- FIM DO FOOTER -->
        </body>
    </html>

<?php include "_includes/scripts.html"; ?>