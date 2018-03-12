
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tareas Programacion Web - UNA - 115920802</title>

    <script rel="script" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <link rel="shortcut icon" type="image/png" href="../images/icon.png"/>

    <style rel="stylesheet">


    </style>
</head>
<body>

<header>
</header>

<div class="container">
    <div class="row">
        <h2>Registro de usuario</h2>
        <div class="col-sm-12">
            <form action="../servicios.php" class="contact-edit row"
                  method="post" id="contacto">
                <input type="hidden" name="metodo" value="agregarUsuario" />
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input maxlength="30" type="text" class="form-control" name="nombre" id="nombre">
                </div>

                <div class="form-group">
                    <label for="email">Dirección electrónica</label>
                    <input maxlength="30" type="email" class="form-control" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="password">Contrasena</label>
                    <input maxlength="30" type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group">
                    <label for="trabajo">Teléfono del trabajo</label>
                    <input maxlength="30" type="text" class="form-control" name="trabajo" id="trabajo">
                </div>

                <div class="form-group">
                    <label for="celular">Teléfono móvil</label>
                    <input maxlength="30" type="text" class="form-control" name="celular" id="celular">
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección postal</label>
                    <input maxlength="30" name="direccion" id="direccion" style="height: 90px; width: 100%">
                </div>

                <div class="form-group">
                    <button style="float: right" type="submit" class="btn btn-primary">Registrarse</button>
                </div>
                <div class="form-group">
                    <a style="; margin-right: 10px" href="index.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>




