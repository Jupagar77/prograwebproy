<?php


include ("../servicios.php");


//session_start();
if(!isset($_SESSION['login'])){
    header( "Location: " . getBaseUrl() . "../index.php" );
}

$success_message = NULL;
if(isset($_SESSION['success_msg'])){
    $success_message = $_SESSION['success_msg'];
    $_SESSION['success_msg'] = NULL;
}

$error_message = NULL;
if(isset($_SESSION['error_msg'])){
    $error_message = $_SESSION['error_msg'];
    $_SESSION['error_msg'] = NULL;
}

$name = mostrarUsuario($_SESSION['login_id']);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="../styles.css" rel="stylesheet"/>

</head>
<body>

<nav class="navbar navbar-inverse">

</nav>

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

<div class="container">

    Bienvenido <?php echo $name?> !

</div>

</body>
</html>
