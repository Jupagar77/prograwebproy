<?php

include("clases/usuario.php");

//  GUARDAR USUARIO EN ARCHIVO


function guardar_usuario($file_users, $file_users_idx, $file_line, $usuario) {

    file_put_contents($file_users, $usuario->toString(), FILE_APPEND | LOCK_EX);
    //se crea el directorio con permisos de lectura y escritura
    mkdir("storage/".$usuario->getNombre(), 0775);
    //guardar indice
    $n_car = strlen(utf8_decode($usuario->toString()));
    guardar_indice_usuario($file_users_idx, $file_line, $usuario->getNombre(), $n_car);
}

function guardar_indice_usuario($file_users_idx, $file_line, $nombre, $n_car) {
    $ub = leer_ultima_linea($file_line);
    $ub=='' ? $ub = 0 : $ub;
    $ubicacion = $ub + $n_car;
    $car=$nombre . "*" . $n_car . "*" . $ub . "\n";

    file_put_contents($file_users_idx, $car, FILE_APPEND | LOCK_EX);
    guardar_ultima_linea($file_line, $ubicacion);
}

function leer_ultima_linea($file) {
    $data = file_get_contents($file);
    return $data;
}

function guardar_ultima_linea($fichero, $n_linea) {
    $handle = fopen($fichero, "w+");
    fwrite($handle, $n_linea);
    fclose($handle);
}

// Retorna el valor de un archivo dada la linea (bits) y 
// el tamano de la cadena que se quiere recuperar
function obtener_valor($fichero, $n_linea, $tam) {
    echo $n_linea . '- ' . $tam;
    $fp = fopen($fichero, 'r');
    fseek($fp, $n_linea);
    $data = fgets($fp, $tam);
    fclose($fichero);
    return $data;
}

function login($usuario, $passwd, $vector_usuarios) {
    return validar_usuario($usuario, $passwd, $vector_usuarios);
}

//define si  el usuario ya está registrado
function existe_usuario($email,$user_name, $vector_usuarios) {
    if (count($vector_usuarios) == 1) {
        if (is_null($vector_usuarios[0])) {

            return false;
        }
    }
    for ($i = 0; $i < count($vector_usuarios); $i++) {
        if ($email === $vector_usuarios[$i]->getEmail() ||$user_name === $vector_usuarios[$i]->getNombre()) {
          
            return true;
        }
    }

    return false;
}

function validar_usuario($usuario, $passwd, $vector_usuarios) {
    for ($i = 0; $i < count($vector_usuarios); $i++) {
        if (($usuario === $vector_usuarios[$i]->getEmail() || $usuario === $vector_usuarios[$i]->getNombre()) && $passwd === $vector_usuarios[$i]->getPassword()) {
        
            return true;
        }
    }
    return false;
}

// Lee un archivo y lo retorna en forma de vector

function obtener_vector_archivo($file, $split) {
    $VEC1[] = NULL;
    if (file_exists($file)) {
        $archivo = file($file);
        $cont = 0;
        while (list($var, $val) = each($archivo)) {
            // ++$var;

            $val2 = trim($val);
            //echo $val2;
            if ($val2 !== '') {
                $res = explode($split, $val2);
                //GERSON VARGAS GALVEZ*70729949*70729949*gersonvargasgalvez@gmail.com*admin123*Heredia, Home, Heredia
                //($nombre, $trabajo, $celular, $email, $direccion, $password)
                $user = new usuario($res[0], $res[1], $res[2], $res[3], $res[5], $res[4]);
                $VEC1[$cont] = $user;
                $cont ++;
            }
            //echo "Line :" . $var . ' es ' . $val2 . '<br />';
        }
         
    }
    return $VEC1;
}

function buscar_elemento($fichero, $n_linea, $tam) {
    echo $n_linea . '- ' . $tam;
    $fp = fopen($fichero, 'r');
    fseek($fp, $n_linea);
    $data = fgets($fp, $tam);
    fclose($fichero);
    return $data;
}

function buscar_detalle($linea, $tam) {
    echo generarHTML(buscar_elemento('contacto2.txt', $linea, $tam));
}



function generarHTML($val) {
    $vec = explode('*', $val);
    $detalle = '<div>';
    $detalle = '<h2>' . 'Usuario buscado: ' . '</h2>';
    $detalle .= '<b> Name ' . $vec[0] . '</b>';
    $detalle .= '<p> <b>Work:</b> ' . $vec[1] . '</p>';
    $detalle .= '<p><b> Mobile:</b> ' . $vec[2] . '</p>';
    $detalle .= '<p> <b>Email:</b> ' . $vec[3] . '</p>';
    $detalle .= '<p> <b>Address:</b> ' . $vec[4] . '</p>';
    $detalle .= '</div>';
    return $detalle;
}

function guardar_archivo($file, $file_idx, $file_line, $archivo) {
    file_put_contents($file, $archivo->toString(), FILE_APPEND | LOCK_EX);
    //guardar indice
    $n_car = strlen(utf8_decode($archivo->toString()));
    guardar_indice_usuario($file_idx, $file_line, $usuario->getNombre(), $n_car);
}
