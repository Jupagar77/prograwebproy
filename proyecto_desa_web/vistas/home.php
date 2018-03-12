<?php
include ("../servicios.php");


//session_start();
//if (!isset($_SESSION['login'])) {
//    header("Location: " . getBaseUrl() . "../index.php");
//}
//
//$success_message = NULL;
//if (isset($_SESSION['success_msg'])) {
//    $success_message = $_SESSION['success_msg'];
//    $_SESSION['success_msg'] = NULL;
//}
//
//$error_message = NULL;
//if (isset($_SESSION['error_msg'])) {
//    $error_message = $_SESSION['error_msg'];
//    $_SESSION['error_msg'] = NULL;
//}
//
//$name = mostrarUsuario($_SESSION['login_id']);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>HOME</title>

        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    </head>
    <body>

        <header>
            <nav class="navbar navbar-inverse">
                <ul>
                    <li>
                        <a href="#">AYUDA</a>
                        <br />
                        <a href="#">Ver perfil</a>
                        <br />
                        <a href="#">Editar perfil</a>
                        <div>
                            <form action="../servicios.php" class="contact-edit row"
                                  method="post" id="contacto">
                                <input type="hidden" name="metodo" value="logOut" />
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" name="submit" value="LOGOUT" id="submit"
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

            <div class="container">

                Bienvenido <?php //echo $name               ?> !

            </div>


            <h2>Sus archivos en un lugar seguro!</h2>
            <div>   
                <form action="index.php" method="POST">
                    <table>

                        <thead>
                            <tr>
                                <!--archivo($fecha, $tamano, $descripcion, $clasificacion,$autor)-->
                                <th>Nombre</th>
                                <th>Peso</th>
                                <th>Clasificación</th>
                                <th>Autor</th>
                                <th>Fecha creación</th>
                                <th>Por definir</th>                                
                            </tr>
                        </thead>
                        <tbody>                      
                            <?php                          
                            echo getFiles_HTML('gerson');
                            ?>
                            <tr>

                        <form action="../servicios.php" class="contact-edit row"
                              method="post" enctype="multipart/form-data" id="contacto">
                            <td>
                                <input type="hidden" name="metodo" value="logOut" />
                                Agregar nuevo:
                            </td>
                            <td>
                                <input type="file" name="userfile" id="fileToUpload" value="Cargar">
                            </td>
                            <td>
                                <label for="categoria">Categoría</label>
                                <select id="categoria">
                                    <option value="volvo">Comedia</option>
                                    <option value="saab">Terror</option>
                                    <option value="saab">Familiar</option>
                                    <option value="saab">Educación</option>
                                    <option value="mercedes" selected="true">Entretenimiento</option>

                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Agregar" id="submit"
                                       class="btn btn-primary btn-block btn-flat btn-sm">

                            </td>
                        </form>

                        </tr>



                        </tbody>
                    </table>
                </form>
            </div>

        </main>
        <footer>

        </footer>
    </body>
</html>
