<?php 
    include("../php/conexao.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT email FROM email WHERE email = ?");
    $stmt->execute([$email]);

    $email = $stmt -> fetch();

    if($email){
        header("Location: functionPage.html");
    }

    
    
?>

