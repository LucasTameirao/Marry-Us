<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilo.css">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <div class="container">
      <div class="row">
        <div class="col">
          <form action="index.php" method="POST" class="center">
            <h1>Marry-Us</h1>
            <div><h2>Cadastro</h2></div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="name@example.com" name="email">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Senha</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Confirme a senha</label>
              <input type="password" class="form-control" name="password-check">
            </div>
            <div class="mb-3">
              <input type="submit" value="Enviar" class="btn btn-success">
            </div>
          </form>

          <div>
            <button><a href="lista.php">proxima</a></button>
          </div>
        </div>
    </div> 
  </body>
</html>