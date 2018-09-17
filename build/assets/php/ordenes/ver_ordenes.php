<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administración</title>    
    <link rel="stylesheet" href="../../css/bootstrap.min.css"  media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/bootstrap-select.css"  media="all" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"  type="text/javascript"></script> 
    <script src="../../js/bootstrap-select.js" type="text/javascript"></script> 
</head>

<?php
    include '../modules/nav.php';
?>
<html>
    <span class="separation l" id="listado-compras">
        <!-- LISTAR POR AJAX --> 
    </span>
</html>

<script>
    $(document).ready(function(){
        listarOrdenes();   

        $(document).on('click', '.ver-compras', function () {
            id = $(this).attr("id");
            compra = id.split("-")[0];
            ip = id.split("-")[1];
            estado = id.split("-")[2];
            formato = id.split("-")[3];
            $(location).attr('href','status.php?orden=' + compra + "&ip=" + ip + "&estado=" + estado + "&formato=" + formato);
        });

    }); 

    var listarOrdenes = function(){
        $.ajax({
            url: "../rutas_ajax/ordenes/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>#Orden</th>"
                    rows += "<th>Emisor</th>";
                    rows += "<th>Courier</th>";
                    rows += "<th>Lugar</th>";
                    rows += "<th>Tarjeta</th>";
                    rows += "<th>Total</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='10%'>" + obj[i - 1].compra_id + "</td>";
                        rows += "<td width='10%'>" + obj[i - 1].emisor_nombre + "</td>";
                        rows += "<td width='10%'>" + obj[i - 1].courier_nombre + "</td>";
                        rows += "<td width='10%'>" + obj[i - 1].lugar_nombre + "</td>";
                        longitud = (obj[i - 1].tarjeta).length;
                        ultimos4Tarjeta = (obj[i - 1].tarjeta).substring(longitud-4,longitud);
                        tarjeta = "x".repeat(longitud-4) + ultimos4Tarjeta;
                        rows += "<td width='10%'>" + tarjeta + "</td>"
                        rows += "<td width='10%'>" + obj[i - 1].total_compra + "</td>";
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].compra_id + "-" + obj[i - 1].direccion_ip + "-" + obj[i - 1].estado_path + "-" + obj[i - 1].formato + "' class='ver-compras' value='Ver compra'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado-compras").html(rows);
            }
        });
    } 
   
</script>