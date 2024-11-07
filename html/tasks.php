<?php
// Arquivo de tarefas
$tasksFile = 'tasks.json';

// Função para carregar as tarefas do arquivo JSON
function loadTasks($tasksFile) {
    if (file_exists($tasksFile)) {
        $tasks = json_decode(file_get_contents($tasksFile), true);
        return is_array($tasks) ? $tasks : [];
    }
    return [];
}

// Função para salvar as tarefas no arquivo JSON
function saveTasks($tasksFile, $tasks) {
    file_put_contents($tasksFile, json_encode($tasks, JSON_PRETTY_PRINT));
}

// Carrega as tarefas existentes
$tasks = loadTasks($tasksFile);

// Processa o formulário se uma nova tarefa foi submetida
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskName = trim($_POST['task_name']);
    $taskDate = $_POST['task_date'];
    $taskTime = $_POST['task_time'];

    if (!empty($taskName) && !empty($taskDate) && !empty($taskTime)) {
        $tasks[] = [
            "name" => htmlspecialchars($taskName),
            "date" => $taskDate,
            "time" => $taskTime
        ];
        saveTasks($tasksFile, $tasks); // Salva a nova tarefa
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Tarefas</title>
    <style>
        /* Estilos básicos */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container {
            text-align: center;
            max-width: 400px;
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
        input[type="text"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
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
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .date-time {
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agenda de Tarefas</h1>

        <!-- Formulário para adicionar uma nova tarefa -->
        <form method="POST" action="">
            <input type="text" name="task_name" placeholder="Nome da tarefa" required>
            <input type="date" name="task_date" required>
            <input type="time" name="task_time" required>
            <button type="submit">Adicionar Tarefa</button>
        </form>

        <!-- Exibição das tarefas -->
        <h2>Tarefas Agendadas</h2>
        <ul>
            <?php foreach ($tasks as $task): ?>
                <li>
                    <strong><?php echo $task['name']; ?></strong>
                    <div class="date-time">
                        Data: <?php echo date("d/m/Y", strtotime($task['date'])); ?> às <?php echo $task['time']; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>