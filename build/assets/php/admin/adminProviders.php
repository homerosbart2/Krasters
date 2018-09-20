<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administración</title>
</head>

<?php
    include '../modules/nav.php';
    if($role != 0){
        echo  "<script> $(location).attr('href','../../../index.php') </script>";
    }
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
                        <input type='text' id='autorizacion_directorio' placeholder='autorizacion.php' placeholder='Autorización' required>
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
                        <input type='text' id='costo_directorio' placeholder='consulta.php' placeholder='Consulta' required>
                        <input type='text' id='envio_directorio' placeholder='envio.php' placeholder='Envío' required>
                        <input type='text' id='estado_directorio' placeholder='status.php' placeholder='Estado' required>
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

                    <span class="separation l" id="listado">
                        <!-- LISTAR POR AJAX --> 
                    </span>
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
        consulta = document.getElementById("costo_directorio").value; 
        envio = document.getElementById("envio_directorio").value; 
        estado = document.getElementById("estado_directorio").value; 
        if((nombre != "")&&(direccion != "")&&(consulta != "")&&(envio != "")&&(estado != "")){
            $.ajax({
                url: "../rutas_ajax/couriers/insertar.php?nombre=" + nombre + "&direccion=" + direccion + "&consulta=" + consulta + "&envio=" + envio + "&estado=" + estado + "&formato=" + formato, 
                type: "POST",
                success: function(r){
                    //si creo devuelve 0
                    if(r == 0){ 
                        new PNotify({
                            title: 'Crear Courier',
                            text: 'courier creado exitosamente.',
                            type: 'success',
                            styling: 'bootstrap3'
                        });            
                        document.getElementById("courier_nombre").value = "";
                        document.getElementById("courier_direccion").value = "";   
                        listarCouriers();                                                         
                    }else{
                        new PNotify({
                            title: 'Crear Courier',
                            text: 'Error al crear courier, verifique sus datos.',
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
        if((nombre != "")&&(direccion != "")){
            $.ajax({
                url: "../rutas_ajax/emisores/insertar.php?nombre=" + nombre + "&direccion=" + direccion + "&autorizacion=" + autorizacion + "&formato=" + formato,
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
                        document.getElementById("tarjeta_nombre").value = "";
                        document.getElementById("tarjeta_direccion").value = "";
                        listarTarjetas();                                                                        
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

    var eliminarTarjeta = function(id){
        $.ajax({
            url: "../rutas_ajax/emisores/eliminar.php?emisor=" + id,
            type: "POST",
            success: function(r){
                if(r == 0){
                    //elimino
                    new PNotify({
                        title: 'Eliminar Tarjeta',
                        text: 'Tarjeta eliminada exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                    listarTarjetas();
                }else{
                    new PNotify({
                        title: 'Eliminar Tarjeta',
                        text: 'Error al eliminar tarjeta.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
            }
        });       
    }  

    var editarTarjeta = function(id){
        nombre = document.getElementById(id + "-nombre").value;
        direccion = document.getElementById(id + "-direccion_ip").value;
        autorizacion = document.getElementById(id + "-autorizacion_path").value; 
        formato = document.getElementById(id + "-formato").value; 
        $.ajax({
            url: "../rutas_ajax/emisores/editar.php?nombre=" + nombre + "&direccion=" + direccion + "&autorizacion=" + autorizacion + "&formato=" + formato + "&id=" + id,
            type: "POST",
            success: function(r){
                if(r == 1){
                    //Actualizo
                    new PNotify({
                        title: 'Editar Tarjeta',
                        text: 'Tarjeta editada exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                    listarTarjetas();
                }else{
                    new PNotify({
                        title: 'Editada Tarjeta',
                        text: 'Error al editar tarjeta, verifique sus datos.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
            }
        });       
    }      

     var eliminarCourier = function(id){
        $.ajax({
            url: "../rutas_ajax/couriers/eliminar.php?courier=" + id,
            type: "POST",
            success: function(r){
                if(r == 0){
                    //elimino
                    new PNotify({
                        title: 'Eliminar Courier',
                        text: 'Courier eliminada exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                }else{
                    new PNotify({
                        title: 'Eliminar Courier',
                        text: 'Error al eliminar courier.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
                listarCouriers();
            }
        });       
    }   

    var editarCourier = function(id){
        nombre = document.getElementById(id + "-nombre").value;
        direccion = document.getElementById(id + "-direccion_ip").value;
        consulta = document.getElementById(id + "-consulta_path").value; 
        envio = document.getElementById(id + "-envio_path").value; 
        estado = document.getElementById(id + "-estado_path").value; 
        formato = document.getElementById(id + "-formato").value; 
        $.ajax({
            url: "../rutas_ajax/couriers/editar.php?nombre=" + nombre + "&direccion=" + direccion + "&consulta=" + consulta + "&envio=" + envio + "&estado=" + estado + "&formato=" + formato + "&id=" + id,
            type: "POST",
            success: function(r){
                if(r == 1){
                    //Actualizo
                    new PNotify({
                        title: 'Editar Courier',
                        text: 'Courier editado exitosamente.',
                        type: 'success',
                        styling: 'bootstrap3'
                    });                    
                }else{
                    new PNotify({
                        title: 'Editada Tarjeta',
                        text: 'Error al editar tarjeta, verifique sus datos.',
                        type: 'error',
                        styling: 'bootstrap3'
                    });                     
                }
                listarCouriers();
            }
        });       
    } 

    var listarTarjetas = function(){
        $.ajax({
            url: "../rutas_ajax/emisores/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Nombre</th>";
                    rows += "<th>Ip</th>";
                    rows += "<th>Autorizacion</th>";
                    rows += "<th>Formato</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='18%'><input type='text' id='" + obj[i - 1].emisor_id + "-nombre' class='text-input-modify' value='" + obj[i - 1].nombre + "'></td>";
                        rows += "<td width='32%'><input type='text' id='" + obj[i - 1].emisor_id + "-direccion_ip' class='text-input-modify' value='" + obj[i - 1].direccion_ip + "'></td>";
                        rows += "<td width='24%'><input type='text' id='" + obj[i - 1].emisor_id + "-autorizacion_path' class='text-input-modify' value='" + obj[i - 1].autorizacion_path + "'></td>";
                        rows += "<td width='6%'><input type='text' id='" + obj[i - 1].emisor_id + "-formato' class='text-input-modify' value='" + obj[i - 1].formato + "'></td>";                     
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].emisor_id + "' class='btn-cancel borrar-emisor' value='Eliminar'/></td>";
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].emisor_id + "' class='btn-cancel editar-emisor' value='Editar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado").html(rows);
            }
        });
    }

    var listarCouriers2 = function(){
        $.ajax({
            url: "../rutas_ajax/couriers/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Nombre</th>";
                    rows += "<th>Ip</th>";
                    rows += "<th>Consulta</th>";
                    rows += "<th>Envio</th>";
                    rows += "<th>Estado</th>";
                    rows += "<th>Formato</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='20%'>" + obj[i - 1].nombre + "</td>";
                        rows += "<td width='20%'>" + obj[i - 1].direccion_ip + "</td>";
                        rows += "<td width='25%'>" + obj[i - 1].consulta_path + "</td>";
                        rows += "<td width='25%'>" + obj[i - 1].envio_path + "</td>";
                        rows += "<td width='25%'>" + obj[i - 1].estado_path + "</td>";
                        rows += "<td width='25%'>" + obj[i - 1].formato + "</td>";
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].courier_id + "' class='btn-cancel borrar-courier' value='Eliminar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado").html(rows);
            }
        });
    }    

    var listarCouriers = function(){
        $.ajax({
            url: "../rutas_ajax/couriers/listar.php?",
            type: "POST",
            success: function(r){
                obj = JSON.parse(r);
                var rows = "";
                if(obj.length != 0){
                    rows += "<table style='margin-top: 5%;'>";
                    rows += "<thead>";
                    rows += "<tr>";
                    rows += "<th>Nombre</th>";
                    rows += "<th>Ip</th>";
                    rows += "<th>Consulta</th>";
                    rows += "<th>Envio</th>";
                    rows += "<th>Estado</th>";
                    rows += "<th>Formato</th>";
                    rows += "</tr>";
                    rows += "</thead>";
                    rows += "<tbody>";                    
                    for(var i = 1; i <= obj.length; i++){
                        rows += "<tr>";
                        rows += "<td width='10%'><input type='text' id='" + obj[i - 1].courier_id + "-nombre' class='text-input-modify' value='" + obj[i - 1].nombre + "'></td>";
                        rows += "<td width='15%'><input type='text' id='" + obj[i - 1].courier_id + "-direccion_ip' class='text-input-modify' value='" + obj[i - 1].direccion_ip + "'></td>";
                        rows += "<td width='10%'><input type='text' id='" + obj[i - 1].courier_id + "-consulta_path' class='text-input-modify' value='" + obj[i - 1].consulta_path + "'></td>";
                        rows += "<td width='10%'><input type='text' id='" + obj[i - 1].courier_id + "-envio_path' class='text-input-modify' value='" + obj[i - 1].envio_path + "'></td>";
                        rows += "<td width='10%'><input type='text' id='" + obj[i - 1].courier_id + "-estado_path' class='text-input-modify' value='" + obj[i - 1].estado_path + "'></td>";
                        rows += "<td width=5%'><input type='text' id='" + obj[i - 1].courier_id + "-formato' class='text-input-modify' value='" + obj[i - 1].formato + "'></td>";                     
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].courier_id + "' class='btn-cancel borrar-courier' value='Eliminar'/></td>";
                        rows += "<td width='10%'><input type='button' id='" + obj[i - 1].courier_id + "' class='btn-cancel editar-courier' value='Editar'/></td>";
                        rows += "</tr>";
                    }
                    rows += "</tbody>";
                    rows += "</table>";                        
                }
                $("#listado").html(rows);
            }
        });
    }
    
    $(document).ready(function(){
        $("#admin-shop-form-card-provider").hide();
        $("#admin-shop-form-courier-provider").hide();
 
        $("#agregarTarjeta").on('click',function(){
            agregarTarjeta();
        }) 

        $("#agregarProveedor").on('click',function(){
            agregarProveedor();
            // listarProveedores();
        }) 

        $(document).on('click', '.borrar-emisor', function (event) {
            var id = $(this).attr('id');
            eliminarTarjeta(id);
            // $(this).closest('tr').remove();
        }); 

        $(document).on('click', '.editar-emisor', function (event) {
            var id = $(this).attr('id');
            editarTarjeta(id);
            //$(this).closest('tr').remove();
        });         

        $(document).on('click', '.borrar-courier', function (event) {
            var id = $(this).attr('id');
            eliminarCourier(id);
            // $(this).closest('tr').remove();
        });

        $(document).on('click', '.editar-courier', function (event) {
            var id = $(this).attr('id');
            editarCourier(id);
            //$(this).closest('tr').remove();
        });                          
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
        listarTarjetas();
        if($(this).is(":checked")){
            $("#admin-shop-form-card-provider").show();
            $("#admin-shop-form-courier-provider").hide();
        }
    });

    $("#courier-section").click(function(){
        listarCouriers();
        if($(this).is(":checked")){
            $("#admin-shop-form-card-provider").hide();
            $("#admin-shop-form-courier-provider").show();
        }
    });
</script>