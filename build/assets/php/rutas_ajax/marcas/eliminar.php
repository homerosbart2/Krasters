<?php
    $marca = $_GET["marca"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "DELETE FROM Marcas WHERE marca_nombre='$marca'";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>