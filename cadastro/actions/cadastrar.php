<?php
   // créditos: Leonardo Amaro
   
   // INCLUIR DB CONNECT
   require_once '../../_mysql/conn.php';

   // INICIANDO SESSÃO
   session_start();
 
   // VERIFICA SE JÁ ESTÁ LOGADO
   if (isset($_SESSION['login'])) {
	   header('location: ../');
   }
   
   // FILTROS
    function validation($name, $type, $conn) {
	   // VALIDAÇÃO DE CARACTERES
	   if ($type == "STRING") {
          $carateres_proibidos = array(',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º');
          foreach($carateres_proibidos as $array) {
              if(strpos($_POST["$name"], $array)) {
                 $_SESSION['error'] = 'Caracteres invalidos, campo: ' . $name;
              }
          }
	   }
	   
	   // VALIDAÇÃO DE NÚMEROS
	   else if ($type == "INT") {
		   if (!is_numeric($_POST["$name"])){
			    $_SESSION['error'] = 'Caracteres invalidos, campo: ' . $name;
		   }
	   }
	   
	   // VALIDAÇÃO DE SENHAS
	   else if ($type == "PASS") {
		   if (strlen($_POST["$name"]) < 8 or strlen($_POST["$name"]) > 20){
			   $_SESSION['error'] = 'A senha deve ser maior que 8 e menor que 20 caracteres';
		   }
	   }
	   
	   // VALIDAÇÃO DE EMAIL DUPLICADO
	   else if ($type == "EMAIL") {
		   $queryEmail = "SELECT * FROM user WHERE email = '$_POST[$name]'";
		   if ($resultEmail = $conn->query($queryEmail)) {
			   if ($resultEmail->num_rows > 0) {
				    $_SESSION['error'] = 'Esse email já está sendo usado.';
			   }
		   }
	   }
    }
	
    // SISTEMA DE CADASTRO
    if(isset($_POST["cadastrar"])) {
		// VALIDAR AS VARIAVEIS COM OBJETIVO DE FITLRAR ATAQUES HACKERS NO JAVA SCRIPT
		validation("nome", "STRING", $conn);
		validation("sobrenome", "STRING", $conn);
		validation("email", "STRING", $conn);
		validation("email", "EMAIL", $conn);
		validation("celular", "STRING", $conn);
		validation("end", "STRING", $conn);
		validation("cid", "STRING", $conn);
		validation("est", "STRING", $conn);
		validation("cep", "STRING", $conn);
		validation("senha", "PASS", $conn);
		
		// VALIDAR AS VARIAVEIS COM OBJETIVO DE FITLRAR ATAQUES HACKERS NO MYSQL
        $nome = mysqli_escape_string($conn, $_POST['nome']);
        $sobrenome = mysqli_escape_string($conn, $_POST['sobrenome']);
		$email = mysqli_escape_string($conn, $_POST['email']);
		$senha = mysqli_escape_string($conn, $_POST['senha']);
		$celular = mysqli_escape_string($conn, $_POST['celular']);
		$end = mysqli_escape_string($conn, $_POST['end']);
		$cid = mysqli_escape_string($conn, $_POST['cid']);
		$est = mysqli_escape_string($conn, $_POST['est']);
		$cep = mysqli_escape_string($conn, $_POST['cep']);
		
		// ENCRYPTA A SENHA
		$senha = password_hash($senha, PASSWORD_DEFAULT);

		if(!isset($_SESSION['error'])){
			// VERIFICA SE TEM ALGUN CAMPO VAZIO - CASO CONTRARIO ENVIA PARA O BANCO OS DADOS DOS USERS
			
            if(empty($nome) or empty($sobrenome) or empty($email) or empty($celular) or empty($end) or empty($cid) or empty($est) or empty($cep)) {
                $_SESSION['error'] = 'Campos de texto vazio, verifique e tente novamente.';
			    header('location: ../');
           }
            else {
				$time = time();
		    	$sql = "INSERT INTO user (email, senha, nome, sobrenome, celular, end, cid, est, cep, verificada, code, time) VALUES ('$email', '$senha', '$nome', '$sobrenome', '$celular', '$end', '$cid', '$est', '$cep', '0', '0', '$time')";
		    	if($conn->query($sql)){
		    		$_SESSION['success'] = 'Conta criada com sucesso';
					$sql = "SELECT * FROM user WHERE email = '$email'";
					if($result = $conn->query($sql)) {
						$row = $result->fetch_assoc();
						$_SESSION['login'] = $row['id'];
						header('location: ../validacao.php');
					}
		    	}
		    	else{
			    	$_SESSION['error'] = 'Erro ao criar a conta, comunique um administrador ' . $conn->error; //DESCOMENTE PARA MAIS INFORMAÇÕES SOBRE O ERRO
			    }
            }
		}
		else {
			header('location: ../');
		}
    }
?>