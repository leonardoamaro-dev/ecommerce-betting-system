<?php
    require_once "../../_mysql/conn.php";
	
	if(isset($_POST['apostar'])) {
		$member_id = "1";
		$product_id = $_POST['produto'];
		$time = time();
		
		$sql = "INSERT INTO compras (member_id, product_id, time) VALUES ('$member_id', '$product_id', '$time')";
		if($conn->query($sql)){
			echo "funcionou";
		}
		else{
			echo "erro";
		}
	}
?>