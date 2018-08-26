<html>
<head>
    <title>Krasters</title>   
</head>
<?php
    include '../modules/nav.php';

?>
</html>
<body>
    <span class="mask">

    </span>
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
                rows += "<div id='product-card-" + obj[i - 1].producto_id +"' class='product-card'>";
                rows += "<img class='image' src='"+ruta+"'>";
                rows += "<span class='information'>";
                rows += "<span class='name'>" + obj[i - 1].producto_nombre + "</span>";
                rows += "<span class='description'>" + obj[i - 1].descripcion + "</span>";
                rows += "<span class='price'>Q " + obj[i - 1].precio + "</span>";
                rows += "<span class='separation m'></span>";
                rows += "<span class='form-row'>";
                rows += "<span class='input-icon'>";
                rows += "<input type='number' min='25' id='producto_talla' placeholder='Talla' required>";
                rows += "<i class='fas fa-shoe-prints'></i>";
                rows += "</span>";
                rows += "<span class='input-icon'>";
                rows += "<select>";
                rows += "<option value='amarillo'>Amarillo</option>";
                rows += "</select>";
                rows += "</span>";
                rows += "</span>";
                rows += "<a class='btn-login agregar-carrito' id='" + obj[i - 1].producto_id + "'><i class='fa fa-shopping-cart'></i> Agregar</a>";
                rows += "</span>";
                rows += "<span class='brand-container'>";
                rows += "<a class='btn-cancel' id='see-" + obj[i - 1].producto_id + "' onClick=\"expandProductCard('product-card-" + obj[i - 1].producto_id +"');\">Ver más</a>";
                rows += "<span class='brand'>";
                rows += "<img src ='../../img/brands/adidas-white.png'>";
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

var actualCardId = '';

//Función que se encarga de cambiar la case de las tarjetas para que se expandan.
function expandProductCard(card_id){
    if(actualCardId != card_id){
        actualCardId = card_id;
        $('#' + card_id).addClass('expanded');
        $('.mask').addClass('active');
        $('#' + card_id).find('.btn-cancel').html('<i class="fas fa-times"></i>');
    }else{
        $('#' + actualCardId).removeClass('expanded');
        $('.mask').removeClass('active');
        $('#' + actualCardId).find('.btn-cancel').html('Ver más');
        actualCardId = '';
    }
}

//Función para salir de una vista expandida al hacer click afuera de la imagen.
$('.mask').click(function(){
    if(actualCardId != ''){
        $('#' + actualCardId).removeClass('expanded');
        $('.mask').removeClass('active');
        $('#' + actualCardId).find('.btn-cancel').html('Ver más');
        actualCardId = '';
    }
});
</script>