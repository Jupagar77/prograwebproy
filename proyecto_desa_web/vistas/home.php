<?php
include("../servicios.php");

if (!isset($_SESSION['login'])) {
    header("Location: " . getBaseUrl() . "../index.php");
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

$name = $_SESSION['username'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="shortcut icon" type="image/png" href="../images/mp4.png"/>
    <link href="../styles.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="topnav">
    <a class="active" href="home.php">Inicio</a>
    <a href="home.php?metodo=verPerfil">Perfil</a>
    <a href="home.php?metodo=vereditarperfil">Editar Perfil</a>
    <a href="">Ayuda</a>
    <a style="float: right;" href="../servicios.php?metodo=logOut">Cerrar Sesión</a>
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

<main class="centrar_main centrar_main_home">
    <div>

        <div>
            <?php
            if (isset($_POST['metodo'])) {

                 if ($_POST['metodo'] == 'editarusuario') {
                    echo editarusuario($_POST);
                    // echo 'Editar Usuario';
                }
            }
            ?>
        </div>

        <?php if(isset($_GET['metodo'])): ?>

            <?php
        if ($_GET['metodo'] == 'vereditarperfil') {
            echo vereditarperfil();
            //echo 'Hola mindo';
        }
            ?>
            <?php
            if($_GET['metodo'] == 'verPerfil'):

                ?>

                <?php echo ver_perfil_usuario(); ?>

            <?php endif; ?>

        <?php else: ?>

            <h2>Sus archivos en un lugar seguro.
                <img style="width: 40px; float: right;" src="../images/mp4.png">
            </h2>

            <form action='home.php' method='POST'>
                <input type="hidden" name="metodo" value="buscar" placeholder="Buscar"/>
                <input type="text" name="busqueda" placeholder="Buscar archivos"/>
                <button type="submit" name="submit"><img src="../images/busqueda.png"></button>
            </form>

            <table>
                <thead>
                <tr>
                    <th>
                        Archivo
                    </th>
                    <th>
                        Autor
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Categoria
                    </th>
                    <th>
                        Peso
                    </th>
                    <th>
                        Fecha
                    </th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($_POST['metodo'])) {
                    if ($_POST['metodo'] == 'buscar') {
                        $valor_buscado = $_POST['busqueda'];
                        if ($valor_buscado !== '') {
                            echo getFiles_HTML_FILTRO($_SESSION['username'], $valor_buscado);
                        } else {
                            echo getFiles_HTML($_SESSION['username']);
                        }
                    } else {
                        echo getFiles_HTML($_SESSION['username']);
                    }

                } else {
                    echo getFiles_HTML($_SESSION['username']);
                }
                ?>

                <tr id="last_row">

                    <td colspan="7" style="    border: darkseagreen solid 1px;
                    background: darkseagreen;">
                        <form action="../servicios.php" class="contact-edit row"
                              method="post" enctype="multipart/form-data" id="contacto">

                            <input type="hidden" name="metodo" value="agregarArchivo"/>
                            <input style="display: block" type="file" name="userfile" id="fileToUpload" value="Cargar">

                            <div class="styled-select blue semi-square" style="
                                margin: 5px 0px;
                        ">
                                <select class="dropdown" id="categoria" name="categoria[]">
                                    <option value="Comedia">Comedia</option>
                                    <option value="Terror">Terror</option>
                                    <option value="Familiar">Familiar</option>
                                    <option value="Educativo">Educativo</option>
                                    <option value="Entretenimiento" selected="true">Entretenimiento</option>
                                </select>

                            </div>

                            <input type="text" name="descripcion" placeholder="Descripcion" style="
    display: block;
    width: 235px;
"/>
                            <input type="submit" name="submit" value="Agregar" id="submit" style="
    display: block;
    margin-top: 5px;
    text-align: center;
    width: 25%;
"
                                   class="btnregistrar">

                        </form>
                    </td>

                </tr>

                </tbody>
            </table>

        <?php endif; ?>

    </div>

</main>

<div>
    <?php
    if (isset($_GET['metodo'])) {
        if ($_GET['metodo'] == 'verPerfil') {
            echo ver_perfil_usuario();
        }
        else if ($_GET['metodo'] == 'detallesArchivo') {
            echo detallesArchivo($data);
        }
    }
    ?>
</div>

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
                    <a class="btn btn-link" href="#">Inicio</a>
                    <i class="mr-1 ml-1">|</i>
                    <a class="btn btn-link" href="#">Ayuda</a>
                    <i class="mr-1 ml-1">|</i>
                    <a class="btn btn-link" href="../servicios.php?metodo=logOut">Cerrar Sesión</a>
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
