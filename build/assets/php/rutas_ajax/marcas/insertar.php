<?php
    $nombre = $_GET["nombre"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Marcas(marca_nombre) VALUES('$nombre') RETURNING marca_nombre";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $rows = pg_fetch_assoc($result);
        $retorno = $rows["marca_nombre"];
    }  
    pg_close($link);
    echo $retorno;    
?>