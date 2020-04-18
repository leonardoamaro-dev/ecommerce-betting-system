<?php
// INICIANDO SESSÃO
session_start();

// INCLUINDO CONEXÃO MYSQL
require_once "../../_mysql/conn.php";

// VERIFICA SE ESTÁ LOGADO - CASO ESTEJA VERIFICA SE A CONTA FOI VALIDADA CASO NÃO ESTEJA LOGADO VOLTA PARA O INDEX
if (isset($_SESSION['login'])) {
        $sqlValidation = "SELECT * FROM user WHERE id = '".$_SESSION['login']."'";
    if ($resultValidation = $conn->query($sqlValidation)) {
	    $rowValidation = $resultValidation->fetch_assoc();
	    if($rowValidation['verificada'] == 0) {
		     header('location: ../../cadastro/validacao.php');
	    }
    }
}
else {
	header('location:../../login');
}
	
// VERIFICANDO SE ALGUEM JÁ COMPROU O PRODUTO
$id = $_POST['id'];
$sql = "SELECT * FROM produtos WHERE id = '$id'";
$query = $conn->query($sql);
if ($row = $query->fetch_assoc()) {
	if ($row['cronometo_status'] == 1){
		$tempo = $row['restante'] - time();
		$minutos = $tempo / 60 % 60;
		$segundos = $tempo % 60;
		if($minutos <= 0 and $segundos <= 0) {
			if($row['ganhador'] == 0) {
				$member_id = $_SESSION['login'];
				$sql = "UPDATE produtos SET ganhador = '$member_id' WHERE id = '$id'";
				if($conn->query($sql)){
					echo "ganhador";
				}
				else{
					echo "erro";
				}
			}
			else {
				echo "não foi dessa vez";
				$_SESSION['error'] = "Desculpe, não foi dessa vez"; 
			}
		}
	}
}
?>