<html>
<head>
    <title>Krasters</title>
    <script src="../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../js/pnotify.custom.min.js" type="text/javascript"></script>
    <link href="../../css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="../../css/main.min.css" />    
</head>
<?php
    include '../modules/nav.php';
?>
</html>
<body>
    <div class="row col-md-12 col-sm-12 col-xs-12" style="margin:0; padding:0;">
        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0; padding:0; background-color: white; height:100%;"> 
            <!-- NO SE SI LO VAS A CAMBIAR PERO ASI ME GUSTA QUE SE VEA -->
            <!-- EN EL DIV SE METEN LOS PRODUCTOS -->
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10" style="margin:0; padding:0; background-color: white; height:100%;">      
            <div id="productos"> 
            </div>
        </div>      
    </div>
</body>

<style>
html, body {
    margin: 0;
    padding: 0;
}
</style>
<script>

function load_productos(){
    $.ajax({
        url: '../productos/listado.php?',
        type: 'GET',
        success: function(r){
            obj = JSON.parse(r);
            rows = "";
            for(var i = 1; i < obj.length; i++){
                rows += "<div class='listado-productos' style='border:solid 2px;'>";
                ruta = '../../img/productos/default.png';
                rows += "<td>" + '<img src="' + ruta + '" class="producto_preview" width=100 heigth=100>' + "</td>";
                rows += "nombre: " + obj[i - 1].producto_nombre;
                rows += "descripcion: " + obj[i - 1].descripcion;
                rows += "precio: " + obj[i - 1].precio;
                rows += "<a class='btn-register agregar-carrito' id='" + obj[i - 1].producto_id + "'><i class='fa fa-shopping-cart'></i> Agregar</a>";
                rows += "</div>";
            }
            $("#productos").html(rows);
        }        
    });
}

$(document).ready(function(){
    load_productos();
    
    $(document).on('click','.agregar-carrito',function(event){
        var div = $(this);
        var producto_id = div.attr('id');
        alert(producto_id);
    });     
});
</script>