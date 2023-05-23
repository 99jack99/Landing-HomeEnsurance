<?php

include('server.php');

// La funcion del arhchivo es verificar datos y enviar datos correctamente.


// 1. Validaremos los campos del form

$nombre = '';
if (isset($_POST['nombre'])) {
    $nombre = formatearNombre($_POST['nombre']);
    $_SESSION['nombre'] = $nombre;
}

$apellidos = '';
if (isset($_POST['apellidos'])) {
    $apellidos = formatearNombre($_POST['apellidos']);
    $_SESSION['apellidos'] = $nombre;
}

$telefono = '';
if (isset($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
    $_SESSION['telefono'] = $telefono;
}

$email = '';
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
}

$codigo_postal = '';
if (isset($_POST['codigo_postal'])) {
    $codigo_postal = $_POST['codigo_postal'];
    $_SESSION['codigo_postal'] = $codigo_postal;
}

$termin = 0;
if (isset($_POST['termin'])) {
    $termin = (int) $_POST['termin'];
    $_SESSION['termin'] = $termin;
}

$otros = 0;
if (isset($_POST['otros'])) {
    $otros = (int) $_POST['otros'];
    $_SESSION['otros'] = $termin;
}


// comprovaciones de que no seal vacias

if (
    $nombre != '' &&
    $telefono != '' &&
    $personalizado1 != '' &&
    $personalizado2 != '' &&
    $personalizado3 != '' &&
    $personalizado4 != '' &&
    $codigo_postal != '' &&
    $termin == 1
) {

    //Guardo datos
    $data = array(
        "id_campana" => ID_CAMPANA,
        "id_afiliado" => ID_AFILIADOS,
        "version_form" => FORM_SEND,
        "canal" => CANAL_CAMPANYA,
        "sub_id_afiliado" => KEY,
        "personalizado10" => CONVERSION,

        "nombre" => $nombre,
        "email" => $telefono,
        "telefono" => $telefono,
        "codigo_postal" => $codigo_postal,
        "aceptacion_condiciones" => $termin,
        "ip" => IP_USUARIO
    );

    //hacemos llamada para enviar datos a la bbdd, y se lo enviamos con una var



    $id_user = sendUser($data);

    // devolver bien o mal dependiendo de la llamada
    //(este ejemplo tiene pasos, los cuales no replicaremos en este caso)
    
    header('Location: ' . $array_paginas[1] . '?error=repetido');

    if ($id_user != 0) {
        $_SESSION['id_usuario'] = $id_user;
        
        $_SESSION['paso1'] = 1;
        header('Location: ' . $array_paginas[2]);
    }
    else {

    //Envía al usuario de nuevo al formulario de datos
    header('Location: ' . $array_paginas[1]);
    }




};




?>