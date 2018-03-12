<?php

include ("controler.php");
session_start();

// DEFINICION DE VARIABLES GLOBALES

$file_users = 'archivos/usuarios.txt';
$file_users_idx = 'archivos/usuarios_idx.txt';
$file_user_line = 'archivos/line_user.txt';
$split = '*';


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
        case "iniciarSesion":
            iniciarSesion($data);
            break;
        case "logOut":
            logout();
            break;
        case "eliminarArchivo":
            eliminarArchivo($data);
            break;
        default:
            break;
    }
} else {
    if ($data = $_GET) {
        switch ($data['metodo']) {
            case "logout":
                logout();
                break;
            default: break;
        }
    }
}

function iniciarSesion($data) {

    $_SESSION['login'] = false;
    $_SESSION['login_id'] = NULL;
    //$access_log = fopen($filename, "r");

    if (isset($data['email']) && isset($data['password'])) {
        $vector_usuarios = obetener_vector_archivo($GLOBALS['file_users'], $GLOBALS['split']);
        if (login($data['email'], $data["password"], $vector_usuarios)) {
            $_SESSION['login'] = true;
            $_SESSION['user_email'] = $data['email'];
            $_SESSION['login_id'] = $data['email'];
            $_SESSION['success_msg'] = "Inicio de sesion correcto!";

            header("Location: " . getBaseUrl() . "vistas/home.php");
        } else {
            $_SESSION['error_msg'] = "Usuario o password incorrectos, intente de nuevo.";
            header("Location: " . getBaseUrl() . "index.php");
        }
    }
//    if ($access_log) {
//        $index = NULL;
//        while (!feof($access_log)) {
//            $line = fgets($access_log);
//            $line = str_replace("\n", "", $line);
//            $email = substr($line, 4, strlen($line));
//            $email = str_replace("&", "", $email);
//            $id = (integer) (substr($line, 0, 4));
//            if ($id) {
//                if ($data["email"] == $email) {
//                    $index = $id;
//                }
//            }
//        }
//        fclose($access_log);
//
//        if ($index) {
//            $index -= 1;
//            $index = $index * 180;
//            $fp = fopen("archivos/usuariosDetalles.txt", 'r');
//            $dataFile = fgets($fp);
//            fseek($fp, $index);
//            $dataFile = fgets($fp);
//            $dataFile = substr($dataFile, 0, 180);
//            $password = str_replace('&', '', (substr($dataFile, 150, 30)));
//            if ($password == $data["password"]) {
//                $_SESSION['login'] = true;
//                $_SESSION['login_id'] = $index;
//                $_SESSION['success_msg'] = "Inicio de sesion correcto.";
//                header("Location: " . getBaseUrl() . "index.php");
//            } else {
//                $_SESSION['error_msg'] = "Credenciales invalidas, intente de nuevo.";
//                header("Location: " . getBaseUrl() . "index.php");
//            }
//        } else {
//            $_SESSION['error_msg'] = "El usuario no existe, favor registrarse o verificar las credenciales.";
//            header("Location: " . getBaseUrl() . "index.php");
//        }
//    }
}

