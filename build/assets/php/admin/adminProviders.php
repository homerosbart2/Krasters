<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administración</title>
</head>

<?php
    include '../modules/nav.php';
?>

<body>
    <section id="header-admin">
        <div class="wrapper">
            <div class="shop-admin">
                <div class="form-container">

                    <h1>ADMINISITRACIÓN DE PROVEEDORES</h1>

                    <form action="" class="button-bar-around">
                        <input type="radio" name="menu-bar" id="card-section" value="0">
                        <label for="card-section" class="btn-menu" >
                            <i class="fas fa-credit-card"></i> Tarjetas
                        </label>
                        <input type="radio" name="menu-bar" id="courier-section" value="1"> 
                        <label for="courier-section" class="btn-menu">
                            <i class="fas fa-shipping-fast"></i> Couriers
                        </label>
                    </form>

                    <span class="separation l"></span>

                    <form id="admin-shop-form-card-provider" class="admin-shop-form">
                        <span id="form-title" class="form-title"><b>AGREGAR</b> PROVEEDOR DE TARJETA</span>
                        <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Agrega nuevos proveedores de tarjetas, para que los clientes puedan comprar en <span class="company-name"><b>KRAS</b>TERS</span>.</span>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='tarjeta_nombre' name='' placeholder='Nombre' required>
                            </span>
                            <span class="input-icon">
                                <input type='text' id='tarjeta_direccion' name='' placeholder='IP' required>
                            </span>
                        </span>
                        <input type='text' id='autorizacion_directorio' name='' placeholder='Autorización' required>
                        <span class="form-alert"><i class="fas fa-wrench"></i> Opciones avanzadas:</span>
                        <span id="format-card-switch" class="switch">
                            <label for="format-card">
                                <input type="checkbox" name="" id="format-card">
                                <span class="slider"></span>
                            </label>
                            <span class="switch-label">
                                XML
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="agregarTarjeta"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>

                    <form id="admin-shop-form-courier-provider" class="admin-shop-form">
                        <span id="form-title" class="form-title"><b>AGREGAR</b> PROVEEDOR DE SERVICIO COURIER</span>
                        <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Agrega nuevos proveedores de servicio courier, para que los clientes puedan comprar en <span class="company-name"><b>KRAS</b>TERS</span>.</span>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='courier_nombre' name='' placeholder='Nombre' required>
                            </span>
                            <span class="input-icon">
                                <input type='text' id='courier_direccion' name='' placeholder='IP' required>
                            </span>
                        </span>
                        <input type='text' id='costo_directorio' name='' placeholder='Costo' required>
                        <input type='text' id='envio_directorio' name='' placeholder='Envío' required>
                        <input type='text' id='Estado_directorio' name='' placeholder='Estado' required>
                        <span class="form-alert"><i class="fas fa-wrench"></i> Opciones avanzadas:</span>
                        <span id="format-courier-switch" class="switch">
                            <label for="format-courier">
                                <input type="checkbox" name="" id="format-courier">
                                <span class="slider"></span>
                            </label>
                            <span class="switch-label">
                                XML
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="agregarProveedor"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>

                    <span class="separation l"></span>
                </div>
            </div>
        </div>
    </section>
    <script src="../../js/vendors.js"></script>
    <script src="../../js/app.js"></script>
    <script src="../../js/actions.js"></script>
</body>

</html>

<script>

    var agregarProveedor = function(){
        if($('#format-courier').is(":checked")) formato = "json";
        else formato = "xml";
        nombre = document.getElementById("courier_nombre").value;
        direccion = document.getElementById("courier_direccion").value;
        costo = document.getElementById("costo_directorio").value; 
        envio = document.getElementById("envio_directorio").value; 
        estado = document.getElementById("estado_directorio").value; 
        if((nombre != "")&&(direccion != "")&&(autorizacion != "")){
            $.ajax({
                url: "../rutas_ajax/couriers/insertar.php?nombre=" + nombre + "&direccion=" + direccion + "&costo=" + costo + "&envio=" + envio + "&estado=" + estado + "&formato=" + formato, 
                type: "POST",
                success: function(r){
                    //si elimino crea devuelve 0, si hubo error -1
                    if(r == 0){ //actualizo producto
                        new PNotify({
                            title: 'Crear Courier',
                            text: 'tarjeta creada exitosamente.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });                                                
                    }else{
                        new PNotify({
                            title: 'Crear Courier',
                            text: 'Error al crear tarjeta, verifique sus datos.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }                        
                }
            });
        }else{
            new PNotify({
                title: 'Crear Courier',
                text: 'Complete correctamente todos campos porfavor.',
                type: 'warning',
                styling: 'bootstrap3'
            });
        } 
    }

    var agregarTarjeta = function(){
        if($('#format-card').is(":checked")) formato = "json";
        else formato = "xml";      
        nombre = document.getElementById("tarjeta_nombre").value;
        direccion = document.getElementById("tarjeta_direccion").value;
        autorizacion = document.getElementById("autorizacion_directorio").value; 
        if((nombre != "")&&(direccion != "")&&(autorizacion != "")){
            $.ajax({
                url: "../rutas_ajax/tarjetas/insertar.php?nombre=" + nombre + "&direccion=" + direccion + "&autorizacion=" + autorizacion + "&formato=" + formato,
                type: "POST",
                success: function(r){
                    //si elimino crea devuelve 0, si hubo error -1
                    if(r == 0){ //actualizo producto
                        new PNotify({
                            title: 'Crear Tarjeta',
                            text: 'tarjeta creada exitosamente.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });                                                
                    }else{
                        new PNotify({
                            title: 'Crear Tarjeta',
                            text: 'Error al crear tarjeta, verifique sus datos.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }                        
                }
            });
        }else{
            new PNotify({
                title: 'Crear Tarjeta',
                text: 'Complete correctamente todos campos porfavor.',
                type: 'warning',
                styling: 'bootstrap3'
            });
        } 
    }    

    $(document).ready(function(){
        $("#admin-shop-form-card-provider").hide();
        $("#admin-shop-form-courier-provider").hide();
 
        $("#agregarTarjeta").on('click',function(){
            //agregarTarjeta();
        }) 

        $("#agregarProveedor").on('click',function(){
            agregarProveedor();
        }) 
    });

    $("#format-card").click(function(){
        if($(this).is(":checked")){
            $("#format-card-switch span:last").html("JSON");
        }else{
            $("#format-card-switch span:last").html("XML");
        }
    });

    $("#format-courier").click(function(){
        if($(this).is(":checked")){
            $("#format-courier-switch span:last").html("JSON");
        }else{
            $("#format-courier-switch span:last").html("XML");
        }
    });

    $("#card-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-card-provider").show();
            $("#admin-shop-form-courier-provider").hide();
        }
    });

    $("#courier-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-card-provider").hide();
            $("#admin-shop-form-courier-provider").show();
        }
    });
</script>