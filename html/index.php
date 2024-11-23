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
    
    <header class="bg-primary border-bottom border-2 border-dark">
      <div class="d-flex justify-content-between py-2 px-3 bg-light">
        <h1 class="h3 mb-0">Marry-Us</h1>
        <nav>

        </nav>
      </div>
    </header>

    <main class="vh-100" style="overflow: hidden;">
      <div class="container">
        <h1 class="d-flex justify-content-center">Marry-Us</h1>
        <div class="d-flex justify-content-center align-items-center vh-100">
          <div class="p-4 bg-white rounded shadow" style="min-width: 450px;">
            <form action="process.php" method="POST">
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
                <a href="../html/functionPage.html" class="text-decoration-none"><input type="submit" value="Enviar" class="btn btn-success w-100 rounded-pills"></a>
              </div>
            </form>
          </div>
      </div>
    </main> 
  </body>
</html>