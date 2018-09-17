<?php
//Lista los productos actuales del cliente
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    session_start();
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie
    $result_array = array();
    $query = "SELECT Ca.carrito_id,P.producto_id, Ca.talla,P.producto_nombre,Co.color_nombre,Ca.cantidad,Co.color_codigo,P.descripcion,P.precio,M.marca_nombre,P.img_type as tipo_producto, M.img_type as tipo_marca FROM Carrito AS Ca, Colores AS Co, Productos AS P, Marcas AS M where Ca.cantidad > 0 AND Ca.usuario='$usuario' AND Ca.color_nombre = Co.color_nombre AND Ca.producto_id = P.producto_id AND P.marca_nombre = M.marca_nombre ORDER BY P.producto_nombre,Ca.carrito_id";
    $result = pg_query($link, $query); 
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $result_array[$i] = $row;
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);    
?>