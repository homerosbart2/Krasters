<?php
    $courier = $_GET["courier"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "DELETE FROM Couriers WHERE courier_id=$courier";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $retorno = 0;
    }  
    pg_close($link);
    echo $retorno;    
?>