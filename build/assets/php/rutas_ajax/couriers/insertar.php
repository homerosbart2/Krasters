<?php
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion "];
    $costo = $_GET["costo"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Couriers(nombre,direccion_ip,autorizacion_path,formato) VALUES('$nombre','$direccion','$autorizacion','$formato')";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>