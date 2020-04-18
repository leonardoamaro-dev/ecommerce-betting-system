<?php
   // créditos: Leonardo Amaro
   
   // INCLUIR DB CONNECT
   require_once '../_mysql/conn.php';

   // INICIANDO SESSÃO
   session_start();
 
   // VERIFICA SE JÁ ESTÁ LOGADO
   if (!isset($_SESSION['login'])) {
	   header('location: ../');
   }
   
   // VERIFICA SE A CONTA JÁ FOI VALIDADA
   $sql = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
   if ($result = $conn->query($sql)) {
	   $row = $result->fetch_assoc();
	   if($row['verificada'] == 1) {
		   header('location: ../');
	   }
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
   <body>
      <!-- INCLUINDO O HEADER -->
      <?php include "../_includes/header.php"; ?>
      <!-- FIM DO HEADER -->
      <div class="product-big-title-area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="product-bit-title text-center">
                     <h2>Validação de conta</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- CADASTRO AREA -->
	  <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="maincontent-area">
         <div class="zigzag-bottom"></div>
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="latest-product">
                        <h4 class="mb-3">
						    Por questões de segurança, você deve validar sua conta com um link que foi enviado no email 
						    <?php
							    $sql = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
                                if ($result = $conn->query($sql)) {
	                            $row = $result->fetch_assoc();
								echo $row['email'];
                                }
						    ?>
							.
						</h4>
						<form action="./actions/validacao.php" method="POST">
						     <button name="code" class="btn btn-primary btn-lg btn-block" style="margin: auto" type="submit">Enviar novamente</button>
                        </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- FIM CADASTRO AREA -->
      <!-- INCLUINDO FOOTER -->
      <?php include "../_includes/footer.html" ?>
      <!-- FIM DO FOOTER -->
      <!-- INCLUINDO SCRIPTS -->
      <?php include "../_includes/scripts.html"; ?>
      <!-- INCLUINDO SCRIPTS -->
   </body>
</html>