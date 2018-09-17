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
    <span class="orders-list-container">
        <span class="orders-list" id="listado-compras">
            <!-- LISTAR POR AJAX -->
        </span>
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
                    for(var i = 1; i <= obj.length; i++){
                        rows+='<span class="o">';
                        rows+='<span class="information">';
                        rows+='<span class="order-number">';
                        rows+='#' + obj[i - 1].compra_id;
                        rows+='</span>';
                        rows+='<span class="order-courier">';
                        rows+= obj[i - 1].courier_nombre;
                        rows+='</span>';
                        rows+='<span class="order-place">';
                        rows+=obj[i - 1].lugar_nombre;
                        rows+='</span>';
                        rows+='<span class="order-total">';
                        rows+='Q. ' + obj[i - 1].total_compra + '.00';
                        rows+='</span>';
                        rows+='</span>';
                        rows+='<span class="state">';
                        rows+="<a class='btn-accept ver-compras' id='" + obj[i - 1].compra_id + "-" + obj[i - 1].direccion_ip + "-" + obj[i - 1].estado_path + "-" + obj[i - 1].formato + "'><i class='fas fa-info'></i> Estado</a>";
                        rows+='</span>';
                        rows+='</span>';
                    }                          
                }
                $("#listado-compras").html(rows);
            }
        });
    } 
   
</script>