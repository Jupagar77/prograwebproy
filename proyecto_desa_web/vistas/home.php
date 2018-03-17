<?php
include ("../servicios.php");

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
        <title>HOME</title>

        <link href="../styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <header>
            <img src="../images/mp4_main.png" class="imglogo" alt="LOGO">   
            <div class="username">
                    <i>Bienvenid@: <?php echo $name ?> !</i>
                </div>
            <h1>ADMINISTRADOR DE ARCHIVOS (.MP4)</h1>
            
            <nav class="navbar navbar-inverse">
                <ul>
                    <li>
                        <a class="btn btn-primary btn-block btn-flat" href="#">AYUDA</a>
                    </li>
                    <li>
                        <div>
                            <form action="home.php" class="contact-edit row"
                                  method="GET">
                                <input type="hidden" name="metodo" value="verPerfil" />
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" name="submit" value="Ver Perfil" id="submit"
                                               class="btn btn-primary btn-block btn-flat">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </li>
                    <li>
                        <div>
                            <form action="home.php" class="contact-edit row"
                                  method="GET">
                                <input type="hidden" name="metodo" value="editarPerfil" />
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" name="submit" value="Editar Perfil" id="submit"
                                               class="btn btn-primary btn-block btn-flat">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </li>
                    <li>
                        <div>
                            <form action="home.php" class="contact-edit row"
                                  method="GET">
                                <input type="hidden" name="metodo" value="ocultarPerfil" />
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" name="submit" value="Ocultar Perfil" id="submit"
                                               class="btn btn-primary btn-block btn-flat">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </li>
                    <li>
                        <div>
                            <form action="../servicios.php" class="contact-edit row"
                                  method="post" id="contacto">
                                <input type="hidden" name="metodo" value="logOut" />
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" name="submit" value="Cerrar Sesión" id="submit"
                                               class="btn btn-primary btn-block btn-flat">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                </ul>
                
            </nav>

        </header>
        <main>

            <?php if (isset($error_message)): ?>
                <div class="errorMsg">
                    <?php echo $error_message ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success_message)): ?>
                <div class="successMsg">
                    <?php echo $success_message ?>
                </div>
            <?php endif; ?>

            <h2>Sus archivos en un lugar seguro!</h2>
            <div>   

                <table>

                    <thead>
                        <tr>
                            <!--archivo($fecha, $tamano, $descripcion, $clasificacion,$autor)-->
                            <th colspan="2">Administrador de Archivos</th>
                            <th colspan="3">
                                <form action='home.php' method='POST'>
                                    <input type="hidden" name="metodo" value="buscar" placeholder="Filtrar contenido..."/>
                                    <input type="text" name="busqueda" placeholder="Filtrar contenido..."/>
                                    <button type="submit" name="submit"><img src="../images/busqueda.png">Filtrar</button>
                                </form>
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
                            }
                        } else {
                            echo getFiles_HTML($_SESSION['username']);
                        }
                        ?>
                        <tr id="last_row">

                    <form action="../servicios.php" class="contact-edit row"
                          method="post" enctype="multipart/form-data" id="contacto">
                        <td>
                            <input type="hidden" name="metodo" value="agregarArchivo" />
                            Agregar nuevo:
                        </td>
                        <td colspan="1">
                            <input type="file" name="userfile" id="fileToUpload" value="Cargar">
                        </td>
                        <td colspan="1">
                            <label for="categoria">Categoría</label>
                            <select id="categoria" name="categoria[]">
                                <option value="Comedia">Comedia</option>
                                <option value="Terror">Terror</option>
                                <option value="Familiar">Familiar</option>
                                <option value="Educativo">Educativo</option>
                                <option value="Entretenimiento" selected="true">Entretenimiento</option>

                            </select>
                        </td>
                        <td>
                            <input type="text" name="descripcion" placeholder="Descripcion" value="" />
                        </td>
                        <td>
                            <input type="submit" name="submit" value="Agregar" id="submit"
                                   class="btn btn-primary btn-block btn-flat btn-sm">

                        </td>
                    </form>

                    </tr>

                    </tbody>
                </table>

            </div>

            <aside style="float: right">
                <?php
                if (isset($_GET['metodo'])) {
                    if ($_GET['metodo'] == 'editarPerfil') {
                        // echo ver_perfil_usuario();
                    } else if ($_GET['metodo'] == 'verPerfil') {
                        echo ver_perfil_usuario();
                    } else if ($_GET['metodo'] == 'detallesArchivo') {
                        echo detallesArchivo($data);
                    }
                }
                ?>

            </aside>

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
                            <a class="btn btn-link" href="#" >Terms of Use</a>
                            <i class="mr-1 ml-1">|</i>
                            <a class="btn btn-link" href="#">About</a>
                            <i class="mr-1 ml-1">|</i>
                            <a class="btn btn-link" href="#">Contact Us</a>
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
