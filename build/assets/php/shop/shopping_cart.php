<html>
<head>
    <title>Krasters</title>  
    <link rel="stylesheet" href="../../css/bootstrap.min.css"  media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../css/bootstrap-select.css"  media="all" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"  type="text/javascript"></script> 
    <script src="../../js/bootstrap-select.js" type="text/javascript"></script>    
</head>
<?php
    include '../modules/nav.php';
?>
<body>
    <span class="mask"></span>
    <section class="summary">
        <div class="summaries-container"> 
            <span class="container-1">
            </span>
            <!-- Span donde va el total de los productos en el detalle. -->
            <span class='total'><b>TOTAL :</b> <span class='value' id='totalPago'></span></span>
            <span class='proceed'>
                <a id='proceed-button' class='btn-register'><i class='fas fa-credit-card'></i> Proceder</a>
            </span>
            <span class="squared-absolute">
                <span class="content">
                    <span class="exit-button">
                        <a class='btn-delete'><i class='fas fa-times'></i></a>
                    </span>
                    <!-- Inputs para llamar a los servicios webs: -->
                    <form id="proceed-form">
                        <span class="proceed-total"></span>
                        <!-- Nombre del usuario de la tarjeta. -->
                        <span class="input-icon">
                            <input type='text' id='user-name' placeholder='Nombre' required>
                            <i class="far fa-user"></i>
                        </span>
                        <!-- Número de tarjeta del usuario. -->
                        <span class="input-icon">
                            <input type='text' id='user-card' placeholder='Número de Tarjeta' required>
                            <i class="fas fa-credit-card"></i>
                        </span>
                        <span class="form-row">
                            <!-- Mes y año de la fecha de expiración de la tarjeta. -->
                            <span class="expiration-date">
                                <input type="number" placeholder="MM" class="month">
                                <span class='sep'>/</span>
                                <input type="number" placeholder="YY" class="year">
                            </span>
                            <!-- Código de seguridad de la tarjeta. -->
                            <input type="number" placeholder="CVV" class="user-cvv">
                        </span>
                        <!-- Select del lugar. (Le quité la parte de php) A partir del lugar seleccionado se deben listar los couriers y sus precios. -->
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="place-select">
                                <option value=default selected=selected disabled>Seleccione lugar</option>
                                <option value="Capital">Capital</option>
                            </select>
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <!-- Botón que debería de llamar a los servicios de compra de la tarjeta y del courier. -->
                        <span class="proceed">
                            <a id='purchase-button' class='btn-purchase'><i class="fas fa-dollar-sign"></i> Pagar</a>
                        </span>
                    </form>
                </span>
            </span>
        </div>
    </section>
</body>
</html>

<script>
    var sumatoria = 0; //variable global
    function load_summaries(){
            $.ajax({
            url: '../rutas_ajax/carrito/listado.php?',
            type: 'GET',
            success: function(r){
                obj = JSON.parse(r);
                rows = "";
                sumatoria = 0;
                rows += "<span class='title'>DETALLE</span>";
                rows += "<p class='justify'><i class='fas fa-exclamation'></i> Verifica que los productos listados a continuación sean los desados antes de proceder.</p>";
                for(var i = 1; i <= obj.length; i++){
                    rows += "<span class='product-summary'>";
                    //Imagen del producto.
                    rows += "<img class='image' src='../../img/productos/default2.webp'>";
                    rows += "<span class='information'>";
                    rows += "<a class='btn-delete delete-item' id='" + obj[i - 1].carrito_id +  "-" + obj[i - 1].color_nombre    +  "-" + obj[i - 1].talla +  "-" + obj[i - 1].producto_id +"'><i class='fas fa-times'></i></a>";
                    //Nombre del producto
                    rows += "<span class='name'>" + obj[i - 1].producto_nombre + "</span>";
                    rows += "<span class='info-row'>";
                    rows += "<span class='details-container'>";
                    rows += "<span class='details'>";
                    //En background:#FFFFFF va el color.
                    rows += "<span class='color' style='background:#" + obj[i - 1].color_codigo + ";'></span>";
                    //Talla del producto.
                    rows += "<span class='size'>" + obj[i - 1].talla + "</span>";
                    rows += "</span>";
                    //Imagen de la marca del producto.
                    rows += "<img src ='../../img/brands/adidas-white.png'>";
                    rows += "</span>";
                    rows += "<span class='money-quantity'>";
                    //Cantidad de productos agregados.
                    rows += "<span class='quantity'><i class='fas fa-layer-group'></i> " + obj[i - 1].cantidad + "</span>";
                    rows += "<b>|</b>";
                    //Precio del producto.
                    rows += "<span class='money'>" + obj[i - 1].precio + "</span>";
                    rows += "</span>";
                    rows += "</span>";
                    //Multiplicación del precio por la cantidad.
                    total = parseFloat(obj[i - 1].precio) * parseFloat(obj[i - 1].cantidad)
                    sumatoria += total;
                    rows += "<span class='price'>" + total + "</span>";
                    rows += "</span>";
                    rows += "</span>";
                }
                $(".container-1").html(rows);
                $("#totalPago").html(sumatoria);
            }
        });     
    }

    var descontarCarrito = function(carrito,color,talla,producto){
        $.ajax({
            url: '../rutas_ajax/carrito/eliminar.php?producto=' + producto + '&carrito=' + carrito + '&color=' + color + '&talla=' + talla,
            type: 'GET',
            success: function(r){
                if(r == 0){
                    load_summaries();
                }else{
                    new PNotify({
                        title: 'Descontar de carrito',
                        text: 'Ya no existen mas productos por descontar.',
                        type: 'warning',
                        styling: 'bootstrap3'
                    });                        
                }
            }
        });        
    }

    $(document).ready(function(){
        load_summaries();
        proceed = 0;
        
        $(document).on('click', '.delete-item', function () {
            id = $(this).attr("id");
            carrito = id.split("-")[0];
            color = id.split("-")[1];
            talla = id.split("-")[2];
            producto = id.split("-")[3];
            descontarCarrito(carrito,color,talla,producto);
        });

        //Función para enseñar el formulario de compra.
        $('#proceed-button').click(function(){
            $('.mask').addClass('active');
            $('.squared-absolute').addClass('active');
            $('.proceed-total').html($('.total').html());
            proceed = 1;
        });
        
        //Funciones para esconderlo.
        $('.mask').click(function(){
            exitSquared();
        });

        $('.exit-button').find('i').click(function(){
            exitSquared();
        });
    });

    function exitSquared(){
        if(proceed == 1){
            $('.mask').removeClass('active');
            $('.squared-absolute').removeClass('active');
            proceed = 0;
        }
    }
</script>