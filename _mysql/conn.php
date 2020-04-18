<?php
    // CONEXÃO BANCO DE DADOS - DESENVOLVIDO POR LEONARDO AMARO

    $db = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "clickspeed";

    $conn = mysqli_connect($db, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo "Falha na conexão: ". mysqli_connect_error();
    }
?>