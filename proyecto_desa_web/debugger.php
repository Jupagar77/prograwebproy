<?php

include ("controler.php");
session_start();
// DEFINICION DE VARIABLES GLOBALES
$file_users = 'archivos/usuarios.txt';
$file_users_idx = 'archivos/usuarios_idx.txt';
$file_user_line = 'archivos/line_user.txt';
$split = '*';

$vector_usuarios = obtener_vector_archivo($GLOBALS['file_users'], $GLOBALS['split']);
var_dump($vector_usuarios);
echo existe_usuario("gersonvargasgalvez@gmail4.com",'Gerson Vargas', $vector_usuarios) ? 'Existe' : 'No existe!';
// echo existe_usuario("gersonvargasgalvez@gmil.com", $vector_usuarios)?'Existe':'No existe!';
//if (!existe_usuario("gersonvargasgalvez@gmail4.com",'Gerson Vargas', $vector_usuarios)) {
//    $usuario = new usuario('Gerson Vargas', '70729949', '70729949', 'gersonvargasgalvez@gmail3.com', '1 km al norte de la escuela', 'admin123');
//
//    guardar_usuario($GLOBALS['file_users'], $GLOBALS['file_users_idx'], $GLOBALS['file_user_line'], $usuario);
//}