<?php
//Lista los productos actuales del cliente
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $result_array = array();
    $query = "SELECT * FROM DetalleCompras";
    $result = pg_query($link, $query); 
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $result_array[$i] = $row;
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);    
?>