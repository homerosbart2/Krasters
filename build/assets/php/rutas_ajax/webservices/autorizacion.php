<?php
    $direccion = $_GET["direccion"];
    $autorizacion = $_GET["autorizacion"];
    $tarjeta = $_GET["tarjeta"];
    $nombre = $_GET["nombre"]; 
    $fecha = $_GET["fecha_venc"];       
    $num_seguridad = $_GET["num_seguridad"];  
    $formato = $_GET["formato"]; 
    $monto = $_GET["monto"];
    $url = "https://".$direccion."/".$autorizacion."?tarjeta=".$tarjeta."&nombre=".$nombre."&fecha_venc=".$fecha."&num_seguridad=".$num_seguridad."&monto=".$monto."&formato=".$formato;
    echo $url;
    $json = file_get_contents($direccion);
    $data = json_decode($json,true);
    $informacion = $data['courrier'];
    foreach($informacion as $info){
        echo $info['text'];
        echo '<br>';
    }
?>