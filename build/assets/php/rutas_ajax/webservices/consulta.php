<?php
    $direccion = $_GET["direccion"];
    $consulta = $_GET["consulta"];
    $destino = $_GET["destino"];  
    $formato = $_GET["formato"]; 
    $url = "http://".$direccion."/".$consulta."?destino=".$destino."&formato=".$formato;
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>