<?php
    $direccion = $_GET["direccion"];  
    $status = $_GET["status"]; 
    $orden = $_GET["orden"]; 
    $formato = $_GET["formato"]; 
    $url = "http://".$direccion."/".$status."?orden=".$orden."&tienda=krasters&formato=".$formato;
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>