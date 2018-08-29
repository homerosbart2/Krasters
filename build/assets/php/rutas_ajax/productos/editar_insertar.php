<?php
    //encargado de editar existencia o crear nuevo producto copiando uno existente
    $nombre = $_GET["nombre"];
    $talla = $_GET["talla"];
    $cantidad = $_GET["cantidad"];
    $color = $_GET["color"];
    $marca = $_GET["marca"];
    $precio = $_GET["precio"];        
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "SELECT P.producto_nombre FROM Productos as P WHERE (P.producto_nombre = '$nombre') AND (P.talla = '$talla') AND P.color_nombre = '$color' AND P.marca_nombre = '$marca'"; 
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $resultado = pg_num_rows($result);
        if($resultado > 0){
            session_start();
            $query = "UPDATE Productos as P SET existencia= P.existencia + $cantidad WHERE P.producto_nombre = '$nombre' AND P.talla = '$talla' AND P.color_nombre = '$color' AND P.marca_nombre = '$marca'";
            $result = pg_query($link, $query);
            $retorno = 0;            
            //creamos las variables de sesion
        }else{
            $query = "INSERT INTO Productos(producto_nombre,precio,talla,existencia,color_nombre,marca_nombre) VALUES('$nombre',$precio,'$talla',$cantidad,'$color','$marca') RETURNING producto_id";
            $result = pg_query($link, $query);
            $row = pg_fetch_assoc($result);
            $retorno = $row["producto_id"];
        }
    }  
    pg_close($link);
    echo $retorno;
?>