<?php
    $id = $_GET["id"];
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion"];
    $envio = $_GET["envio"];
    $estado = $_GET["estado"];
    $consulta = $_GET["consulta"];
    $formato = $_GET["formato"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "UPDATE Couriers SET nombre = '$nombre',direccion_ip = '$direccion',estado_path = '$estado',consulta_path = '$consulta',envio_path = '$envio',formato = '$formato' WHERE courier_id=$id";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 1;
    }  
    pg_close($link);
    echo $retorno;    
?>