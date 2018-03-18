<?php

include("clases/usuario.php");
include("clases/archivo.php");

//  GUARDAR USUARIO EN ARCHIVO


function guardar_usuario($file_users, $file_users_idx, $file_line, $usuario) {

    file_put_contents($file_users, $usuario->toString(), FILE_APPEND | LOCK_EX);
    //se crea el directorio con permisos de lectura y escritura
    mkdir("storage/" . $usuario->getNombre(), 0775);
    //guardar indice
    $n_car = strlen(utf8_decode($usuario->toString()));
    guardar_indice_usuario($file_users_idx, $file_line, $usuario->getEmail(), $usuario->getNombre(), $n_car);
}

function guardar_usuario2($file_users, $file_users_idx, $file_line, $usuario) {
    //echo $file_users.' '. $file_users_idx .' '.$file_line;
    file_put_contents($file_users, $usuario->toString(), FILE_APPEND | LOCK_EX);
    $n_car = strlen(utf8_decode($usuario->toString()));
    guardar_indice_usuario($file_users_idx, $file_line, $usuario->getEmail(), $usuario->getNombre(), $n_car);
}

function guardar_indice_usuario($file_users_idx, $file_line, $email, $nombre, $n_car) {
    $ub = leer_ultima_linea($file_line);
    $ub == '' ? $ub = 0 : $ub;
    $ubicacion = $ub + $n_car;
    $car = $email . "*" . $nombre . "*" . $n_car . "*" . $ub . "*1" . "\n";
    actualizarIndicesSesion($ub, $n_car);
    file_put_contents($file_users_idx, $car, FILE_APPEND | LOCK_EX);
    guardar_ultima_linea($file_line, $ubicacion);
}

function actualizarIndicesSesion($linea, $tam) {
    $_SESSION['linea_user'] = $linea;
    $_SESSION['tam_user'] = $tam;
}

function guardar_archivo($file_arc, $file_arch_idx, $file_line, $archivo) {
    file_put_contents($file_arc, $archivo->toString(), FILE_APPEND | LOCK_EX);
    //guardar indice
    $n_car = strlen(utf8_decode($archivo->toString()));
    $cadena = $archivo->getNombre() . '*' . $archivo->getAutor();
    guardar_indice_archivo($file_arch_idx, $file_line, $cadena, $n_car);
}

