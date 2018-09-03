<?php
    //encargado de retornar los productos
    $producto = $_GET["producto"];     
    $result_array = array(); //creamos un array
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT * FROM Productos AS P, Marcas AS M WHERE (P.marca_nombre = M.marca_nombre) ORDER BY P.producto_nombre";        
    $result = pg_query($link, $query); 
    $i = 0;
    while($each_producto = pg_fetch_assoc($result)){
        //tallas
        $producto = $each_producto["producto_id"];
        $query2 = "SELECT DISTINCT E.talla FROM Existencias AS E WHERE E.existencia > 0 AND E.producto_id = $producto  ORDER BY E.talla";
        $result2 = pg_query($link, $query2);
        $temp_tallas = array();
        $a = 0;
        while($row_tallas = pg_fetch_assoc($result2)){
            $temp_tallas[$a] = $row_tallas["talla"];
            $a++;
        }
        //marcas
        $query3 = "SELECT DISTINCT E.color_nombre FROM Existencias AS E,Colores AS C WHERE E.producto_id = $producto AND E.existencia > 0 AND (C.color_nombre = E.color_nombre)";
        $result3 = pg_query($link, $query3);
        $temp_colores = array();
        $b = 0;
        while($row_colores = pg_fetch_assoc($result3)){
            $temp_colores[$b] = $row_colores["color_nombre"];
            $b++;
        }        
        $result_array[$i] = array($each_producto,$temp_tallas,$temp_colores);
        $i++;
    }
    pg_close($link);
    echo json_encode($result_array);
?>