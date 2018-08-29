<?php
    //encargado de retornar los productos
    $producto = $_GET["producto"];     
    $result_array = array(); //creamos un array
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "";
    if(!(empty($producto))){
        $query = "SELECT * FROM Productos AS P, Marcas AS M, Colores AS C WHERE (P.marca_nombre = M.marca_nombre) AND (P.color_nombre = C.color_nombre) AND (P.producto_id = $producto)";        
    }else{
        $query = "SELECT * FROM Productos AS P, Marcas AS M, Colores AS C WHERE (P.marca_nombre = M.marca_nombre) AND (P.color_nombre = C.color_nombre) AND (P.existencia > 0) ORDER BY P.producto_nombre";        
    }
    $result = pg_query($link, $query); 
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $result_array[$i] = $row;
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);
?>