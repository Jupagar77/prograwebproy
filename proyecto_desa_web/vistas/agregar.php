<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" type="image/png" href="../images/mp4.png"/>
</head>
<body>

<div class="topnav">
    <a class="active" href="../index.php">Home</a>
    <a href="agregar.php">Registrarse</a>
    <a href="">Contactenos</a>
    <a href="">Sobre nosotros</a>
</div>

<main class="centrar_main">
    <div style="width: 50%" class="row-agregar">
        <h2>Registro de usuario
            <img style="    width: 40px;
    float: right;" src="../images/add-user.png">
        </h2>
        <div class="col-sm-12 ">
            <form action="../servicios.php" class="contact-edit row"
                  method="post" id="contacto">
                <input type="hidden" name="metodo" value="agregarUsuario"/>
                <div class="form-group">
                    <label for="nombre">Nombre de usuario</label>
                    <input maxlength="30" type="text" class="form-control" name="nombre" required id="nombre">
                </div>

                <div class="form-group">
                    <label for="email">Dirección electrónica</label>
                    <input maxlength="30" type="email" class="form-control" name="email" required id="email">
                </div>

                <div class="form-group">
                    <label for="password">Contrasena</label>
                    <input maxlength="30" type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="trabajo">Teléfono del trabajo</label>
                    <input maxlength="30" type="text" class="form-control" name="trabajo" id="trabajo" required>
                </div>

                <div class="form-group">
                    <label for="celular">Teléfono móvil</label>
                    <input maxlength="30" type="text" class="form-control" name="celular" id="celular" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección postal</label><br/>
                    <input maxlength="30" name="direccion" id="direccion" required>
                </div>

                <div class="form-group">
                    <button style="text-align: center; width: 100%" type="submit" class="btn btn-primary btnregistrar">Registrar</button>
                </div>

            </form>
        </div>
    </div>
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 pleft">
                <p class="font-weight-bold float-left">
                    <img src="../images/wifi.png" class="rounded-circle" alt="header">
                    <img src="../images/llama.png" class="rounded-circle" alt="header">

                </p>
            </div>
            <div class="col-sm-4 pcenter">
                <p class="font-weight-bold float-center">
                    <a class="" href="vistas/agregar.php">Registrarse</a>
                    <i class="mr-1 ml-1">|</i>
                    <a class="" href="#">Contactenos</a>
                    <i class="mr-1 ml-1">|</i>
                    <a class="" href="#">Sobre nosotros</a>
                </p>
            </div>
            <div class="col-sm-4 pright">
                <p class="font-weight-bold float-right">
                    <img src="../images/twiter.png" class="rounded-circle" alt="header">
                    <img src="../images/facebook.png" class="rounded-circle" alt="header">
                </p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>




