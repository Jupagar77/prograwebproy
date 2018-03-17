<?php
include("servicios.php");

session_start();

if (isset($_SESSION['login'])) {
    header("Location: " . getBaseUrl() . "vistas/home.php");
}

$success_message = NULL;
if (isset($_SESSION['success_msg'])) {
    $success_message = $_SESSION['success_msg'];
    $_SESSION['success_msg'] = NULL;
}

$error_message = NULL;

if (isset($_SESSION['error_msg'])) {
    $error_message = $_SESSION['error_msg'];
    $_SESSION['error_msg'] = NULL;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link href="styles.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" type="image/png" href="images/mp4.png"/>
</head>
<body>

<div class="topnav">
    <a class="active" href="#">Inicio</a>
    <a href="vistas/agregar.php">Registrarse</a>
    <a href="">Contactenos</a>
    <a href="">Sobre nosotros</a>
</div>

<?php if (isset($error_message)): ?>
    <div class="errorMsg">
        <?php echo $error_message ?>
    </div>
<?php endif; ?>
<?php if ($success_message): ?>
    <div class="successMsg">
        <?php echo $success_message ?>
    </div>
<?php endif; ?>


<main class="centrar_main centrar_main_login">
    <div class="login-box">
        <div class="login-logo">
            <a href="">
                <img
                        src="images/mp4.png" alt="My Ad Cubes"></a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <h2 class="">Inicia sesion para acceder a tus archivos</h2>
            <form action="servicios.php" method="post" accept-charset="utf-8" class="login-form">
                <input type="hidden" name="metodo" value="iniciarSesion"/>
                <div class="form-group has-feedback">
                    <input type="text" name="email" value="" placeholder="Dirección electrónica - Nombre de Usuario" class="" id="login"
                           maxlength="80" size="30" required="true"> <span
                            class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" value="" placeholder="Contraseña" class=""
                           id="password" size="30" required="true">
                    <span class="glyphicon glyphicon-lock form-control-feedback">

                        </span>
                </div>
                <div class="row" style="text-align: center">
                    <div class="col-xs-12">
                        <input style="text-align: center;" type="submit" name="submit" value="Iniciar sesion" id="submit"
                               class="btn btn-primary btn-block btn-flat btnsesion">
                    </div>
                </div
            </form>

        </div><!-- /.login-box-body -->
    </div>
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 pleft">
                <p class="font-weight-bold float-left">
                    <img src="images/wifi.png" class="rounded-circle" alt="header">
                    <img src="images/llama.png" class="rounded-circle" alt="header">

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
                    <img src="images/twiter.png" class="rounded-circle" alt="header">
                    <img src="images/facebook.png" class="rounded-circle" alt="header">
                </p>
            </div>
        </div>
    </div>
</footer>

<?php session_destroy(); ?>
</body>
</html>