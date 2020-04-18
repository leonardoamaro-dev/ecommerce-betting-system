<?php
// CRÉDITOS LEONARDO AMARO

// INICIAR SESSÃO
session_start();

// INCLUIR A CONEXÃO MYSQL
require_once "../../_mysql/conn.php";

// FILTROS
function validation($name) {
	// VALIDAÇÃO DE CARACTERES
    $carateres_proibidos = array(' ',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º' );
    foreach($carateres_proibidos as $array) {
        if(strpos($_POST["$name"], $array)) {
           $_SESSION['error'] = 'Caracteres invalidos, campo: ' . $name;
        }
    }
}
	
// DETECTAR SE O BOTÃO LOGIN FOI CLICKADO
if(isset($_POST["login"])) {
	// VALIDAÇÃO CONTRA VERIFICANDO OS CARACTERES - CONTRA ATAQUE XSS
	validation("email");
	validation("senha");
	
	// VALIDAÇÃO CONTRA VERIFICANDO OS CARACTERES - CONTRA ATAQUE SQL INJECTION
	$email = mysqli_escape_string($conn, $_POST['email']);
	$senha = mysqli_escape_string($conn, $_POST['senha']);
	
	// CONEXÃO SQL
	$sql = "SELECT * FROM user WHERE email = '$email'";
	if ($result = $conn->query($sql)) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$dbsenha = $row['senha'];
			if (password_verify($senha, $dbsenha)) {
				$_SESSION['login'] = $row['id'];
				header('location: ../../');
			}
			else {
				$_SESSION['error'] = "Senha incorreta." . $row['senha'];
				header('location: ../');
			}
		}
		else {
			$_SESSION['error'] = "Email incorreto.";
			header('location: ../');
		}
	}
}
 
?>