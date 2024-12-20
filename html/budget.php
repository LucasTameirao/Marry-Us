<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cálculo de Orçamento</title>
</head>
<body>
        <?php 
            include('../php/conexao.php');

            // Consulta para buscar as categorias
            $sql = "SELECT id, nome1, nome2 FROM casamento";
            $result = $mysqli->query($sql);

            // Cria as opções do <select>
            $options = "";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $options .= "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['nome1']) . ' e ' .htmlspecialchars($row['nome2']) . "</option>";
                }
            } else {
                $options .= "<option value=''>Nenhuma categoria encontrada</option>";
            }
        ?>

        <header class="bg-primary border-bottom border-2 border-dark">
            <a href="functionPage.html" class="text-decoration-none text-dark">
                <div class="d-flex justify-content-start py-2 px-3 bg-light">
                    <h1 class="h3 mb-0">Marry-Us</h1>
                </div>
            </a>
        </header>

        <main>
            <div class="d-flex min-vh-100 flex-grow-1">
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
    
                            <a href="contratos.php" class="text-decoration-none text-white">
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

                <div class="container d-flex ms-4 shadow-sm flex-column">
                    <div>
                        <h1 class="text-center">Cálculo de Orçamento</h1>
                        
                        <!-- Formulário para adicionar itens -->
                        <form id="itemForm" class="mb-4">
                            <div class="mb-3">
                                <input type="text" id="itemName" class="form-control" placeholder="Nome do item" required>
                            </div>
                            <div class="mb-3">
                                <label for="itemQuantity" class="form-label">Quantidade</label>
                                <input type="number" id="itemQuantity" class="form-control" required min="1">
                            </div>
                            <div class="mb-3">
                                <label for="itemPrice" class="form-label">Preço Unitário</label>
                                <input type="number" id="itemPrice" class="form-control" required min="0" step="0.01">
                            </div>
                            <button type="button" class="btn btn-primary" onclick="addItem()">Adicionar Item</button>
                        </form>
                    </div>

                    <div>
                        <!-- Lista de itens -->
                        <h3>Lista de Itens</h3>
                        <ul id="itemList" class="list-group mb-4"></ul>
                
                        <!-- Preço total -->
                        <h4>Total: <span id="totalPrice">R$ 0.00</span></h4>
                    </div>
                    <div class="d-flex justify-content-center flex-column">
                        <h2 class="text-center">Registrar valor</h2>
                        <form action="saveBudget.php" method="POST">
                            <label class="mb-2">Digite o valor total do orçamento</label>
                            <input type="text" class="form-control mb-3" name="valor">

                            <label>Escolha o casal para adicionar o preço do orçamento</label><br>
                            <select name="casamento">
                                <?php echo $options; ?>
                            </select>

                            <br>

                            <input type="submit" class="btn btn-primary mt-3" id="update">
                        </form>
                    </div>
                </div>
                <script>
                    // Função para adicionar um item à lista
                    let total = 0;  // Variável para controlar o total de preços
                    function addItem() {
                        // Obtém os dados do formulário
                        const itemName = document.getElementById('itemName').value;
                        const itemQuantity = document.getElementById('itemQuantity').value;
                        const itemPrice = parseFloat(document.getElementById('itemPrice').value);
            
                        // Verifica se os campos estão preenchidos corretamente
                        if (itemName && itemQuantity > 0 && itemPrice >= 0) {
                            const itemTotal = itemQuantity * itemPrice;  // Calcula o total para este item
                            total += itemTotal;  // Atualiza o total geral
            
                            // Cria um novo item na lista
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');
                            li.innerHTML = `${itemName} - Quantidade: ${itemQuantity} - Preço Unitário: R$ ${itemPrice.toFixed(2)} - Total: R$ ${itemTotal.toFixed(2)}`;
            
                            // Adiciona o item à lista
                            document.getElementById('itemList').appendChild(li);
            
                            // Atualiza o preço total na página
                            document.getElementById('totalPrice').innerText = `R$ ${total.toFixed(2)}`;
            
                            // Limpa os campos do formulário
                            document.getElementById('itemForm').reset();
                        } else {
                            alert("Por favor, preencha todos os campos corretamente.");
                        }
                    }
                </script>
            </div>
        </main>
</body>
</html>