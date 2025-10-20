<!doctype html>
<html lang="es">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Inicia Sesión</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= URL ?>login" method="post">
                            <label>Usuario:</label>
                            <input class="form-control" type="text" name="usuario" id="usuario" required>
                            <br />
                            <label>Contraseña:</label>
                            <input class="form-control" type="password" name="contrasenia" id="contrasenia" required>
                            <br />
                            <button class="btn btn-success" type="submit">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>