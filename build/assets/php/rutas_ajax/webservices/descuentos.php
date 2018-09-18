<?php
    /*$autorizacion = $_GET["autorizacion"];
    $direccion = $_GET["direccion"];
    $total = $_GET["total"];*/
    $url = "http://192.168.0.104/tienda/descuento.php";
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>