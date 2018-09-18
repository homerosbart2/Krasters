<?php
    $direccion = $_GET["direccion"];
    $autorizacion = $_GET["autorizacion"];
    $tarjeta = $_GET["tarjeta"];
    $nombre = $_GET["nombre"]; 
    $fecha = $_GET["fecha_venc"];       
    $num_seguridad = $_GET["num_seguridad"];  
    $formato = $_GET["formato"]; 
    $monto = $_GET["monto"];
    $nombre = urlencode($nombre);
    $url = "http://".$direccion."/".$autorizacion."?tarjeta=".$tarjeta."&nombre='$nombre'&fecha_venc=".$fecha."&num_seguridad=".$num_seguridad."&monto=".$monto."&formato=".$formato."&tienda=krasters";
    $respuesta = file_get_contents($url);
    echo $respuesta;
?>