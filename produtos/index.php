<?php
    session_start();
    require_once "..\_mysql\conn.php";
	
	// VERIFICA SE ESTÁ LOGADO - CASO ESTEJA VERIFICA SE A CONTA FOI VALIDADA
	if (isset($_SESSION['login'])) {
        $sqlValidation = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
        if ($resultValidation = $conn->query($sqlValidation)) {
	        $rowValidation = $resultValidation->fetch_assoc();
	        if($rowValidation['verificada'] == 0) {
		       header('location: ../cadastro/validacao.php');
	        }
        }
    }
	
    //FAZ A CONEXÃO MYSQL PARA BAIXAR OS DADOS DO BANCO
    $id = $_GET['id'];
    $query = "SELECT * FROM produtos WHERE id = '$id'"; 

    // NOTIFICAR VENDEDOR QUE OCORREU A APOSTA FOI FEITA
    function notificarVendedor($member_id, $produto_id, $date, $conn, $query){
        // FAZ A CONEXÃO COM A TABELA PRODUTOS PARA PEGAR AS INFORMAÇÕES DO VENDEDOR
        if ($result = $conn->query($query)) {
            $row = $result->fetch_assoc();
            $vendedor_id = $row['membro_id'];
            // ENVIA A NOTIFICAÇÃO PARA A TABELA DE NOTIFICAÇÕES
            $querynotify = "INSERT INTO notifications (vendedor_id, member_id, mensagem, visto, data) VALUES ($vendedor_id, $member_id, 'teste', '0', '$date')";
		    if($conn->query($querynotify)){
			    echo "<script> console.log('[LEONARDO - LOGS] - Enviado notificação para o vendedor que à aposta foi feita') </script>";
		    }
        }
    }
?>

<!DOCTYPE html>
<!--
	@credits ustora and Leonardo Amaro
-->
<html lang="en">

<!-- INCLUINDO O HEAD -->
  <?php include "../_includes/head.html"; ?>
<!-- FIM DO HEAD -->

  <body>

    <!-- INCLUINDO O HEADER -->
       <?php include "../_includes/header.php"; ?>
    <!-- FIM DO HEADER -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Aposte, arrisque e ganhe !</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row"> 
                <div class="container">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Ínicio</a>
                            <a href="">produto</a>
                            <a href="">Sony Smart TV - 2015</a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                    <?php 
                                        // BAIXA A IMAGEM DO PRODUTO DO BANCO DE DADOS, ESSA É A PRINCIPAL
                                        if ($result = $conn->query($query)) {
                                            $row = $result->fetch_assoc();
                                            echo "<img src='img/". $row['id'] .".jpg' alt=''>";
                                        }
                                    ?> 
                                    </div>
                                    
                                    <div class="product-gallery">                        
                                        <?php 
                                            // BAIXA A IMAGEM DO PRODUTO DO BANCO DE DADOS, ESSA É AS THUMBS
                                            if ($result = $conn->query($query)) {
                                                $row = $result->fetch_assoc();
                                                echo "<img src='img/". $row['id'] .".jpg' alt=''>";
                                            }
                                        ?> 
                                    </div>
                                </div>
								<h3 style="color: #ca5a5a;font-size: 18px;text-transform: uppercase;font-weight: 600;">Atenção</h3>
								<i class="fa fa-truck" style="float: left;font-size: 21pt;color: #ab2828;"></i>
								<p style="color: #ca5a5a;font-size: 14px;float: left;margin-left: 10px;margin-top: 3px;">Frete não incluso</p>
								
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">
                                        <?php
                                            if ($result = $conn->query($query)) {
                                                $row = $result->fetch_assoc();
                                                echo $row['nome'];
                                            }
                                        ?>
                                    </h2>
                                    <div class="product-inner-price">
                                        <ins>
                                            <?php
                                                // BAIXA DA DB E MOSTRA O PREÇO DO PRODUTO
                                                if ($result = $conn->query($query)) {
                                                    $row = $result->fetch_assoc();
                                                    echo "R$" . $row['preco'];
                                                }
                                            ?>
                                        </ins> 
                                    </div>    
                                                                                      
                                    <div class="product-inner-category">
                                        <p>Categoria: 
                                        <a>
                                            <?php
                                                // BAIXA DA DB E MOSTRA A CATEGORIA DO PRODUTO
                                                if ($result = $conn->query($query)) {
                                                    $row = $result->fetch_assoc();
                                                    $categorias = ["Eletrônico", "Móveis"];
                                                    echo $categorias[$row['categoria']];
                                                }
                                            ?>
                                        </a>
                                        
                                        </p>
                                    </div>

                                    <form action="actions/apostar.php" method="POST">
									    <input type="text" name="produto" value="<?php echo $_GET['id']; ?>" hidden>
                                        <input type="submit" value="Apostar" name="apostar" class="button">
                                    </form>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descrição</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Descrição do produto</h2>  
                                                <?php
                                                    // BAIXA DA DB E MOSTRA AS TAGS
                                                    if ($result = $conn->query($query)) {
                                                        $row = $result->fetch_assoc();
                                                        echo $row['descricao'];
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
        </div>
    </div>

     <!-- INCLUINDO FOOTER -->
        <?php include "../_includes/footer.html" ?>
     <!-- FIM DO FOOTER -->
   
    <?php include "../_includes/scripts.html"; ?>
  </body>
</html>