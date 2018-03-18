<?php

include("controler.php");
session_start();

// DEFINICION DE VARIABLES GLOBALES

$file_users = 'archivos/usuarios.txt';
$file_users_idx = 'archivos/usuarios_idx.txt';
$file_user_line = 'archivos/line_user.txt';

$file_archivo = 'archivos/archivo.txt';
$file_archivo_idx = 'archivos/archivo_idx.txt';
$file_archivo_line = 'archivos/line_archivo.txt';
$split = '*';

$indices = obtener_vector_archivo_idx($GLOBALS['file_archivo_idx'], $GLOBALS['split']);
$indices_usuarios_home = obtener_vector_archivo_idx('../' . $GLOBALS['file_users_idx'], $GLOBALS['split']);

if ($data = $_POST) {
    switch ($data['metodo']) {
        case "agregarUsuario":
            agregarUsuario($data);
            break;
        case "borrarUsuario":
            borrarUsuario($data);
            break;
        case "mostrarUsuario":
            mostrarUsuario($data);
            break;
        case "agregarArchivo":
            agregarArchivo($data);
            break;
        case "iniciarSesion":
            iniciarSesion($data);
            break;
        default:
            break;
    }
} else {
    if ($data = $_GET) {
        if (count($data) > 0) {
            switch ($data['metodo']) {
                case "logout":
                    logout();
                    break;
                case "descargarArchivo":
                    descargarArchivo($data);
                    break;
                case "detallesArchivo":
                    detallesArchivo($data);
                    break;
                case "eliminarArchivo":
                    eliminarArchivo($data);
                    break;
                case "compartirArchivoFinal":
                    compartirArchivo($data);
                    break;
                case "logOut":
                    logout();
                    break;
                default:
                    break;
            }
        }
    }
}

function iniciarSesion($data)
{

    $_SESSION['login'] = false;
    $_SESSION['login_id'] = NULL;
    if (isset($data['email']) && isset($data['password'])) {
        $vector_idx_usuarios = obtener_vector_archivo_idx($GLOBALS['file_users_idx'], $GLOBALS['split']);
        if (login($data['email'], $data["password"], $vector_idx_usuarios)) {
              $_SESSION['login'] = true;
              $_SESSION['user_email'] = $data['email'];
              $_SESSION['login_id'] = $data['email'];
              $_SESSION['success_msg'] = "Inicio de sesion correcto.";
              header("Location: " . getBaseUrl() . "vistas/home.php");
              exit();
          }
        $_SESSION['error_msg'] = "Usuario o password incorrectos, intente de nuevo.";
        header("Location: " . getBaseUrl() . "index.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Usuario o password incorrectos, intente de nuevo.";
        header("Location: " . getBaseUrl() . "index.php");
        exit();
    }
}

function agregarArchivo($data)
{
    //if(isset($_SESSION['username'])){
    $user_name = $_SESSION['username'];
    $target_dir = "storage/" . $user_name . '/';
    $nombre = $_FILES["userfile"]["name"];
    $url = $target_dir . $nombre;
    if(preg_match("/\.(mp4)$/", $nombre)){
    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $url)) {
        //$tam_file2 = $_FILES["userfile"]["size"];
        //$tam_file = FileSizeConvert($tam_file2);
        $descripcion = $_POST['descripcion'];
        $clasificacion = $_POST['categoria'];
        $autor = $user_name;
        $categoria = $clasificacion[0];
        $archivo = new archivo($nombre, $descripcion, $categoria, $autor, $url);
        // echo 'Tam archivo: ' . $tam_file . $_POST['descripcion'];
        guardar_archivo($GLOBALS['file_archivo'], $GLOBALS['file_archivo_idx'], $GLOBALS['file_archivo_line']
            , $archivo);
        $_SESSION['success_msg'] = "Archivo agregado con exito.";
    } else {
        $_SESSION['error_msg'] = "No se guardó el archivo.";
    }
    }else {
        $_SESSION['error_msg'] = "El servidor solo acepta archivos .mp4.";
    }
    header("Location: " . getBaseUrl() . "vistas/home.php");
    exit();
    ////}else {
    //    $_SESSION['error_msg'] = "La sesión no está activa.";
    //}
}

