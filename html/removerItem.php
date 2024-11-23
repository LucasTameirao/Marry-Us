<?php
// Dados simulados - lista de itens
$items = isset($_SESSION['items']) ? $_SESSION['items'] : ['Item 1', 'Item 2', 'Item 3'];

// Remoção do item (caso seja solicitado via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item'])) {
    $itemToRemove = $_POST['item'];
    // Remove o item da lista
    $items = array_filter($items, function($item) use ($itemToRemove) {
        return $item !== $itemToRemove;
    });
    // Salva a lista atualizada na sessão
    session_start();
    $_SESSION['items'] = $items;
    echo json_encode($items); // Retorna a lista atualizada
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Item da Lista</title>
    <!-- Bootstrap para estilo (opcional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Itens</h1>
        <ul id="item-list" class="list-group">
            <?php foreach ($items as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($item) ?>
                    <button class="btn btn-danger btn-sm remove-btn" data-item="<?= htmlspecialchars($item) ?>">Remover</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Adiciona eventos de clique aos botões "Remover"
            document.querySelectorAll('.remove-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.getAttribute('data-item'); // Obtem o item a ser removido
                    
                    // Faz uma requisição POST via fetch para o servidor PHP
                    fetch('', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ item: item })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Atualiza a lista no DOM
                        const list = document.getElementById('item-list');
                        list.innerHTML = ''; // Limpa a lista atual
                        data.forEach(updatedItem => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item d-flex justify-content-between align-items-center';
                            li.innerHTML = `${updatedItem} <button class="btn btn-danger btn-sm remove-btn" data-item="${updatedItem}">Remover</button>`;
                            list.appendChild(li);
                        });
                        // Reaplica os eventos aos novos botões
                        attachRemoveEvents();
                    })
                    .catch(error => console.error('Erro:', error));
                });
            });
        });

        // Função para reaplicar eventos após atualização
        function attachRemoveEvents() {
            document.querySelectorAll('.remove-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.getAttribute('data-item');
                    fetch('', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ item: item })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const list = document.getElementById('item-list');
                        list.innerHTML = '';
                        data.forEach(updatedItem => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item d-flex justify-content-between align-items-center';
                            li.innerHTML = `${updatedItem} <button class="btn btn-danger btn-sm remove-btn" data-item="${updatedItem}">Remover</button>`;
                            list.appendChild(li);
                        });
                        attachRemoveEvents();
                    });
                });
            });
        }
    </script>
</body>
</html>