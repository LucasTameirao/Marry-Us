<?php 
    include("../php/conexao.php");
    
    $nome = $_POST['nome'];
    $sobrenome = $_POST["sobrenome"];
    $password = $_POST["senha"];
    $email = $_POST["email"];
    $sexo = $_POST["sexo"];


    $insert = "INSERT INTO registeruser (nome, sobrenome, sexo, email, senha) VALUES ('{$nome}', '{$sobrenome}', '{$sexo}', '{$email}', '{$password}')";

    $res = $mysqli -> query($insert);
    header("Location: functionPage.html");
?>