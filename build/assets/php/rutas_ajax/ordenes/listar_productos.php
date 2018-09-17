<?php
//Lista los productos actuales del cliente
    $compra = $_GET["compra"];
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $result_array = array();
    $query = "SELECT * FROM DetalleCompras AS D, Marcas AS M, Productos AS P, Colores AS C WHERE D.detalle_compra_id=$compra AND D.color_nombre = C.color_nombre AND D.producto_id = P.producto_id AND M.marca_nombre = P.marca_nombre";
    $result = pg_query($link, $query); 
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $result_array[$i] = $row;
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);    
?>