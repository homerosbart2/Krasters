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
                                    echo "<option value=default selected=selected disabled>Seleccione courier</option>";
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
                        </span>
                                    
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
                                <input type="number" placeholder="MM" id="month-tarjeta">
                                <span class='sep'>/</span>
                                <input type="number" placeholder="YYYY" id="year-tarjeta">
                            </span>
                            <!-- Código de seguridad de la tarjeta. -->
                            <input type="number" placeholder="CVV" id="user-cvv">
                        </span>
                        <span class="input-icon">
                            <input type='text' id='direccion' placeholder='Dirección' required>
                            <i class="fas fa-map-marked"></i>
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
    var codigoLugar = ""; //variable global que mantiene el lugar seleccionado a enviar 
    var sumatoria = 0; //variable global que mantiene el total a pagar

    //variables logales obtenidas del webServices de courier
    var nombreCourier = null;
    var destinoCourier = null;
    var coberturaCourier = false;
    var costoCourier = null; 

    //variables logales obtenidas del webServices de emisor
    var nombreEmisor = null;
    var tarjetaEmisor = null;
    var statusEmisor = null;
    var numeroEmisor = null;
    var d;
    var date = [];
    //var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];  

    //Función que obtiene el tiempo actual y lo devuelve como arreglo como: [16, 9, 2018].
    function getActualTime(){
        d = new Date();
        date.push(d.getDate());
        date.push(d.getMonth() + 1);
        date.push(d.getFullYear());
        return date;
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

        $('#purchase-button').on('click',function(){
            var tarjetaInfo = document.getElementById("card-select").value;
            var lugarInfo = document.getElementById("card-select").value;
            var nombre = "Jorge Luis";
            var tarjeta = "0000000000000000";
            var ccv = "717";
            var mes  = "09";
            var year = "2022";
            var direccion  = "A";
            if(tarjetaInfo != null && lugarInfo != null && nombre != "" && tarjeta != "" && ccv != "" && mes != "" && year != "" && direccion != ""){        
                // emisor_id = tarjetaInfo.split("-")[0];
                // direccion_ip = tarjetaInfo.split("-")[1];
                // autorizacion_path = tarjetaInfo.split("-")[2];
                // formato = tarjetaInfo.split("-")[3];
                // solicitar_datos_emisor(emisor_id,direccion_ip,autorizacion_path,formato,nombre,tarjeta,ccv,(year+mes))
                courier = 1;
                emisor = 9;
                lugar = "01000";
                if(true){
                    //verificamos que la tarjeta tenga cobertuda
                    generar_compra(courier,emisor,lugar,tarjeta,nombre,ccv,mes+year);
                }else{
                    
                }
            }else{
                new PNotify({
                    title: 'Shopping Cart',
                    text: 'Complete todos los campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });                   
            }
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

    function generar_compra(courier,emisor,lugar,tarjeta,nombre,ccv,fecha){
        console.log("llego");
        $.ajax({
            url: "../rutas_ajax/ordenes/generar_compra.php?courier=" + courier + "&emisor=" + emisor + "&lugar=" + lugar + "&tarjeta=" + tarjeta + "&tarjeta_nombre=" + nombre + "&ccv=" + ccv + "&fecha=" + fecha + "&total=" + sumatoria,
            type: "POST",
            success: function(r){
                if(r == 1){
                    //orden creada con exito
                    setTimeout("renderPage()",500);
                }
            }
        });        
    }

    function solicitar_datos_courier(courier_id,direccion_ip,consulta_path,envio_path,estado_path,formato){
        // urlWebServices = "https://" + direccion_ip + "/" +  consulta_path + "?destino=" + codigoLugar + "&formato=" + formato;
        // $.ajax({
        //     url: urlWebServices,
        //     type: 'GET',
        //     success: function(r){
        //         if(formato == "xml" || formato == "XML"){
        //             //XML                
        //             parser = new DOMParser();
        //             xmlDoc = parser.parseFromString(r,"text/xml");
        //             nombreCourier = xmlDoc.getElementsByTagName("courrier")[0].childNodes[0].nodeValue; 
        //             destinoCourier = xmlDoc.getElementsByTagName("destino")[0].childNodes[0].nodeValue; 
        //             coberturaCourier = xmlDoc.getElementsByTagName("cobertura")[0].childNodes[0].nodeValue;                    
        //             costoCourier = xmlDoc.getElementsByTagName("numero")[0].childNodes[0].nodeValue;
        //         }else{
        //             //JSON
        //             nombreCourier = r.consultaprecio.courrier; 
        //             destinoCourier =  r.consultaprecio.destino; 
        //             coberturaCourier = r.consultaprecio.cobertura; 
        //             costoCourier = r.consultaprecio.costo;
        //         }
        //     }
        // });   
        // alert(nombreCourier);
        // alert(destinoCourier);
        // alert(coberturaCourier);
        // alert(costoCourier);        
    }
 
    function solicitar_datos_emisor(emisor_id,direccion_ip,autorizacion_path,formato,nombre,tarjeta,ccv,fecha){
        urlWebServices = "http://" + direccion_ip + "/" +  autorizacion_path + "?tarjeta=" + tarjeta + "&nombre=" + nombre + "&fecha_venc=" + fecha + "&num_seguridad=" + ccv + "&monto=" + sumatoria + "&tienda=1&formato=" + formato;
        $.ajax({
            url: urlWebServices,
            contentType: 'text/plain',
            xhrFields: {
                // The 'xhrFields' property sets additional fields on the XMLHttpRequest.
                // This can be used to set the 'withCredentials' property.
                // Set the value to 'true' if you'd like to pass cookies to the server.
                // If this is enabled, your server must respond with the header
                // 'Access-Control-Allow-Credentials: true'.
                withCredentials: false
            },   
            headers: {
                // Set any custom headers here.
                // If you set any non-simple headers, your server must include these
                // headers in the 'Access-Control-Allow-Headers' response header.
            },                     
            type: 'GET',
            success: function(r){
                if(formato == "xml" || formato == "XML"){
                    //XML    
                    console.log(r);            
                    parser = new DOMParser();
                    xmlDoc = parser.parseFromString(r,"text/xml");
                    nombreEmisor = xmlDoc.getElementsByTagName("emisor")[0].childNodes[0].nodeValue; 
                    tarjetaEmisor = xmlDoc.getElementsByTagName("tarjeta")[0].childNodes[0].nodeValue; 
                    statusEmisor = xmlDoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;                    
                    numeroEmisor = xmlDoc.getElementsByTagName("numero")[0].childNodes[0].nodeValue; 
                    console.log(nombreEmisor);
                }else{
                    //JSON
                    console.log(r);  
                    nombreEmisor = r.autorizacion.emisor; 
                    tarjetaEmisor =  r.autorizacion.tarjeta; 
                    statusEmisor = r.autorizacion.status; 
                    numeroEmisor = r.autorizacion.numero;
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