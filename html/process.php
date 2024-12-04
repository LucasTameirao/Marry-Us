<?php 
    include("../php/conexao.php");

    if(isset($_POST['email']) || isset($_POST['senha'])){
        if(strlen($_POST['email']) == 0) {
            echo "Preencha seu email";
        }
        else if(strlen($_POST['password']) == 0){
            echo "Preencha sua senha";
        }else {
            
            $email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['password']);

            $sql_code = "SELECT * FROM registeruser WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli -> query($sql_code);

            $quantidade = $sql_query -> num_rows;

            if($quantidade == 1){
                header('location: functionPage.html');
            } else{
                echo "<h1>Falha ao logar! E-mail ou senha incorretos</h1>";
            }
        }
    }
    
?>