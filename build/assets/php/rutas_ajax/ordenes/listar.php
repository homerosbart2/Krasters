<?php
//Lista los productos actuales del cliente
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    session_start();
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie
    $result_array = array();
    $query = "SELECT Co.compra_id, E.nombre as emisor_nombre, Cu.nombre as courier_nombre, L.nombre as lugar_nombre, Co.total_compra, Co.tarjeta, Cu.courier_id, Cu.estado_path, Cu.formato, Cu.direccion_ip FROM Compras AS Co,Emisores AS E, Couriers AS Cu, Lugares AS L WHERE Co.usuario='$usuario' AND Co.courier_id = Cu.courier_id AND Co.emisor_id = E.emisor_id AND Co.lugar_id = Co.lugar_id ORDER BY Co.compra_id";
    $result = pg_query($link, $query); 
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $result_array[$i] = $row;
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);    
?>