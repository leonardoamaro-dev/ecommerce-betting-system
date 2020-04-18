<?php
   session_start();
   require_once "..\_mysql\conn.php";
   
   // CASO J¡ ESTEJA LOGADO REDIRECIONA PARA O INDEX
   if (isset($_SESSION['login'])) {
	   header('location: ../');
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
                     <h2>Login</h2>
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
               <div class="col-md-8" style="margin: auto">
                  <div class="latest-product">            
                        <form class="needs-validation" action="actions/logar.php" method="POST">                       
						    <div class="mb-3">
                              <label for="email">Email</label>
                              <input type="text" class="form-control" name="email"  id="email"  required="">
                              <div class="invalid-feedback">
                                 Por favor digite um celular valido.
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="senha">Senha</label>
                              <input type="password" class="form-control" name="senha" id="senha"  required="">
                              <div class="invalid-feedback">
                                 Digite seu endere√ßo.
                              </div>
                           </div>         
                           <button name="login" class="btn btn-primary btn-lg btn-block" style="margin: auto" type="submit">Logar</button>
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