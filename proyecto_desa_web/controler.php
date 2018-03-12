<?php

include("clases/usuario.php");

//  GUARDAR USUARIO EN ARCHIVO


function guardar_usuario($file_users, $file_users_idx, $file_line, $usuario) {
    file_put_contents($file_users, $usuario->toString(), FILE_APPEND | LOCK_EX);
    //guardar indice
    $n_car = strlen(utf8_decode($usuario->toString()));
    guardar_indice_usuario($file_users_idx, $file_line, $usuario->getNombre(), $n_car);
}

function guardar_indice_usuario($file_users_idx, $file_line, $nombre, $n_car) {
    $ub = leer_ultima_linea($file_users_idx);
    $ubicacion = $ub + $n_car;
    file_put_contents($file_users_idx, $nombre . "," . $n_car . "," . $ub . "\n", FILE_APPEND | LOCK_EX);
    guardar_ultima_linea($file_line, $ubicacion);
}

function leer_ultima_linea($file) {
    $data = file_get_contents($file);
    return $data;
}

function guardar_ultima_linea($fichero, $n_linea) {
    $handle = fopen($fichero, "w+");
    fwrite($handle, $n_linea);
}

// Retorna el valor de un archivo dada la linea (bits) y 
// el tamano de la cadena que se quiere recuperar
function obtener_valor($fichero, $n_linea, $tam) {
    echo $n_linea . '- ' . $tam;
    $fp = fopen($fichero, 'r');
    fseek($fp, $n_linea);
    $data = fgets($fp, $tam);
    return $data;
}

function login($usuario, $passwd, $vector_usuarios) {
    return validar_usuario($usuario, $passwd, $vector_usuarios);
}

function validar_usuario($usuario, $passwd, $vector_usuarios) {
    
    for ($i = 0; $i < count($vector_usuarios); $i++) {
       
        if ($usuario === $vector_usuarios[$i]->getEmail() && $passwd === $vector_usuarios[$i]->getPassword()) {
           
            return true;
        }
    }
    return false;
}

// Lee un archivo y lo retorna en forma de vector

function obetener_vector_archivo($file, $split) {
    $VEC1[] = NULL;
    if (file_exists($file)) {
        $archivo = file($file);
        $cont = 0;
        while (list($var, $val) = each($archivo)) {
            // ++$var;
            $val2 = trim($val);
            $res = explode($split, $val2);
            //GERSON VARGAS GALVEZ*70729949*70729949*gersonvargasgalvez@gmail.com*admin123*Heredia, Home, Heredia
            //($nombre, $trabajo, $celular, $email, $direccion, $password)
            $user = new usuario($res[0], $res[1], $res[2], $res[3], $res[5], $res[4]);
            $VEC1[$cont] = $user;
            $cont ++;
            //echo "Line :" . $var . ' es ' . $val2 . '<br />';
        }
    }
    return $VEC1;
}


function guardar_archivo($file, $file_idx, $file_line, $archivo) {
    file_put_contents($file, $archivo->toString(), FILE_APPEND | LOCK_EX);
    //guardar indice
    $n_car = strlen(utf8_decode($archivo->toString()));
    guardar_indice_usuario($file_idx, $file_line, $usuario->getNombre(), $n_car);
}
