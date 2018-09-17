<?php
    $nombre = $_GET["nombre"];
    $codigo = $_GET["codigo"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Lugares(lugar_id,nombre) VALUES('$codigo','$nombre')";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>