function guardar_indice_archivo($file_arch_idx, $file_line, $cadena, $n_car) {
    $ub = leer_ultima_linea($file_line);
    $ub == '' ? $ub = 0 : $ub;
    $ubicacion = $ub + $n_car;
    $car = $cadena . "*" . $n_car . "*" . $ub . "*1" . "\n";

    file_put_contents($file_arch_idx, $car, FILE_APPEND | LOCK_EX);
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
function existe_usuario($email, $user_name, $vector_usuarios) {
    if (count($vector_usuarios) == 1) {
        if (is_null($vector_usuarios[0])) {

            return false;
        }
    }
    for ($i = 0; $i < count($vector_usuarios); $i++) {
        if ($email === $vector_usuarios[$i]->getEmail() || $user_name === $vector_usuarios[$i]->getNombre()) {

            return true;
        }
    }

    return false;
}

function validar_usuario($usuario, $passwd, $vector_usuarios) {
    for ($i = 0; $i < count($vector_usuarios); $i++) {
        $vec = $vector_usuarios[$i];
        if (($usuario === $vec[0] || $usuario === $vec[1]) && $vec[4] == '1') {
            $usuario2 = buscar_elemento('archivos/usuarios.txt', $vec[3], $vec[2]);

            //var_dump($usuario2);
            $vec2 = explode('*', $usuario2);

            if ($vec2[4] === $passwd) {
                $_SESSION['linea_user'] = $vec[3];
                $_SESSION['tam_user'] = $vec[2];
                $_SESSION['username'] = $vec[1];
                return true;
            }
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
        // fclose($archivo);
    }
    return $VEC1;
}

function obtener_vector_archivo_idx($file, $split) {

    $VEC1[] = NULL;
    if (file_exists($file)) {

        $archivo = file($file);

        $cont = 0;
        while (list($var, $val) = each($archivo)) {

            $val2 = trim($val);
            //echo $val2;
            if ($val2 !== '') {
                $res = explode($split, $val2);
                $VEC1[$cont] = $res;
                $cont ++;
            }
            //echo "Line :" . $var . ' es ' . $val2 . '<br />';
        }
        // fclose($archivo);
    } else {
        // echo 'el archivo no existe';
        //el archivo no existe
    }
    return $VEC1;
}

function buscar_elemento($fichero, $n_linea, $tam) {
    $fp = fopen($fichero, 'r');
    fseek($fp, $n_linea);
    $data = fgets($fp, $tam);
    fclose($fp);
    return $data;
}

function buscar_detalle_perfil($file, $linea, $tam) {

    return generarHTML_PERFIL(buscar_elemento($file, $linea, $tam));
}

function generarHTML_PERFIL($val) {
    $vec = explode('*', $val);
    $detalle = '<h2>Perfil de Usuario
                <img style="width: 40px; float: right;" src="../images/user.png">
            </h2>';
    $detalle .= '<table class="tabladetalles">';
    $detalle .= '<tr></tr>';
    $detalle .= '<tr>';
    $detalle .= '<th>Nombre de usuario</th>';
    $detalle .= '<th>Teléfono del trabajo </th>';
    $detalle .= '<th>Teléfono móvil</th>';
    $detalle .= '<th>Dirección electrónica</th>';
    $detalle .= '<th>Dirección postal</th>';
    $detalle .= '</tr>';

    $detalle .= '<tr>';
    $detalle .= '<td><b>' . $vec[0] . '</b> </td>';
    $detalle .= '<td><b> ' . $vec[1] . '</b> </td>';
    $detalle .= '<td><b>' . $vec[2] . '</b> </td>';
    $detalle .= '<td><b>' . $vec[3] . '</b> </td>';
    $detalle .= '<td><b>' . $vec[5] . '</b> </td>';

    $detalle .= '</tr>';
    $detalle .= '</table>';

    return $detalle;
}

function generarHTML_USUARIOS($usuarios) {
    $detalle = '<h2>Seleccione usuario
                <img style="width: 40px; float: right;" src="../images/data.png">
            </h2>';

    $detalle .= '<table class="tabladetalles">';

    $detalle .= '<tr>';
    $detalle .= '<th>Nombre de usuario</th>';
    $detalle .= '<th>Seleccionar</th>';
    $detalle .= '</tr>
     
    <form method="get" action="../servicios.php">';

    $detalle .= '
    
    <input type="hidden" name="metodo" value="compartirArchivoFinal">
    <input type="hidden" name="ruta_archivo" value="' . $_GET['ruta_archivo'] . '">
    <input type="hidden" name="linea" value="' . $_GET['linea'] . '">
    <input type="hidden" name="tam" value="' . $_GET['tam'] . '">
    
    ';

    foreach ($usuarios as $usuario){
        if($usuario != $_GET['autor']){
            $detalle .= '<tr>';
            $detalle .= '<td><b>' . $usuario . '</b> </td>';
            $detalle .= '<td><b>

                <div class="radio">
                     <label><input type="radio" id="express" value="' . $usuario . '" name="optradio"></label>
                </div>

                    </b> </td>';
            $detalle .= '</tr>';
        }
    }

    $detalle .= '
        <tr style="border: darkseagreen solid 1px;
                    background: darkseagreen;">
        <td colspan="2">
        <button type="submit" class="btnregistrar" style="text-align: center">Compartir</button>
        
        </td>
        </tr>
        </form>
        </table>';
    return $detalle;
}

function generarHTML_PERFIL_EDITAR($val) {
    $vec = explode('*', $val);
    $detalle = '<h2>Editar perfil
                <img style="width: 40px; float: right;" src="../images/userEdit.png">
                </h2>';


    $detalle .= '<div style="width:400px;" class="editar-perfil">
            <form action="home.php" class="contact-edit row"
                  method="post" id="contacto">
                <input type="hidden" name="metodo" value="editarusuario" />
                <div class="form-group">
                    <label for="nombre">Nombre de usuario</label>
                    <input style="background: gainsboro" maxlength="30" type="text" class="form-control" name="nombre" disabled value="' . $vec[0]. '" required id="nombre">
                </div>

                <div class="form-group">
                    <label for="email">Dirección electrónica</label>
                    <input maxlength="30" type="email" class="form-control" value="' . $vec[3] .'" name="email" required id="email">
                </div>

                <div class="form-group">
                    <label for="password">Contrasena</label>
                    <input maxlength="30" type="password" class="form-control" value="' . $vec[4] .'" name="password" id="password" required>
                </div>

                <div class="form-group">
                    <label for="trabajo">Teléfono del trabajo</label>
                    <input maxlength="30" type="text" class="form-control" value="' . $vec[1] .'" name="trabajo" id="trabajo" required>
                </div>

                <div class="form-group">
                    <label for="celular">Teléfono móvil</label>
                    <input maxlength="30" type="text" class="form-control" value="' . $vec[2] .'" name="celular" id="celular" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección postal</label><br/>
                    <input maxlength="30" name="direccion" id="direccion" value="' . $vec[5] .'" required>
                </div>

                <div class="form-group">
                    <button style="text-align: center; width: 100%" type="submit" class="btn btn-primary btnregistrar">Editar</button>
                </div>

            </form>
        </div>';

    return $detalle;
}

function eliminardelarchivo($vec, $i) {
    $v = $vec[$i];
    // echo 'eliminar del archivo: ';
    //var_dump($v);
    $v[4] = 0;
    $vec[$i] = $v;
    return $vec;
}

function reescribe_indices_archivo($file, $vector) {
    $handle = fopen($file, "w+");
    for ($i = 0; $i < count($vector); $i++) {
        $vec = $vector[$i];
        //var_dump($vec);
        $linea = $vec[0] . "*" . $vec[1] . "*" . $vec[2] . "*" . $vec[3] . "*" . $vec[4] . "\n";
        fwrite($handle, $linea);
    }
    fclose($handle);
}

function filtrar($vector, $clave) {
    $vic_filter = [];
    $count = 0;
    for ($i = 0; $i < count($vector); $i++) {
        $valor = $vector[$i];

        /*if (preg_match('/\b'.$valor[0].'\b/',$clave))
         echo 'si';
        echo $valor[0].'   '.$clave.'<br />';*/
        //strpos($valor[0] . '', $clave) ? 'Si' : 'No';

        if (strpos($valor[0], $clave)) {
          //  if (preg_match('/\b'.$valor[0].'\b/',$clave)){
           // echo 'entra';
            $vic_filter[$count] = $valor;
            $count++;
        }
    }

    return $vic_filter;
}
