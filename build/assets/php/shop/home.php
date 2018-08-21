<html>
<head>
    <title>Krasters</title>   
</head>
<?php
    include '../modules/nav.php';

?>
</html>
<body>
    <div id="productos" class="products-container"> 
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
            for(var i = 1; i <= obj.length; i++){
                ruta = '../../img/productos/default.jpg';
                rows += "<div class='product-card'>";
                rows += "<img src='"+ruta+"'>";
                rows += "<span class='information'>";
                rows += "<span class='name'>" + obj[i - 1].producto_nombre + "</span>";
                rows += "<span class='description'>" + obj[i - 1].descripcion + "</span>";
                rows += "<span class='price'>Q " + obj[i - 1].precio + "</span>";
                rows += "<span class='separation m'></span>";
                rows += "<a class='btn-login agregar-carrito' id='" + obj[i - 1].producto_id + "'><i class='fa fa-shopping-cart'></i> Agregar</a>";
                rows += "</span>";
                rows += "<span class='brand-container'>";
                rows += "<a class='btn-cancel' id='see-" + obj[i - 1].producto_id + "'>Ver más</a>";
                rows += "<span class='brand'>";
                rows += "<b>KRAS</b>TERS";
                rows += "</span>";
                rows += "</span>";
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