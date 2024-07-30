<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../public/css/geral.css">
    <link rel="stylesheet" href="../public/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Entrar</title>
     
</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-6 left-half"></div>
            <div class="col-md-6 right-half">
                <div class="card w-50">
                    <div class="card-header bg-white text-center mt-2">
                        <h2>Acesse sua conta</h2>
                    </div>
                    <div class="card-body">
                        <form action="../index.php?action=login" method="post">
                            <div class="form-group no-border">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control " id="email" name="email" required>
                            </div>
                            <div class="form-group no-border mt-2">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control " id="password" name="password" required>
                            </div>
                            <div class="form-group no-border mt-3 ">
                                <input class="btn btn-primary btn-block" type="submit" value="Entrar">
                            </div>
                        </form>
                        <p class="text-center mt-3">Não possui uma conta? <a href="../index.php?action=register">Registrar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center fixed-footer">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Desenvolvido por:
            <a class="text-body" href="https://br.linkedin.com/in/osvaldo-protazio">Osvaldo Protazio</a>
        </div>
    </footer>
</body>
</html>


