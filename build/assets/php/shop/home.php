<html>
<head>
    <title>Krasters</title>   
</head>
<?php
    include '../modules/nav.php';
?>
<?php
    include '../modules/ad.php';
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
var permitirAgregar = false; //variable que permite agregar o no al carrito debido a que tengo colores y tallas permite saber si el producto si existe a partir de sus existencias

function load_productos(){
    $.ajax({
        url: '../rutas_ajax/productos/listado_shop.php?producto=',
        type: 'GET',
        success: function(r){
            obj = JSON.parse(r);
            rows = "";
            /*LEER IMPORTANTE
                0 -> vienen productos (objeto)
                1 -> vienen tallas (array)
                2 -> vienen colores (array)
            */
            for(var i = 1; i <= obj.length; i++){
                //ruta debe ser la imagen del producto.
                ruta = '../../img/productos/' + obj[i - 1][0].producto_id + "." + obj[i - 1][0].tipo_producto;
                rows += "<div id='product-card-" + obj[i - 1][0].producto_id +"' class='product-card'>";
                rows += "<img class='image' src='"+ruta+"'>";
                rows += "<span class='information'>";
                rows += "<span class='name'>" + obj[i - 1][0].producto_nombre + "</span>";
                rows += "<span class='description'>" + obj[i - 1][0].descripcion + "</span>";
                rows += "<span class='price'>Q " + obj[i - 1][0].precio + "</span>";
                rows += "<span class='cantidad' id='existencia-" + obj[i - 1][0].producto_id + "'></span>";
                rows += "<span class='separation m'></span>";
                rows += "<span class='form-row'>";
                //select de tallas
                rows += "<span class='input-icon'>";
                rows += "<select class='select-tallas' data-live-search='true' id='select-talla-" + obj[i - 1][0].producto_id + "' onchangue=\"cambio_existencia('" + obj[i - 1][0].producto_id +"');\">";
                for(var a = 0; a < obj[i - 1][1].length; a++){
                    rows += "<option value='" + obj[i - 1][1][a] + "'>" + obj[i - 1][1][a] + "</option>";
                }    
                rows += "</select>";              
                rows += "</span>";
                //select de colores.
                rows += "<span class='input-icon'>";
                rows += "<select class='select-colores' data-live-search='true' id='select-color-" + obj[i - 1][0].producto_id + "'>";
                for(var a = 0; a < obj[i - 1][2].length; a++){
                    rows += "<option value='" + obj[i - 1][2][a] + "'>" + obj[i - 1][2][a] + "</option>";
                }    
                rows += "</select>";              
                rows += "</span>";
                rows += "</span>";
                rows += "<a class='btn-login agregar-carrito' id='" + obj[i - 1][0].producto_id + "'><i class='fa fa-shopping-cart'></i> Agregar</a>";
                rows += "</span>";
                rows += "<span class='brand-container'>";
                rows += "<a class='btn-cancel' id='see-" + obj[i - 1][0].producto_id + "' onClick=\"expandProductCard('product-card-" + obj[i - 1][0].producto_id +"');\">Ver más</a>";
                rows += "<span class='brand'>";
                //Falta obtener la imagen de la marca.
                ruta2 = '../../img/marcas/' + obj[i - 1][0].marca_nombre + "." + obj[i - 1][0].tipo_marca;
                rows += "<img src ='"+ruta2+"'>";
                rows += "</span>";
                rows += "</span>";
                rows += "</div>";
            }
            $("#productos").html(rows);
        }        
    });
}


var cargar_existencias = function(producto,color,talla){
    if((producto != null)&&(color != null)&&(talla != null)){
        $.ajax({
        url: '../rutas_ajax/productos/existencia.php?producto=' + producto + '&color=' + color + '&talla=' + talla,
        type: 'GET',
            success: function(r){
                if(r >= 0){ 
                    permitirAgregar = true;
                    $('#existencia-' + producto).html(r);
                }else{ 
                    permitirAgregar = false;
                    //si viene -1 el producto no existe
                    $('#existencia-' + producto).html("NO DISPONIBLE");
                }
            }
        });
    }    
} 

$(document).ready(function(){
    load_productos();
    $(document).on('click','.agregar-carrito',function(event){
        if(permitirAgregar){
            var div = $(this);
            var producto = div.attr('id');
            color = $("#select-color-" + producto).val();
            talla = $("#select-talla-" + producto).val();
            if((producto != null)&&(color != null)&&(talla != null)){
                $.ajax({
                url: '../rutas_ajax/carrito/insertar.php?producto=' + producto + '&color=' + color + '&talla=' + talla,
                type: 'GET',
                    success: function(r){
                        alert(r);
                        // if(r == 0 || r == 1){
                        //     new PNotify({
                        //         title: 'Agregar a carrito',
                        //         text: 'Producto agregado exitosamente.',
                        //         type: 'success',
                        //         styling: 'bootstrap3'
                        //     });
                        //     cargar_existencias(producto,color,talla);
                        // }else{
                        //     new PNotify({
                        //         title: 'Agregar a carrito',
                        //         text: 'Producto agotado.',
                        //         type: 'warning',
                        //         styling: 'bootstrap3'
                        //     });                        
                        // }
                    }
                });
            }
        }
    }); 

    $(document).on('click', '.select-colores', function () {
        id = $(this).attr("id");
        producto = id.split("-")[2];
        color = $("#select-color-" + producto).val();
        talla = $("#select-talla-" + producto).val();
        cargar_existencias(producto,color,talla);
    }); 

    $(document).on('click', '.select-tallas', function () {
        id = $(this).attr("id");
        producto = id.split("-")[2];
        color = $("#select-color-" + producto).val();
        talla = $("#select-talla-" + producto).val();
        cargar_existencias(producto,color,talla);
    });        
});

var actualCardId = '';

//Función que se encarga de cambiar la case de las tarjetas para que se expandan.
function expandProductCard(card_id){
    if(actualCardId != card_id){
        actualCardId = card_id;
        id = actualCardId.split("-")[2];
        color = $("#select-color-" + id).val();
        talla = $("#select-talla-" + id).val();        
        cargar_existencias(id,color,talla);
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