function agregarUsuario($data) {
    if (isset($data["nombre"]) && $data["trabajo"] && $data["celular"] && $data["email"] && $data["direccion"] && $data["password"]) {
        $usuario = new usuario($data["nombre"], $data["trabajo"], $data["celular"], $data["email"], $data["direccion"], $data["password"]);
        guardar_usuario($GLOBALS['file_users'], $GLOBALS['file_users_idx'], $GLOBALS['file_user_line'], $usuario);
        $_SESSION['success_msg'] = "El usuario ha sido agregado, inicie sesión!";
        header("Location: " . getBaseUrl() . "index.php");
    } else {
        $_SESSION['error_msg'] = "El usuario no ha sido agregado.";
    }
//    $filename = "archivos/usuarios.txt";
//    $access_log = fopen($filename, "r");
//    if ($access_log) {
//        //if (!$data['indice']) {
//            if ($data["nombre"] && $data["trabajo"] && $data["celular"] && $data["email"] && $data["direccion"]) {
//                $i = 0;
//                while (!feof($access_log)) {
//                    $line = fgets($access_log);
//                    $i++;
//                }
//                fclose($access_log);
//                $index = str_pad($i, 4, "&");
//                $email = str_pad($data["email"], 30, "&");
//                $string = $index . $email . "\n";
//                $fileWrite = fopen($filename, "a");
//                fwrite($fileWrite, $string);
//                fclose($fileWrite);
//
//                $work = str_pad($data["trabajo"], 30, "&");
//                $mobile = str_pad($data["celular"], 30, "&");
//                $name = str_pad($data["nombre"], 30, "&");
//                $address = str_pad($data["direccion"], 30, "&");
//                $password = str_pad($data["password"], 30, "&");
//                $fileWrite = fopen("usuariosDetalles.txt", "a");
//                fwrite($fileWrite, $name);
//                fwrite($fileWrite, $work);
//                fwrite($fileWrite, $mobile);
//                fwrite($fileWrite, $email);
//                fwrite($fileWrite, $address);
//                fwrite($fileWrite, $password);
//                fclose($fileWrite);
//                $_SESSION['success_msg'] = "Usuario registrado con exito, ya puede iniciar sesion.";
//                header( "Location: " . getBaseUrl() . "index.php" );
//                exit;
//            }
    //} else {
    /* $i = 0;
      $access_log = fopen($filename, "r");
      $completeFile = "";
      while (!feof($access_log)) {
      $line = fgets($access_log);
      $i++;
      if ($i == $data['indice']) {
      $newName = str_pad($data["nombre"], 30, "&") . "\n";
      $line = substr_replace($line, $newName, 4, strlen($line));
      }
      $completeFile .= $line;
      }
      fclose($access_log);
      $fileWrite = fopen($filename, "w");
      fwrite($fileWrite, $completeFile);
      fclose($fileWrite);

      $detalles = file_get_contents("usuariosDetalles.txt");
      $detallesRewrite = "";
      $i = 0;
      for ($k = 0; $k < strlen($detalles); $k += 180) {
      $i++;
      $lineTwo = substr($detalles, $k, 180);
      if ($i == $data['indice']) {
      $name = str_pad($data["nombre"], 30, "&");
      $work = str_pad($data["trabajo"], 30, "&");
      $mobile = str_pad($data["celular"], 30, "&");
      $email = str_pad($data["email"], 30, "&");
      $address = str_pad($data["direccion"], 30, "&");
      $lineTwo = substr_replace($lineTwo, $name, 0, 30);
      $lineTwo = substr_replace($lineTwo, $work, 30, 30);
      $lineTwo = substr_replace($lineTwo, $mobile, 60, 30);
      $lineTwo = substr_replace($lineTwo, $email, 90, 30);
      $lineTwo = substr_replace($lineTwo, $address, 120, 30);
      $email = '';
      }
      $detallesRewrite .= $lineTwo;
      }
      $fileWrite = fopen("usuariosDetalles.txt", "w");
      fwrite($fileWrite, $detallesRewrite);
      fclose($fileWrite); */
    //}
    //}
}

function borrarUsuario($data) {
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

function mostrarUsuario($indice) {
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

function logout() {
    $_SESSION['login'] = false;
    $_SESSION['login_id'] = NULL;
    $_SESSION['success_msg'] = "Sesion cerrada.";
    header("Location: " . getBaseUrl() . "index.php");
}

function getBaseUrl() {
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

function getHost() {
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

function FileSizeConvert($bytes) {
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

function eliminarArchivo($data) {
    if (isset($data['ruta_archivo'])) {
            $archivo = $_POST['ruta_archivo'];
            unlink($archivo);
            echo $archivo;
             $_SESSION['success_msg'] = "Archivo eliminado.";
        }else{
             $_SESSION['error_msg'] = "El archivo no pudo ser eliminado.";
        }
       // header("Location: " . getBaseUrl() . "vistas/home.php");
       // header('Location: ../vistas/home.php');
}

function getFiles_HTML($directorio) {
    // echo getHost();
    $path = '../storage/' . $directorio . '/';
    $handle = opendir($path);
    $cadena = '';
    if ($handle) {
        while (false !== ($file = readdir($handle))) {
            if ($file !== '.' || $file !== '..') {
                $cadena .= '<tr>';
                $cadena .= "<form action='../servicios.php' method='POST'>";
                $peso = FileSizeConvert(filesize($path . $file));
                $cadena .= '<td>' . $file . '</td>';
                $cadena .= '<td><button type="submit" name="submit"><img src="../images/busqueda.png">Detalles</button></td>';
                $cadena .= '<td><button type="submit" name="submit"><img src="../images/descargar.png">Descargar</button></td>';
                $cadena .= '<td><button type="submit" name="submit"><img src="../images/compartir.png">Compartir</button></td>';
                $cadena .= '<td> <input type="hidden" name="metodo" value="eliminarArchivo" />'.
                        '<input type="hidden" name="ruta_archivo" value="storage/'.$directorio.'/'.$file.'"/>'
                        . '<button type="submit" name="submit"><img src="../images/borrar.png">Borrar</button></td>';

                $cadena .= '</form>';
                $cadena .= '</tr>';
            }
        }
        closedir($handle);
    }
    return $cadena;
}