function compartirArchivo($data)
{
    $linea = $data['linea']; //40
    $tam = $data['tam']; //158
    $url = $data['ruta_archivo'];
    $datos = buscar_elemento($GLOBALS['file_archivo'], $tam, $linea);
    $vec = explode('*', $datos);

    $mainName = $vec[0];
    $mainName = explode('/',$mainName);
    if(count($mainName) > 1){
        $nombre =  $vec[0];
    }else{
        $nombre =  $vec[1] . '/' . $vec[0];
    }

    $descripcion =  $vec[3];
    $categoria =  $vec[2];
    $autor =  $_GET['optradio'];

    $archivo = new archivo($nombre, $descripcion, $categoria, $autor, $url);
    guardar_archivo($GLOBALS['file_archivo'], $GLOBALS['file_archivo_idx'], $GLOBALS['file_archivo_line']
        , $archivo);

    $_SESSION['success_msg'] = "Archivo compartido con exito.";
    header("Location: " . getBaseUrl() . "vistas/home.php");
    exit();
}

function agregarUsuario($data)
{
    if (isset($data["nombre"]) && $data["trabajo"] && $data["celular"] && $data["email"] && $data["direccion"] && $data["password"]) {
        $vector_usuarios = obtener_vector_archivo($GLOBALS['file_users'], $GLOBALS['split']);

        // var_dump($vector_usuarios);
        if (!existe_usuario($data["email"], $data["nombre"], $vector_usuarios)) { //si no existe el usuario, se debe agregar
            $usuario = new usuario($data["nombre"], $data["trabajo"], $data["celular"], $data["email"], $data["direccion"], $data["password"]);
            guardar_usuario($GLOBALS['file_users'], $GLOBALS['file_users_idx'], $GLOBALS['file_user_line'], $usuario);
            $_SESSION['success_msg'] = "El usuario ha sido agregado, ya puede iniciar sesión.";
            header("Location: " . getBaseUrl() . "index.php");
            exit();
        } else {
            $_SESSION['error_msg'] = "El usuario ya  está registrado.";
        }
    } else {
        $_SESSION['error_msg'] = "El usuario no ha sido agregado.";
    }
}

function borrarUsuario($data)
{
    if ($data['indice']) {
        $filename = "archivos/usuarios.txt";
        $indice = "0";
        $i = 0;
        $access_log = fopen($filename, "r");
        $completeFile = "";
        while (!feof($access_log)) {
            $line = fgets($access_log);
            $i++;
            if ($i == $data['indice']) {
                $line = substr_replace($line, '0   ', 0, 4);
            }
            $completeFile .= $line;
        }
        fclose($access_log);
        $fileWrite = fopen($filename, "w");
        fwrite($fileWrite, $completeFile);
        fclose($fileWrite);
    }
}

function mostrarUsuario($indice)
{

//    $index = $indice * 180;
//    $fp = fopen("archivos/usuariosDetalles.txt", "r");
//    $dataFile = fgets($fp);
//    fseek($fp, $index);
//    $dataFile = fgets($fp);
//    $dataFile = substr($dataFile, 0, 180);
//    return $nombre = str_replace('&', '', (substr($dataFile, 0, 30)));
//    $trabajo = str_replace('&', '', (substr($dataFile, 30, 30)));
//    $movil = str_replace('&', '', (substr($dataFile, 60, 30)));
//    $email = str_replace('&', '', (substr($dataFile, 90, 30)));
//    $direccion = str_replace('&', '', (substr($dataFile, 120, 30)));
}

