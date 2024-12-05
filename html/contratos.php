<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Gerenciar PDFs</title>
    <style>
        .pdf-item 
        { 
            margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; 
        }
        .pdf-item iframe 
        { 
            width: 100%; height: 400px; 
        }
    </style>
</head>
<body>

    <header class="bg-primary border-bottom border-2 border-dark">
      <div class="d-flex justify-content-between py-2 px-3 bg-light">
        <h1 class="h3 mb-0">Marry-Us</h1>
        <nav>

        </nav>
      </div>
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

            <div class="d-flex w-100 justify-content-start mt-3 px-4">
                <div class="d-flex flex-column w-100">
                    <h1>Gerenciar Contratos</h1>

                    <!-- Formulário para Upload -->
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <label for="nome">Nome do PDF:</label><br>
                        <input type="text" name="nome" id="nome" required><br><br>

                        <label for="arquivo">Selecione o PDF:</label><br>
                        <input type="file" name="arquivo" id="arquivo" accept=".pdf" required><br><br>

                        <button type="submit">Enviar contrato</button>
                    </form>

                    <hr>

                    <h2>Arquivos Enviados</h2>
                    <div id="lista-pdfs">
                        <?php
                        // Conexão com o banco de dados
                        
                        include('../php/conexao.php');

                        // Busca PDFs no banco
                        $sql = "SELECT * FROM arquivos_pdf";
                        $result = $mysqli->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='pdf-item'>";
                                echo "<h3>" . htmlspecialchars($row['nome']) . "</h3>";
                                echo "<iframe src='" . htmlspecialchars($row['caminho_arquivo']) . "'></iframe>";
                                echo "<form action='delete.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <button type='submit'>Excluir</button>
                                    </form>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>Nenhum PDF enviado ainda.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>