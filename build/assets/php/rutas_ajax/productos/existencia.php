<?php
    //encargado de retornar los productos
    $producto = $_GET["producto"]; 
    $talla = $_GET["talla"]; 
    $color = $_GET["color"];     
    $retorno = -1;
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT E.existencia FROM Existencias AS E WHERE (E.color_nombre = '$color') AND (E.talla = '$talla') AND (E.producto_id = $producto)";        
    $result = pg_query($link, $query); 
    $i = 0;
    if($result){
        $row = pg_fetch_assoc($result);
        $retorno = $row["existencia"];
    }
    pg_close($link);
    echo $retorno;
?>