function logout()
{
    $_SESSION['login'] = false;
    $_SESSION['login_id'] = NULL;
    $_SESSION['success_msg'] = "Sesion cerrada.";
    session_destroy();
    header("Location: " . getBaseUrl() . "index.php");
    exit();
}

function getBaseUrl()
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    // return: http://localhost/myproject/
    return $protocol . '://' . $hostName . $pathInfo['dirname'] . "/";
}

function getHost()
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF'];
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
    $pathInfo = pathinfo($currentPath);
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST'];
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
    // return: http://localhost/
    return $protocol . '://' . $hostName . "/";
}

function FileSizeConvert($bytes)
{
    $result = '';
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach ($arBytes as $arItem) {
        if ($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", ",", strval(round($result, 2))) . " " . $arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function eliminarArchivo($data)
{
    if (isset($data['ruta_archivo'])) {
        $archivo = $_GET['ruta_archivo'];
        $num = $_GET['numero'];
        $indices = $GLOBALS['indices'];
        unlink($archivo);
        // var_dump($indices);
        $GLOBALS['indices'] = eliminardelarchivo($indices, $num);
        //var_dump($GLOBALS['indices']);
        reescribe_indices_archivo($GLOBALS['file_archivo_idx'], $GLOBALS['indices']);
        // echo $archivo;
        $_SESSION['success_msg'] = "Archivo eliminado.";
    } else {
        $_SESSION['error_msg'] = "El archivo no pudo ser eliminado.";
    }
    header("Location: " . getBaseUrl() . "vistas/home.php");
    exit();
    // header('Location: ../vistas/home.php');
}

function descargarArchivo($data)
{
    if (isset($data['ruta_archivo'])) {
        $archivo = $data['ruta_archivo'];
        header("Location: " . $archivo);
        exit();
    } else {
        $_SESSION['error_msg'] = "El archivo no se puede descargar.";
    }
}

function detallesArchivo($data)
{
    $linea = $data['linea']; //40
    $tam = $data['tam']; //158
    $url = '../' . $data['ruta_archivo'];

    if($data['autor'] != $_SESSION['username']){
        $url = str_replace($_SESSION['username'] . '/','',$url);
    }

    $datos = buscar_elemento('../' . $GLOBALS['file_archivo'], $tam, $linea);
    $vec = explode('*', $datos);

    $detalle = '<h2>Archivo ' . $vec[0] . '
                <img style="width: 40px; float: right;" src="../images/mp464.png">
                </h2>';
    $detalle .= '<table class="tabladetalles">';
    $detalle .= '<tr>';
    $detalle .= '<th> Autor </th>';
    $detalle .= '<th> Categoría </th>';
    $detalle .= '<th> Descripción </th>';
    $detalle .= '<th> Peso </th>';
    $detalle .= '<th> Fecha modificación</th>';
    $detalle .= '</tr>';
    $detalle .= '<tr>';
    $detalle .= '<td><b>' . $vec[1] . '</b></td>';
    $detalle .= '<td> <b>' . $vec[2] . '</b></td>';
    $detalle .= '<td><b>' . $vec[3] . '</b></td>';
    $detalle .= '<td> <b> ' . FileSizeConvert(filesize($url)) . '</b></td>';
    $detalle .= '<td> <b> ' . date("F d Y H:i:s.", filectime($url)) . '</b> </td>';
    $detalle .= '</tr>';
    $detalle .= '</table>';

    $detalle .= '<div style="text-align: center"><video width="320" height="240" controls>
                  <source src="' . $url . '" type="video/mp4">
                  Your browser does not support the video tag.
                </video></div>';

    return $detalle;
}

function generar_detalle_archivo_HTML($file_archivo, $linea, $tam)
{
    //obtener_vector_archivo_idx($file, $split);
    $datos = buscar_elemento($file_archivo, $linea, $tam);
    $vec = explode('*', $datos);
    $detalle = '<div>';
    $detalle = '<h2>' . 'Detalles del archivo: ' . '</h2>';
    $detalle .= '<b> Autor ' . $vec[1] . '</b>';
    $detalle .= '<p> <b>Categoría:</b> ' . $vec[2] . '</p>';
    $detalle .= '<p><b> Mobile:</b> ' . $vec[3] . '</p>';
    $detalle .= '<p> <b>Email:</b> ' . $vec[3] . '</p>';
    $detalle .= '<p> <b>Address:</b> ' . $vec[4] . '</p>';
    $detalle .= '</div>';
    return $detalle;
}

function getFiles_HTML($directorio)
{
    $cadena = '';
    $indices = $indices = obtener_vector_archivo_idx('../' . $GLOBALS['file_archivo_idx'], $GLOBALS['split']);
    for ($i = 0; $i < count($indices); $i++) {
        $vector = $indices[$i];
        if ($vector[4] === '1' && $vector[1] === $directorio) {

            $nombre_archivo = $vector[1] . '/' . $vector[0];

            $datos = buscar_elemento('../archivos/archivo.txt', $vector[3], $vector[2]);
            $vec = explode('*', $datos);

            $fileName = $vector[0];
            $fileName = explode('/', $fileName);
            if(count($fileName) > 1){
                $autor = $fileName[0];
                $fileName = $fileName[1];
            }
            else{
                $autor = $vec[1];
                $fileName = $fileName[0];
            }

            $cadena .= '<tr>';
            $cadena .= '<td>' . $fileName . '</td>';
            $cadena .= '<td>' . $autor . '</td>';
            $cadena .= '<td>' . $vec[3] . '</td>';

            $cadena .= "
            <td class='acciones'>
           <a href='home.php?metodo=detallesArchivo&ruta_archivo=storage/" . $nombre_archivo . "&linea=" . $vector[2]
                . "&tam=" . $vector[3] . "&autor=" . $autor . "'> 
           
            <img src='../images/mp4det.png'>
           </a> 
           
           <a href='../servicios.php?metodo=descargarArchivo&ruta_archivo=" . getHost() . "prograwebproy/proyecto_desa_web/storage/" . $nombre_archivo . "&linea=" . $vector[2]
                . "&tam=" . $vector[3] . "'> 
           
            <img src='../images/descargar.png'>
           </a> 
      
           <a href='home.php?metodo=compartirArchivo&ruta_archivo=" . getHost() . "prograwebproy/proyecto_desa_web/storage/" . $nombre_archivo . "&linea=" . $vector[2]
                . "&tam=" . $vector[3] . "&autor=" . $autor . "'> 
           <img src='../images/compartir.png'>
           </a> 
      
           <a href='../servicios.php?metodo=eliminarArchivo&ruta_archivo=storage/" . $nombre_archivo . "&numero=" . $i
                . "&tam=" . $vector[3] . "'> 
           <img src='../images/borrar.png'>
           </a> 
            </td>
           ";

            $cadena .= '</tr>';
        }
    }
    return $cadena;
}

function getFiles_HTML_FILTRO($directorio, $valor_buscado)
{
    $cadena = '';
    $indices2 = $indices = obtener_vector_archivo_idx('../' . $GLOBALS['file_archivo_idx'], $GLOBALS['split']);
    //var_dump($indices);
    $indices = filtrar($indices2, $valor_buscado);
    for ($i = 0; $i < count($indices); $i++) {
        $vector = $indices[$i];
        if ($vector[4] === '1' && $vector[1] === $directorio) {
            $nombre_archivo = $vector[1] . '/' . $vector[0];
            $cadena .= '<tr>';
            $cadena .= '<td>' . $vector[0] . '</td>';
            $cadena .= "<form action='home.php' method='GET'>";
            $cadena .= '<td><input type="hidden" name="metodo" value="detallesArchivo" />' .
                '<input type="hidden" name="ruta_archivo" value="storage/' . $nombre_archivo . '"/>'
                . '<input type="hidden" name="linea" value="' . $vector[2] . '"/>'
                . '<input type="hidden" name="tam" value="' . $vector[3] . '"/>'
                . '<button type="submit" name="submit">'
                . '<img src="../images/busqueda.png">Detalles</button></td>';
            $cadena .= '</form>';
            $cadena .= "<form action='../servicios.php' method='POST'>";
            $cadena .= '<td><input type="hidden" name="metodo" value="descargarArchivo" />' .
                // '<input type="hidden" name="metodo" value="' . $i . '" />' .
                '<input type="hidden" name="ruta_archivo" value="' . getHost() . 'prograwebproy/proyecto_desa_web/storage/' . $nombre_archivo . '"/>'
                . '<button type="submit" name="submit"><img src="../images/descargar.png">Descargar</button></td>';
            $cadena .= '</form>';
            $cadena .= '<td><button type="submit" name="submit"><img src="../images/compartir.png">Compartir</button></td>';
            $cadena .= "<form action='../servicios.php' method='POST'>";
            $cadena .= '<td> <input type="hidden" name="metodo" value="eliminarArchivo" />' .
                '<input type="hidden" name="ruta_archivo" value="storage/' . $nombre_archivo . '"/>'
                . '<input type="hidden" name="numero" value="' . $i . '"/>'
                . '<button type="submit" name="submit"><img src="../images/borrar.png">Borrar</button></td>';
            $cadena .= '</form>';
            $cadena .= '</tr>';
        }
    }
    return $cadena;
}

function ver_perfil_usuario()
{
    $linea = (float)$_SESSION['linea_user'];
    $tam = (float)$_SESSION['tam_user'];
    //echo $tam;
    return generarHTML_PERFIL(buscar_elemento('../archivos/usuarios.txt', $linea, $tam));
}

function ver_usuarios_compartir()
{
    $usuarios = array();
    $handle = fopen("../archivos/usuarios.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if($_SESSION['username'] != explode('*',$line)[0])
                $usuarios[] = (explode('*',$line)[0]);
        }
        fclose($handle);
    } else {
        // error opening the file.
    }
    return generarHTML_USUARIOS($usuarios);
}

function vereditarperfil()
{
    $linea = (float)$_SESSION['linea_user'];
    $tam = (float)$_SESSION['tam_user'];
    //echo $tam;
    return generarHTML_PERFIL_EDITAR(buscar_elemento('../archivos/usuarios.txt', $linea, $tam));
}

function editarusuario($data)
{
    $nombre = $_SESSION['username'];
    $trabajo = $data['trabajo'];
    $celular = $data['celular'];
    $email = $data['email'];
    $direccion = $data['direccion'];
    $password = $data['password'];
    // echo $username;    
    $vector_idx_usuarios = $GLOBALS['indices_usuarios_home'];
    for ($i = 0; $i < count($vector_idx_usuarios); $i++) {
        $vec_val = $vector_idx_usuarios[$i];
        if ($vec_val[4] === '1' && $vec_val[1] === $nombre) {
            $vec_actualizado = eliminardelarchivo($vector_idx_usuarios, $i); //borrado logico
            reescribe_indices_archivo('../' . $GLOBALS['file_users_idx'], $vec_actualizado); //escritura
            agregarUsuarioEditar($nombre, $trabajo, $celular, $email, $direccion, $password);
            //$GLOBALS['indices_usuarios_home']=obtener_vector_archivo_idx('../' . $GLOBALS['file_users_idx'], $GLOBALS['split']);
            // var_dump($GLOBALS['indices_usuarios_home']);
        }
    }
}

function agregarUsuarioEditar($nombre, $trabajo, $celular, $email, $direccion, $password)
{
    $usuario = new
    usuario($nombre, $trabajo, $celular, $email, $direccion, $password);
    guardar_usuario2('../' . $GLOBALS['file_users'],
        '../' . $GLOBALS['file_users_idx'],
        '../' . $GLOBALS['file_user_line'], $usuario);
}
