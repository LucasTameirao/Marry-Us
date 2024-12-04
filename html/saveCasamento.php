<?php 
    include("../php/conexao.php");

    $nome1 = $_POST['nome1'];
    $nome2 = $_POST['nome2'];
    $genero1 = $_POST['genero1'];
    $genero2 = $_POST['genero2'];
    $data = (string)$_POST['datas'];

    $sql_code = "INSERT INTO casamento (nome1, genero1, nome2, genero2, datas) VALUES ('{$nome1}', '{$genero1}', '{$nome2}', '{$genero2}', '{$data}')";
    $sql_query = $mysqli -> query($sql_code);

    header('location: casamentos.php');
?>