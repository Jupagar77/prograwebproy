<?php

include ("servicios.php");
//session_start();
// DEFINICION DE VARIABLES GLOBALES
$file_users = 'archivos/usuarios.txt';
$file_users_idx = 'archivos/usuarios_idx.txt';
$file_user_line = 'archivos/line_user.txt';
$split = '*';
//echo buscar_detalle_perfil('archivos/usuarios.txt', 0, 92);
echo buscar_elemento('archivos/usuarios.txt', 0, 87);


//$vec=obtener_vector_archivo($GLOBALS['file_users'], $GLOBALS['split']);
//var_dump(filtrar($vec, 'SON'));
//$a = 'How are you?';

//if (strpos($a, 'a') !== false) {
//    echo 'true';
//}
//echo getFiles_HTML('gerson');
//$vector_usuarios = obtener_vector_archivo($GLOBALS['file_users'], $GLOBALS['split']);
///var_dump($vector_usuarios);
//echo existe_usuario("gersonvargasgalvez@gmail4.com",'Gerson Vargas', $vector_usuarios) ? 'Existe' : 'No existe!';
// echo existe_usuario("gersonvargasgalvez@gmil.com", $vector_usuarios)?'Existe':'No existe!';
//if (!existe_usuario("gersonvargasgalvez@gmail4.com",'Gerson Vargas', $vector_usuarios)) {
//    $usuario = new usuario('Gerson Vargas', '70729949', '70729949', 'gersonvargasgalvez@gmail3.com', '1 km al norte de la escuela', 'admin123');
//
//    guardar_usuario($GLOBALS['file_users'], $GLOBALS['file_users_idx'], $GLOBALS['file_user_line'], $usuario);
//}