<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tela de Cadastro</title>
</head>
<body>

    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="mt-5 shadow-lg p-3" style="min-width: 450px;">
                <h1>Cadastro</h1>
                <form action="saveUser.php" method="POST">
                    <div class="mb-3">
                        <label for=""><a href="index.php">voltar</a></label>
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" required placeholder="Insira seu nome aqui" name="nome" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" required placeholder="Insira seu sobrenome aqui" name="sobrenome" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" required name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Senha</label>
                        <input type="password" required name="senha" class="form-control">
                    </div>   

                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select name="sexo" id="" class="form-control">
                            <option value="0">selecione</option>
                            <option value="1">Prefiro não comentar</option>
                            <option value="2">Masculino</option>
                            <option value="3">Feminino</option>
                        </select>
                    </div>

                    <input type="submit" value="Cadastrar" name="confirmar" class="btn btn-success">
                </form>
            </div>
        </div>
    </div>
</body>
</html>