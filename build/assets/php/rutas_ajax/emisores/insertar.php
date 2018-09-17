<?php
    $nombre = $_GET["nombre"];
    $direccion = $_GET["direccion"];
    $autorizacion = $_GET["autorizacion"];
    $formato = $_GET["formato"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Emisores(nombre,direccion_ip,autorizacion_path,formato) VALUES('$nombre','$direccion','$autorizacion','$formato')";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>