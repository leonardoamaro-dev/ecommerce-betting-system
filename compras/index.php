<?php
    session_start();
    require_once "..\_mysql\conn.php";
	
	// VERIFICA SE ESTÁ LOGADO - CASO ESTEJA VERIFICA SE A CONTA FOI VALIDADA CASO NÃO ESTEJA LOGADO VOLTA PARA O INDEX
	if (isset($_SESSION['login'])) {
        $sqlValidation = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
        if ($resultValidation = $conn->query($sqlValidation)) {
	        $rowValidation = $resultValidation->fetch_assoc();
	        if($rowValidation['verificada'] == 0) {
		       header('location: ../cadastro/validacao.php');
	        }
        }
    }
	else {
		//header('location:../');
	}
?>

<!DOCTYPE html>
<!--
	@credits ustora and Leonardo Amaro
-->
<html lang="pt-br">

<!-- INCLUINDO O HEAD -->
  <?php include "../_includes/head.html"; ?>
<!-- FIM DO HEAD -->

  <body onload="startCounting()">

    <!-- INCLUINDO O HEADER -->
       <?php include "../_includes/header.php"; ?>
    <!-- FIM DO HEADER -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Fique atento no cronometo !</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <!-- AGUARDANDO PAGAMENTO -->
	 <div class="maincontent-area">
                    <div class="zigzag-bottom"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-product">
                                    <h2 class="section-title">O CRONOMETO PODE SER LIBERADO A QUALQUER MOMENTO !</h2>
                                    <div class="product-carousel">
                                        <?php
                            //BAIXA OS PRODUTOS QUE OS CLIENTE COMPROU EM ORDEM QUE O CRONOMETO LIBERADO FICA NA FRENTE
                                $queryCompras = "SELECT * FROM compras ORDER BY id ASC";
                                $i = 1;
								$id_count = 0;
                                if ($result = $conn->query($queryCompras)) {
                                    while($row = $result->fetch_assoc() and $i <= 20){
										$i ++;
										$product_id = $row['product_id'];
										$queryProduct = "SELECT * FROM produtos WHERE id = '$product_id'";
										$resultP = $conn->query($queryProduct);
										$rowp = $resultP->fetch_assoc();
										if ($rowp['cronometo_status'] == 1) {
											$tempo = $rowp['restante'] - time();
										    $minutos = $tempo / 60 % 60;
										    $segundos = $tempo % 60;
										    $restante = $minutos . ":" . $segundos;
                                            echo "<div class='single-product'>";
                                            echo "<div class='product-f-image'>";
                                            echo "<img src='../produtos/img/". $product_id .".jpg' alt=''>";
                                            echo "<div class='product-hover-cronometro'>";    
									    	echo "<form action='actions/comprar.php' method='POST'> <input type='text' name='id' value=". $row['product_id'] ." hidden> <button name='compra' class='cronometro-button' id='". $id_count ."' type='submit'><i style='padding-right: 5px' class='far fa-clock'></i></i>$restante</button></form>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<h2> Click em comprar quando o cronometo liberar.</h2>";
                                            echo "<div class='product-carousel-price'>";
                                            echo "</div>";
                                            echo "</div>";
											$id_count ++;
										}
                                    }
								}
								
								if ($result = $conn->query($queryCompras)) {
									
									while($row = $result->fetch_assoc() and $i <= 20){
										$i ++;
										$product_id = $row['product_id'];
										$queryProduct = "SELECT * FROM produtos WHERE id = '$product_id'";
										$resultP = $conn->query($queryProduct);
										$rowp = $resultP->fetch_assoc();
								
										
										if ($rowp['cronometo_status'] != 1) {
                                           echo "<div class='single-product'>";
                                        	echo "<div class='product-f-image'>";
                                        	echo "<img src='../produtos/img/". $product_id .".jpg' alt=''>";
                                        	echo "<div class='product-hover'>";    
											echo "<form action='/produtos/' method='GET'> <input type='text' name='id' value=". $row['product_id'] ." hidden> <button class='add-to-cart-link' type='submit'><i class='fa fa-link'></i>Detalhes</button></form>";
                                        	echo "</div>";
                                        	echo "</div>";
                                        	echo "<h2> Aguarde a liberação do cronometo.</h2>";
                                        	echo "<div class='product-carousel-price'>";
                                        	echo "</div>";
                                        	echo "</div>";
										}
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
	<!-- FIM DO AGUARDANDO PAGAMENTO -->
	
	<!-- QUANTIDADE DE CRONOMETOS -->
     <?php echo "<input type='text' id='lenght' value=' ". $id_count ."' hidden>"; ?>
	 
     <!-- INCLUINDO FOOTER -->
        <?php include "../_includes/footer.html" ?>
     <!-- FIM DO FOOTER -->
   
    <!-- INCLUINDO SCRIPTS -->
        <?php include "../_includes/scripts.html"; ?>
	<!-- INCLUINDO SCRIPTS -->
  </body>
</html>