<?php
    //encargado de editar existencia o crear nuevo producto copiando uno existente
    $talla = $_GET["talla"];
    $cantidad = $_GET["cantidad"];
    $color = $_GET["color"];
    $producto = $_GET["producto"];        
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT E.producto_id,E.existencia FROM Existencias as E WHERE (E.producto_id = $producto) AND (E.color_nombre = '$color') AND (E.talla = '$talla')"; 
    $result = pg_query($link, $query);
    $retorno = -4;
    if ($result) {
        $resultado = pg_num_rows($result);
        if($resultado > 0){
            $rows = pg_fetch_assoc($result);
            $existencias_actual = $rows["existencia"];
            if($cantidad < 0){
                //descontar cantidades
                if($existencias_actual >= ($cantidad * -1)){
                    //permitir
                    $query = "UPDATE Existencias as E SET existencia= E.existencia + $cantidad WHERE (E.color_nombre = '$color') AND (E.talla = '$talla')";
                    $result = pg_query($link, $query);
                    if($result) $retorno = -3;                       
                }else $retorno = $existencias_actual;
            }else{
                $query = "UPDATE Existencias as E SET existencia= E.existencia + $cantidad WHERE (E.color_nombre = '$color') AND (E.talla = '$talla')";
                $result = pg_query($link, $query);
                if($result) $retorno = -2;            
            }
        }else{
            $query = "INSERT INTO Existencias(producto_id,talla,existencia,color_nombre) VALUES($producto,'$talla',$cantidad,'$color')";
            $result = pg_query($link, $query);
            if($result) $retorno = -1;
        }
    }  
    pg_close($link);
    echo $retorno;
?>