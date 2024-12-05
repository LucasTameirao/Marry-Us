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

// Processa o formulário para adicionar, remover ou editar tarefas
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['task_name']) && !isset($_POST['edit_id'])) {
        // Adiciona uma nova tarefa
        $taskName = trim($_POST['task_name']);
        $taskDate = $_POST['task_date'];
        $taskTime = $_POST['task_time'];

        if (!empty($taskName) && !empty($taskDate) && !empty($taskTime)) {
            $tasks[] = [
                "id" => uniqid(), // Gera um ID único para a tarefa
                "name" => htmlspecialchars($taskName),
                "date" => $taskDate,
                "time" => $taskTime
            ];
            saveTasks($tasksFile, $tasks);
        }
    } elseif (isset($_POST['remove_id'])) {
        // Remove a tarefa com o ID correspondente
        $removeId = $_POST['remove_id'];
        $tasks = array_filter($tasks, function($task) use ($removeId) {
            return $task['id'] !== $removeId;
        });
        saveTasks($tasksFile, $tasks);
    } elseif (isset($_POST['edit_id'])) {
        // Edita a tarefa com o ID correspondente
        $editId = $_POST['edit_id'];
        foreach ($tasks as &$task) {
            if ($task['id'] === $editId) {
                $task['name'] = htmlspecialchars($_POST['task_name']);
                $task['date'] = $_POST['task_date'];
                $task['time'] = $_POST['task_time'];
                break;
            }
        }
        saveTasks($tasksFile, $tasks);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <title>Agenda de Tarefas</title>
    </head>
    <body>
        <header class="bg-primary border-bottom border-2 border-dark">
            <a href="functionPage.html" class="text-decoration-none text-dark">
                <div class="d-flex justify-content-start py-2 px-3 bg-light">
                    <h1 class="h3 mb-0">Marry-Us</h1>
                </div>
            </a>
        </header>

        <main>
            <div class="d-flex">
                <!--Aba de links para navegação-->
                <div class="bg-light d-flex shadow-lg m-0 pe-3" style="min-width: 384px;">
                    <nav>
                        <ul class="list-unstyled d-flex flex-column h-100 ps-2 pt-4">
                            <a href="budget.php" class="text-decoration-none text-white">
                                <li class="mb-5 bg-success rounded p-2">
                                    Itens para o casamento / Cálculo de Orçamentos
                                </li>
                            </a>  

                            <a href="tasks.php" class="text-decoration-none text-white">
                                <li class="mb-5 bg-success rounded p-2">
                                    Quadro de tarefas
                                </li>
                            </a>
                            
                            <a href="" class="text-decoration-none text-white">
                                <li class="mb-5 bg-success rounded p-2">
                                    Procura de Locais
                                </li>
                            </a> 

                            <a href="" class="text-decoration-none text-white">
                                <li class="mb-5 bg-success rounded p-2">
                                    Contratos
                                </li>
                            </a>

                            <a href="casamentos.php" class="text-decoration-none text-white">
                                <li class="mb-5 bg-success rounded p-2">
                                    Agendar Casamentos
                                </li>
                            </a>
                        </ul>
                    </nav>
                </div>
                
                <!--Formulário para anotar as tarefas-->
                <div class="p-3 bg-white radius-5 ms-4 w-100 shadow-sm">
                    <div>
                        <h1 class="text-center">Agenda de Tarefas</h1>

                        <!-- Formulário para adicionar uma nova tarefa -->
                        <form method="POST" action="" class="d-flex flex-column gap-3 mb-3">
                            <input type="text" class="form-control" name="task_name" placeholder="Nome da tarefa" required>
                            <input type="date" class="form-control" name="task_date" required>
                            <input type="time" class="form-control" name="task_time" required>
                            <div style="min-width: 10px;">
                            <button type="submit" class="btn btn-primary">Adicionar Tarefa</button>
                            </div>
                        </form>
                    </div>
                
                    <div>
                        <!-- Exibição das tarefas -->
                        <h2>Tarefas Agendadas</h2>
                        <ul class="list-unstyled">
                            <?php foreach ($tasks as $task): ?>
                                <li class="shadow-sm mb-4 rounded-bottom d-flex flex-column p-2">
                                    <strong><?php echo $task['name']; ?></strong>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            Data: <?php echo date("d/m/Y", strtotime($task['date'])); ?> às <?php echo $task['time']; ?>
                                        </div>
                                        
                                        <form method="POST" action="" class="d-inline">
                                            <input type="hidden" name="remove_id" value="<?php echo $task['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        
                                    </div>
                                </li>

                                <!-- Modal para editar tarefa -->
                                <div class="modal fade" id="editModal<?php echo $task['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Editar Tarefa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="" class="d-flex flex-column gap-3">
                                                    <input type="hidden" name="edit_id" value="<?php echo $task['id']; ?>">
                                                    <input type="text" class="form-control" name="task_name" value="<?php echo $task['name']; ?>" required>
                                                    <input type="date" class="form-control" name="task_date" value="<?php echo $task['date']; ?>" required>
                                                    <input type="time" class="form-control" name="task_time" value="<?php echo $task['time']; ?>" required>
                                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>