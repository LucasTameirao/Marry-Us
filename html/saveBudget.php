<?php 
    include('../php/conexao.php');

    $valor = $_POST['valor'];
    $id_valor = $_POST['casamento'];


    $sql_code = "UPDATE casamento SET orcamento = '$valor' WHERE id = '$id_valor'";
    $sql_query = $mysqli -> query($sql_code);
    
    header('location: budget.php');
?>