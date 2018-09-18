<?php
    $autorizacion = $_GET["autorizacion"];
    $direccion = $_GET["direccion"];
    $total = $_GET["total"];
    $url = "http://".$direccion."/".$autorizacion."?";
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>