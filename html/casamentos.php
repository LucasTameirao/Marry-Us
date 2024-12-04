<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Casamentos</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <header class="bg-primary border-bottom border-2 border-dark">
      <div class="d-flex justify-content-between py-2 px-3 bg-light">
        <h1 class="h3 mb-0">Marry-Us</h1>
        <nav>

        </nav>
      </div>
    </header>

    <Main>
        <div class="d-flex min-vh-100 flex-grow-1">
            <div class="bg-light d-flex shadow-lg m-0 pe-3" style="min-width: 384px;">
                <nav>
                    <ul class="list-unstyled d-flex flex-column h-100 ps-2 pt-4">
                        <a href="budget.html" class="text-decoration-none text-white">
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
                                Casamentos
                            </li>
                        </a>
                    </ul>
                </nav>
            </div>

            <div class="d-flex flex-column justify-content-center align-items-start pt-2 px-5 w-100">
                <div class="col d-flex w-100">
                    <div class="w-100">
                        <div>
                            <h1 class="text-center">Casamentos Agendados</h1>
                        </div>
                        <?php
                            include '../php/conexao.php';

                            $sql_code = "SELECT * FROM casamento ORDER BY id ASC";
                            $result = $mysqli->query($sql_code);

                            if ($result->num_rows > 0) {
                                echo '<table border="1" width="100%">
                                        <tr>
                                            <th>Nome</th>
                                            <th>Genero</th>
                                            <th>Nome</th>
                                            <th>Genero</th>
                                            <th>Data</th>
                                        </tr>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $row['nome1'] . '</td>
                                            <td>' . $row['genero1'] . '</td>
                                            <td>' . $row['nome2'] . '</td>
                                            <td>' . $row['genero2'] . '</td>
                                            <td>' . $row['datas'] . '</td>
                                        </tr>';
                                }
                                echo '</table>';
                            } else {
                                echo "Nenhum registro encontrado.";
                            }
                        ?>
                    </div>
                </div>
                <div class="col mt-3 d-flex w-100">
                    <div class="w-100">
                        <form action="saveCasamento.php" method="POST">
                            <div><h2 class="text-center">Criar um novo registro de casamento</h2></div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome do(a) noivo(a)</label>
                                <input type="text" class="form-control" placeholder="Caio/Maria" name="nome1">
                            </div>
                            <div class="mb-3">
                                <label for="">Genero do(a) noivo(a)</label>
                                <select name="genero1" class="form-control">
                                    <option value="Não informado">Prefiro não informar</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nome do(a) noivo(a)</label>
                                <input type="text" class="form-control" placeholder="Caio/Maria" name="nome2">
                            </div>
                            <div class="mb-3">
                                <label for="">Genero do(a) noivo(a)</label>
                                <select name="genero2" class="form-control">
                                    <option value="Não informado">Prefiro não informar</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Outros">Outros</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="">Data do Casamento</label>
                                <input type="date" class="form-control" name="datas">
                            </div>

                            <div class="mb-3">
                                <a href="../html/functionPage.html" class="text-decoration-none"><input type="submit" value="Cadastrar" class="btn btn-success w-100 rounded-pills"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </Main>

    <Footer>

    </Footer>
</body>
</html>