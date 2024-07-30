<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../public/css/geral.css">
    <link rel="stylesheet" href="../public/css/login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col-md-6 left-half"></div>
            <div class="col-md-6 right-half">
                <div class="card w-50">
                    <div class="card-header bg-white text-center mt-2">
                        <h2>Cadastro</h2>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=register" method="post">
                            <div class="form-group no-border">
                                <label for="username">Nome de usuário:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group no-border mt-2">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group no-border mt-2">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group no-border mt-2">
                                <label for="role">Eu sou:</label>
                                <select class="form-control" name="role">
                                    <option value="user">Cliente</option>
                                    <option value="admin">Empresa</option>
                                </select>
                            </div>
                            <div class="form-group no-border mt-3">
                                <input class="btn btn-primary btn-block" type="submit" value="Cadastrar">
                            </div>
                        </form>
                        <p class="text-center mt-3">Já é registrado? <a href="./Views/Login.php">Entrar</a></p>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
