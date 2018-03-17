<?php
include ("servicios.php");
//session_start();
//session_destroy();
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
        <title>HOME_LOGIN</title>

        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <header class="header">
             <img src="images/mp4_main.png" class="imglogo" alt="LOGO">
            <div>
           
            <h1>ADMINISTRADOR DE ARCHIVOS (.MP4)</h1>
            </div>
               
            
            <div class="">
                
                <nav>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="btn btn-link" href="#">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-link" href="#">Contact Us</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </header>
        <main class="centrar_main">
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

        <div class="login-box">
            <div class="login-logo">
                <a href="">
                    <img
                        src="images/mp4.png" alt="My Ad Cubes"></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Inicia sesion para acceder a tus archivos</p>
                <form action="servicios.php" method="post" accept-charset="utf-8">
                    <input type="hidden" name="metodo" value="iniciarSesion" />
                    <div class="form-group has-feedback">
                        <input type="text" name="email" value="" placeholder="Email o usuario" class="" id="login"
                               maxlength="80" size="30" required="true"> <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" value="" placeholder="Password" class=""
                               id="password" size="30" required="true">
                        <span class="glyphicon glyphicon-lock form-control-feedback">

                        </span>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" name="submit" value="Iniciar sesion" id="submit"
                                   class="btn btn-primary btn-block btn-flat btnsesion">
                        </div>
                    </div>
                </form>

                <div class="row" style="margin-top: 10px">
                    <div class="col-xs-12">
                        <a href="vistas/agregar.php" class="btn btn-info btn-block btn-flat btnregistrar">Registrarse</a>
                    </div>
                </div>

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
                            <a class="btn btn-link" href="#" >Terms of Use</a>
                            <i class="mr-1 ml-1">|</i>
                            <a class="btn btn-link" href="#">About</a>
                            <i class="mr-1 ml-1">|</i>
                            <a class="btn btn-link" href="#">Contact Us</a>
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