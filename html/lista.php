<?php
// Inicie a sessão
session_start();

// Verifique se a lista existe na sessão; caso contrário, crie uma lista vazia
if (!isset($_SESSION['item_list'])) {
    $_SESSION['item_list'] = [];
}

// Adiciona o item à lista se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['item_name'])) {
    $item_name = trim($_POST['item_name']);
    
    // Adiciona o item apenas se o nome não estiver vazio
    if (!empty($item_name)) {
        $_SESSION['item_list'][] = htmlspecialchars($item_name);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Dinâmica</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5em;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 80%;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 8px 16px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 8px;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Itens</h1>

        <!-- Formulário para adicionar itens -->
        <form method="POST" action="">
            <input type="text" name="item_name" placeholder="Nome do item" required>
            <button type="submit">Adicionar Item</button>
        </form>

        <!-- Lista de itens -->
        <ul>
            <?php
            // Exibe os itens da lista armazenada na sessão
            foreach ($_SESSION['item_list'] as $item) {
                echo "<li>" . $item . "</li>";
            }
            ?>
        </ul>

        <button><a href="tasks.php">proximo</a></button>
    </div>
</body>
</html>