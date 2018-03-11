<?php
include ("servicios.php");
session_start();
if($_SESSION['login']){
    header( "Location: " . getBaseUrl() . "vistas/home.php" );
}

$success_message = NULL;
if($_SESSION['success_msg']){
    $success_message = $_SESSION['success_msg'];
    $_SESSION['success_msg'] = NULL;
}

$error_message = NULL;
if($_SESSION['error_msg']){
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
    <title>Document</title>

    <link href="styles.css" rel="stylesheet"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


</head>
<body>

<?php if($error_message):?>
<div class="errorMsg">
    <?php echo $error_message?>
</div>
<?php endif;?>

<?php if($success_message):?>
<div class="successMsg">
    <?php echo $success_message?>
</div>
<?php endif;?>

<div class="login-box">
    <div class="login-logo">
        <a href="">
            <img
                    src="images/mp4.png" alt="My Ad Cubes"></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Inicia sesion para acceder a tus datos</p>
        <form action="servicios.php" method="post" accept-charset="utf-8">
            <input type="hidden" name="metodo" value="iniciarSesion" />
            <div class="form-group has-feedback">
                    <input type="email" name="email" value="" placeholder="Email" class="form-control" id="login"
                       maxlength="80" size="30"> <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" value="" placeholder="Password" class="form-control"
                       id="password" size="30"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="submit" name="submit" value="Iniciar sesion" id="submit"
                           class="btn btn-primary btn-block btn-flat">
                </div>
            </div>
        </form>

        <div class="row" style="margin-top: 10px">
            <div class="col-xs-12">
                <a href="vistas/agregar.php" class="btn btn-info btn-block btn-flat">Registrarse</a>
            </div>
        </div>

    </div><!-- /.login-box-body -->
</div>


</body>
</html>