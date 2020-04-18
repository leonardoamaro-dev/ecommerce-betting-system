<?php
   session_start();
   require_once "..\_mysql\conn.php";
   
   // CASO JÁ ESTEJA LOGADO REDIRECIONA PARA O INDEX
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
                     <h2>Criar Conta</h2>
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
                        <h4 class="mb-3">Informações Pessoais</h4>
                        <form class="needs-validation" action="actions/cadastrar.php" method="POST">
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label for="firstName">Nome</label>
                                 <input type="text" class="form-control" name="nome" id="firstName" placeholder="" value="" required="">
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label for="lastName">Sobrenome</label>
                                 <input type="text" class="form-control" name="sobrenome" id="lastName" placeholder="" value="" required="">
                              </div>
                           </div>
						   <div class="row" style="margin-top: 0px">
                              <div class="col-md-6 mb-3">
                                 <label for="email">Email</label>
                                 <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required="">
                                 <div class="invalid-feedback">
                                    Por favor digite um email valido.
                                 </div>
                              </div>
						      <div class="col-md-6 mb-3">
                                 <label for="cel">Senha</label>
                                  <input type="password" class="form-control" name="senha" id="pass" required="">
                                 <div class="invalid-feedback">
                                    Por favor digite uma senha valido.
                                 </div>
                              </div>
						   </div>
						    <div class="mb-3">
                              <label for="cel">Celular</label>
                              <input type="text" class="form-control" name="celular" onkeypress="$(this).mask('(00) 00000-0000')" id="cel"  required="">
                              <div class="invalid-feedback">
                                 Por favor digite um celular valido.
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="address">Endereço</label>
                              <input type="text" class="form-control" name="end" id="address"  required="">
                              <div class="invalid-feedback">
                                 Digite seu endereço.
                              </div>
                           </div>
                  
                           <div class="row">
                              <div class="col-md-5 mb-3">
                                 <label for="country">Cidade</label>
                                 <input type="text" class="form-control" name= "cid" id="country"  required="">
                                 <div class="invalid-feedback">
                                   Selecione uma cidade valida.
                                 </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                 <label for="state">Estado</label>
                                 <select class="custom-select d-block w-100" name="est" id="state" required="">
                                     <option value="AC">Acre</option>
                                     <option value="AL">Alagoas</option>
                                     <option value="AP">Amapá</option>
                                     <option value="AM">Amazonas</option>
                                     <option value="BA">Bahia</option>
                                     <option value="CE">Ceará</option>
                                     <option value="DF">Distrito Federal</option>
                                     <option value="ES">Espírito Santo</option>
                                     <option value="GO">Goiás</option>
                                     <option value="MA">Maranhão</option>
                                     <option value="MT">Mato Grosso</option>
                                     <option value="MS">Mato Grosso do Sul</option>
                                     <option value="MG">Minas Gerais</option>
                                     <option value="PA">Pará</option>
                                     <option value="PB">Paraíba</option>
                                     <option value="PR">Paraná</option>
                                     <option value="PE">Pernambuco</option>
                                     <option value="PI">Piauí</option>
                                     <option value="RJ">Rio de Janeiro</option>
                                     <option value="RN">Rio Grande do Norte</option>
                                     <option value="RS">Rio Grande do Sul</option>
                                     <option value="RO">Rondônia</option>
                                     <option value="RR">Roraima</option>
                                     <option value="SC">Santa Catarina</option>
                                     <option value="SP">São Paulo</option>
                                     <option value="SE">Sergipe</option>
                                     <option value="TO">Tocantins</option>
                                     <option value="EX">Estrangeiro</option>
                                 </select>
                                 <div class="invalid-feedback">
                                    Selecione um estado valido.
                                 </div>
                              </div>
                              <div class="col-md-3 mb-3">
                                 <label for="zip">CEP</label>
                                 <input type="text" class="form-control" name="cep" id="zip" onkeypress="$(this).mask('00.000-000')" placeholder="" required="">
                                 <div class="invalid-feedback">
                                    Digite um CEP valido.
                                 </div>
                              </div>
                           </div>
                           <hr class="mb-4">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="same-address">
                              <label class="custom-control-label" for="same-address" checked>Eu li e concordo com os termos de uso.</label>
                           </div>
                                                                 
                           <hr class="mb-4">
                           <button name="cadastrar" class="btn btn-primary btn-lg btn-block" style="margin: auto" type="submit">Cadastrar</button>
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