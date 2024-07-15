<?php

function conectarDB() : mysqli{ //indica que tipo de return va a dar(en este caso una conexion mysqli)
    $db = mysqli_connect('localhost', 'root', 'root110394', 'bienesraices_crud');

    if(!$db) {
        echo 'Error al conectar a MySQL: ';
        exit;
    } 
    return $db;
}