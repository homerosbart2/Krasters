<?php
    $id = $_GET["id"];
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion"];
    $autorizacion = $_GET["autorizacion"];
    $formato = $_GET["formato"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "UPDATE Emisores SET nombre = '$nombre',direccion_ip = '$direccion',autorizacion_path = '$autorizacion',formato = '$formato' WHERE emisor_id=$id";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 1;
    }  
    pg_close($link);
    echo $retorno;    
?>