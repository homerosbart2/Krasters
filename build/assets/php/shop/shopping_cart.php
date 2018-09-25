<?php header('Access-Control-Allow-Origin: *'); ?>

<html>
<head   >
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
            <span class='total'><b>SUBTOTAL :</b> <span class='value' id='totalPago'></span></span>
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
                        <span class="proceed-total" id="subtotalSpan"></span>
                        <span class="proceed-total" id="envioSpan"></span>
                        <span class="proceed-total" id="totalSpan"></span>
                        <!-- Select del lugar -->
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="place-select">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT * FROM Lugares as L order by L.nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione lugar</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $id=$row["lugar_id"];
                                        $nombre=$row["nombre"];
                                        echo "<option value='".$id."'>".$nombre."</option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                            <i class="fas fa-map-marker-alt"></i>
                        </span>                        
                        <!-- select de courier -->
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="courier-select">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT * FROM Couriers as C order by C.nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value='0' selected=selected disabled>Seleccione courier</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $id=$row["courier_id"];
                                        $nombre=$row["nombre"];
                                        $direccion_ip = $row["direccion_ip"];
                                        $consulta_path = $row["consulta_path"];
                                        $envio_path = $row["envio_path"];
                                        $estado_path = $row["estado_path"];
                                        $formato = $row["formato"];
                                        echo "<option value='".$id."-".$direccion_ip."-".$consulta_path."-".$envio_path."-".$estado_path."-".$formato."'>".$nombre."-".$formato."</option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                            <i class="fas fa-truck"></i>
                        </span>     
                        <!-- Emisores de tarjetas -->
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="card-select">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT * FROM Emisores as E order by E.nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione emisor</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $id=$row["emisor_id"];
                                        $nombre=$row["nombre"];
                                        $direccion_ip = $row["direccion_ip"];
                                        $autorizacion_path = $row["autorizacion_path"];
                                        $formato = $row["formato"];
                                        echo "<option value='".$id."-".$direccion_ip."-".$autorizacion_path."-".$formato."'>".$nombre."-".$formato."</option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                            <i class="fab fa-cc-visa"></i>
                        </span>
                                    
                        <!-- Nombre del usuario de la tarjeta. -->
                        <span class="input-icon">
                            <input type='text' id='user-name' placeholder='Nombre de Tarjeta' required>
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
                                <input class="month" type="number" placeholder="MM" id="month-tarjeta">
                                <span class='sep'>/</span>
                                <input class="year" type="number" placeholder="YYYY" id="year-tarjeta">
                            </span>
                            <!-- Código de seguridad de la tarjeta. -->
                            <input type="number" placeholder="CVV" id="user-cvv">
                        </span>
                        <span class="input-icon">
                            <input type='text' id='direccion' placeholder='Dirección' required>
                            <i class="fas fa-map-marked"></i>
                        </span>                       
                        <!-- destinatario. -->
                        <span class="input-icon">
                            <input type='text' id='destinatario' placeholder='Destinatario' required>
                        </span>
                        <!-- Descuento. -->
                        <span class="input-icon">
                            <input type='text' id='discount' placeholder='Ingrese código de descuento' required>
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
    var deshabilitarCompra = false;
    var codigoLugar = null; //variable global que mantiene el lugar seleccionado a enviar 
    var sumatoria = 0; //variable global que mantiene el total a pagar

    //variables logales obtenidas del webServices de courier
    var destinoCourier = null;
    var coberturaCourier = false;
    var costoCourier = 0; 

    //variables logales obtenidas del webServices de emisor
    var tarjetaEmisor = null;
    var statusEmisor = null;
    var numeroEmisor = null;
    var d;
    var date = [];

    //Función que obtiene el tiempo actual y lo devuelve como arreglo como: [16, 9, 2018].
    function getActualTime(){
        d = new Date();
        date.push(d.getDate());
        date.push(d.getMonth() + 1);
        date.push(d.getFullYear());
        return date[1]+"/"+date[0]+"/"+date[2];
    }    

    function prettyNumber(number) {
        number = Math.round(number * Math.pow(10, 2)) / Math.pow(10, 2);
        var components = number.toString().split(".");
        components[0] = components[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return components.join(".");
    }

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
                    ruta = '../../img/productos/' + obj[i - 1].producto_id + "." + obj[i - 1].tipo_producto;
                    rows += "<img class='image' src='"+ruta+"'>";
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
                    ruta2 = '../../img/marcas/' + obj[i - 1].marca_nombre + "." + obj[i - 1].tipo_marca;
                    rows += "<img src ='"+ruta2+"'>";
                    rows += "</span>";
                    rows += "<span class='money-quantity'>";
                    //Cantidad de productos agregados.
                    rows += "<span class='quantity'><i class='fas fa-layer-group'></i> " + prettyNumber(obj[i - 1].cantidad) + "</span>";
                    rows += "<b>|</b>";
                    //Precio del producto.
                    rows += "<span class='money'>Q " + prettyNumber(obj[i - 1].precio) + "</span>";
                    rows += "</span>";
                    rows += "</span>";
                    //Multiplicación del precio por la cantidad.
                    total = parseFloat(obj[i - 1].precio) * parseFloat(obj[i - 1].cantidad)
                    sumatoria += total;
                    rows += "<span class='price'>Q " + prettyNumber(total) + "</span>";
                    rows += "</span>";
                    rows += "</span>";
                }
                $(".container-1").html(rows);
                $("#totalPago").html("Q " + prettyNumber(sumatoria));
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

        // alert(getActualTime());
        
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
            $('#subtotalSpan').html($('.total').html());
            
            proceed = 1;
        });
        
        //Funciones para esconderlo.
        $('.mask').click(function(){
            exitSquared();
        });

        $('.exit-button').find('i').click(function(){
            exitSquared();
        });

        $('#purchase-button').on('click',function(){
            $.ajax({
            url: "../rutas_ajax/carrito/verificar_existencias.php?",
            type: "POST",
                success: function(r){
                    if(r == -1){
                        //justo en este momento verifico existencias si aun estan disponibles
                        new PNotify({
                            title: 'Compra',
                            text: 'Algunos productos se han agotado.',
                            type: 'warning',
                            styling: 'bootstrap3'
                        });
                        load_summaries();                         
                        exitSquared();
                    }else{
                        var tarjetaInfo = document.getElementById("card-select").value;
                        var lugar = document.getElementById("place-select").value;
                        var nombre = document.getElementById("user-name").value;
                        var tarjeta = document.getElementById("user-card").value;
                        var mes = document.getElementById("month-tarjeta").value;
                        var year = document.getElementById("year-tarjeta").value;
                        var cvv  = document.getElementById("user-cvv").value;
                        var direccion = document.getElementById("direccion").value;
                        var destinatario = document.getElementById("destinatario").value;
                        var descuento = document.getElementById("discount").value;
                        var fecha = year+mes;
                        if(tarjetaInfo != null && lugar != null && nombre != "" && tarjeta != "" && cvv != "" && mes != "" && year != "" && direccion != "" && destinatario != ""){        
                            if(coberturaCourier){
                                emisor = tarjetaInfo.split("-")[0];
                                direccion_ip = tarjetaInfo.split("-")[1];
                                autorizacion_path = tarjetaInfo.split("-")[2];
                                formato = tarjetaInfo.split("-")[3];    
                                urlWebServices = "../rutas_ajax/webservices/autorizacion.php?direccion=" + direccion_ip + "&autorizacion=" + autorizacion_path + "&tarjeta=" + tarjeta + "&nombre=" + nombre + "&fecha_venc=" + fecha + "&num_seguridad=" + cvv + "&monto=" + (sumatoria + costoCourier) + "&formato=" + formato;
                                $.ajax({
                                    url: urlWebServices,                
                                    type: 'GET',
                                    success: function(r){
                                        if(formato == "xml" || formato == "XML"){
                                            //XML    
                                            console.log(r);            
                                            parser = new DOMParser();
                                            xmlDoc = parser.parseFromString(r,"text/xml");
                                            tarjetaEmisor = xmlDoc.getElementsByTagName("tarjeta")[0].childNodes[0].nodeValue; 
                                            statusEmisor = xmlDoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;                    
                                            numeroEmisor = xmlDoc.getElementsByTagName("numero")[0].childNodes[0].nodeValue; 
                                        }else{
                                            //JSON
                                            r = JSON.parse(r); 
                                            tarjetaEmisor =  r.autorizacion.tarjeta; 
                                            statusEmisor = (r.autorizacion.status).trim(); 
                                            numeroEmisor = r.autorizacion.numero;
                                        }
                                        if(statusEmisor == "APROBADO" || " APROBADO " || " APROBADO" || "APROBADO "){
                                            //generamos la compra
                                            var courierInfo = document.getElementById("courier-select").value;
                                            courier = courierInfo.split("-")[0];
                                            direccion_ip = courierInfo.split("-")[1];
                                            envio_path = courierInfo.split("-")[3];                                         
                                            generar_compra(courier,emisor,lugar,tarjeta,nombre,cvv,fecha,getActualTime(),destinoCourier,costoCourier,direccion,destinatario,direccion_ip,envio_path,descuento);
                                        }else{
                                            new PNotify({
                                                title: 'Shopping Cart',
                                                text: 'La transacción a sigo denegada.',
                                                type: 'error',
                                                styling: 'bootstrap3'
                                            });                                         
                                        }                                    
                                    }
                                });  
                            }else{
                                new PNotify({
                                    title: 'Shopping Cart',
                                    text: 'El courier seleccionado no tiene cobertura para el lugar.',
                                    type: 'error',
                                    styling: 'bootstrap3'
                                });                             
                            }                               
                        }else{
                            new PNotify({
                                title: 'Shopping Cart',
                                text: 'Complete todos los campos porfavor.',
                                type: 'warning',
                                styling: 'bootstrap3'
                            });                   
                        }                       
                    }
                }
            }); 
        });

        $('#place-select').on('change',function(){
            codigoLugar = document.getElementById("place-select").value;    
        });

        $('#courier-select').on('change',function(){    
            //nos conectamos con el web services
            var courierInfo = document.getElementById("courier-select").value; 
            if(codigoLugar == null){
                new PNotify({
                    title: 'Elegir courier',
                    text: 'Debe seleccionar un destino.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });  
                document.getElementById('courier-select').value='0';
            }else{
                courier_id = courierInfo.split("-")[0];
                direccion_ip = courierInfo.split("-")[1];
                consulta_path = courierInfo.split("-")[2];
                envio_path = courierInfo.split("-")[3];
                estado_path = courierInfo.split("-")[4];
                formato = courierInfo.split("-")[5];
                solicitar_datos_courier(courier_id,direccion_ip,consulta_path,envio_path,estado_path,formato);
            }
        });      
    });

    function renderPage(){
        //Luego de 1 segundo se redirige hacia la misma pagina
        $(location).attr('href','shopping_cart.php');
    } 

    function generar_compra(courier,emisor,lugar,tarjeta,nombre,cvv,fecha,fecha_actual,destino,costo,direccion,destinatario,direccion_ip,envio_path,descuento){
        if(deshabilitarCompra == false){
            deshabilitarCompra = true;
            $.ajax({
                url: "../rutas_ajax/ordenes/generar_compra.php?courier=" + courier + "&emisor=" + emisor + "&lugar=" + lugar + "&tarjeta=" + tarjeta + "&tarjeta_nombre=" + nombre + "&cvv=" + cvv + "&fecha_tarjeta=" + fecha + "&total=" + sumatoria + "&fecha_actual=" + fecha_actual + "&destino=" + destino + "&envio=" + costo + "&direccion=" + direccion + "&destinatario=" + destinatario + "&direccion_ip=" + direccion_ip + "&envio_path=" + envio_path + "&descuento=" + descuento,
                type: "POST",
                success: function(r){
                    if(r == 1){
                        deshabilitarCompra = false;
                        //orden creada con exito y solicitud de courier hecha
                        new PNotify({
                            title: 'Shopping Cart',
                            text: 'Compra realizada exitosamente.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        $.ajax({
                            url: "../rutas_ajax/webservices/descuentos.php",
                            type: "POST",
                            success: function(r){
                                if(r > 0) $('#proceed-form').html('<span class="discount-text">Código de descuento en &shop:</span><span class="discount-code">' + r + '</span><span class="discount-text small"><i class="fas fa-exclamation"></i> El código no es almacenado, no lo pierdas.</span>');
                                else exitSquared();
                            }
                        }); 
                        //LIMPIAMOS VARIABLES
                        codigoLugar = null; //variable global que mantiene el lugar seleccionado a enviar 
                        sumatoria = 0; //variable global que mantiene el total a pagar

                        //variables logales obtenidas del webServices de courier
                        destinoCourier = null;
                        coberturaCourier = false;
                        costoCourier = 0; 

                        //variables logales obtenidas del webServices de emisor
                        tarjetaEmisor = null;
                        statusEmisor = null;
                        numeroEmisor = null;                    
                        var nombre = document.getElementById("user-name").value = "";
                        var tarjeta = document.getElementById("user-card").value = "";
                        var mes = document.getElementById("month-tarjeta").value = "";
                        var year = document.getElementById("year-tarjeta").value = "";
                        var cvv  = document.getElementById("user-cvv").value = "";
                        var direccion = document.getElementById("direccion").value = "";
                        var destinatario = document.getElementById("destinatario").value = "";                 
                        load_summaries();
                    }else{
                        deshabilitarCompra = false;
                        new PNotify({
                            title: 'Shopping Cart',
                            text: 'Error al generar compra.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });                                          
                    }
                }
            });
        }else{
            new PNotify({
                title: 'Shopping Cart',
                text: 'Espere la transacción se esta verificando.',
                type: 'warning',
                styling: 'bootstrap3'
            });              
        }        
    }

    function solicitar_datos_courier(courier_id,direccion_ip,consulta_path,envio_path,estado_path,formato){
        urlWebServices = "../rutas_ajax/webservices/consulta.php?direccion=" + direccion_ip + "&consulta=" +  consulta_path  + "&formato=" + formato + "&destino=" + codigoLugar;
        $.ajax({
            url: urlWebServices,
            type: 'GET',
            success: function(r){
                if(formato == "xml" || formato == "XML"){
                    //XML                
                    parser = new DOMParser();
                    xmlDoc = parser.parseFromString(r,"text/xml");
                    destinoCourier = xmlDoc.getElementsByTagName("destino")[0].childNodes[0].nodeValue; 
                    coberturaCourier = xmlDoc.getElementsByTagName("cobertura")[0].childNodes[0].nodeValue;                    
                    costoCourier = xmlDoc.getElementsByTagName("costo")[0].childNodes[0].nodeValue;
                }else{
                    //JSON
                    r = JSON.parse(r);
                    destinoCourier =  r.consultaprecio.destino; 
                    coberturaCourier = r.consultaprecio.cobertura; 
                    costoCourier = r.consultaprecio.costo;
                }
                if(coberturaCourier == "TRUE" || coberturaCourier == "true" || coberturaCourier == true){
                    $('#envioSpan').html("Envio: " + prettyNumber(costoCourier));
                    $('#totalSpan').html("Total: " + prettyNumber(parseFloat(sumatoria) + parseFloat(costoCourier)));
                }else{
                    coberturaCourier = false;
                    $('#envioSpan').html('INVALIDO');
                    $('#totalSpan').html('SIN COBERTURA');
                }       
            }
        });  
    }
 

    function exitSquared(){
        if(proceed == 1){
            $('.mask').removeClass('active');
            $('.squared-absolute').removeClass('active');
            proceed = 0;
        }
    }
</script>