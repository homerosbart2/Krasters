<?php
    //Verifico existencias de los productos actuales antes de la compra
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    session_start();
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie
    $result_array = array();
    $query = "SELECT * FROM Carrito AS C WHERE C.usuario =  '$usuario'";
    $result = pg_query($link, $query); 
    $retorno = 0;
    $i = 0;
    while($row = pg_fetch_assoc($result)){
        $each_producto = $row["producto_id"];
        $cantidad_a_comprar = $row["cantidad"];
        $query = "SELECT E.existencia FROM Existencias AS E WHERE E.producto_id = $each_producto";
        $result2 = pg_query($link, $query); 
        $row2 = pg_fetch_assoc($result2);
        $cantidad_disponible = $row2["existencia"];
        if($cantidad_disponible < $cantidad_a_comprar){
            //error ya no disponible dicha cantidad
            $retorno = -1;
            $query = "UPDATE Carrito AS C SET cantidad = $cantidad_disponible WHERE  C.usuario='$usuario' AND C.producto_id = $each_producto";
            $result3 = pg_query($link, $query); 
        }
    }
    pg_close($link);
    //si retorno es -1 cambia la cantidad del carrito a la actualmente disponible y mostrare de nuevo los productos al usuario
    echo $retorno;    
?>