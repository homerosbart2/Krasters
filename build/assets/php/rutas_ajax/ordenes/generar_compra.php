<?php
    session_start();
    $descuento = $_GET["descuento"];
    $destinatario = $_GET["destinatario"];
    $direccion_ip = $_GET["direccion_ip"];
    $envio_path = $_GET["envio_path"];
    $direccion = $_GET["direccion"];
    $destino = $_GET["destino"];
    $envio = $_GET["envio"];    
    $total = $_GET["total"];
    $fecha_actual = $_GET["fecha_actual"];
    $tarjeta = $_GET["tarjeta"];
    $tarjeta_nombre = $_GET["tarjeta_nombre"];
    $courier = $_GET["courier"];
    $emisor = $_GET["emisor"];
    $lugar = $_GET["lugar"];
    $cvv = $_GET["cvv"];
    $fecha = $_GET["fecha_tarjeta"];
    $usuario = $_SESSION['username']; //variable que se obtiene con la cookie 
    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
    $query = "INSERT INTO Compras(emisor_id,courier_id,lugar_id,usuario,tarjeta,tarjeta_nombre,tarjeta_ccv,tarjeta_fecha,total_compra,fecha_compra,destino,costo_envio,direccion,destinatario) VALUES($emisor,$courier,'$lugar','$usuario','$tarjeta','$tarjeta_nombre','$cvv','$fecha',$total,'$fecha_actual','$destino',$envio,'$direccion','$destinatario') RETURNING compra_id";
    $result = pg_query($link, $query);
    $retorno = -1;
    if ($result) {
        $row = pg_fetch_assoc($result);
        $compra = $row["compra_id"];
        //Descontamos del inventario
        $query = "UPDATE Existencias E SET existencia = (E.existencia - C.cantidad) FROM Carrito C WHERE E.producto_id = C.producto_id";
        $result = pg_query($link, $query);    
        if($result){//guardo la compra solo se transfiere el carrito hacia DetallesCompra
            $query = "INSERT INTO DetalleCompras(producto_id,color_nombre,talla,cantidad) SELECT producto_id,color_nombre,talla,cantidad FROM Carrito AS C WHERE C.usuario = '$usuario' AND C.cantidad > 0 RETURNING detalle_compra_id";
            $result = pg_query($link, $query);
            if($result){
                while($row = pg_fetch_assoc($result)){
                    //se pone la llave foranea de la compra en los detalles de compra
                    $detalle_compra = $row["detalle_compra_id"];
                    $query2 = "UPDATE DetalleCompras as D SET compra_id=$compra WHERE (D.detalle_compra_id = $detalle_compra)";
                    pg_query($link, $query2);
                }
                //eliminamos todos los elementos del carrito ahora
                $query = "DELETE FROM Carrito WHERE usuario = '$usuario'";
                $result = pg_query($link, $query);            
                if($result){
                    //LISTO PROCESO DE COMPRA
                    //solicito el envio
                    $direccion = urlencode($direccion);
                    $destinatario = urlencode($destinatario);
                    $retorno = 1;
                    
                    $url = "http://".$direccion_ip."/".$envio_path."?orden=".$compra."&destinatario=".$destinatario."&destino=".$destino."&direccion=".$direccion."&tienda=Krasters";                 
                    // echo $url;
                    // file_get_contents($url);
                }
            }
        }
    }  
    pg_close($link);
    echo $retorno;    
?>