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

<body>
    <section id="header-admin">
        <div class="wrapper">
            <div class="shop-admin">
                <div class="form-container">
                    <h1>ADMINISITRACIÓN DE <span class="company-name"><b>KRAS</b>TERS</span></h1>

                    <form action="" class="button-bar">
                        <input type="radio" name="menu-bar" id="add-new-section" value="0">
                        <label for="add-new-section" class="btn-menu" >
                            Agregar nuevo
                        </label>
                        <input type="radio" name="menu-bar" id="add-existence-section" value="1"> 
                        <label for="add-existence-section" class="btn-menu">
                            Agregar existencia
                        </label>
                        <input type="radio" name="menu-bar" id="edit-section" value="2"> 
                        <label for="edit-section" class="btn-menu">
                        <i class="fas fa-edit"></i> Editar
                        </label>
                        <input type="radio" name="menu-bar" id="brand-color-section" value="3"> 
                        <label for="brand-color-section" class="btn-menu">
                            Marcas y colores
                        </label>
                        
                    </form>

                    <span class="separation l"></span>

                    <span id="form-title" class="form-title"></span>
                    <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Administra <span class="company-name"><b>KRAS</b>TERS</span> seleccionando una sección.</span>
                    <form id="admin-shop-form-add" class="admin-shop-form">
                    <input type='text' id='producto_nombre' placeholder='Nombre' required>
                    <span class='form-row'>
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="color-select">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT C.color_nombre,C.color_codigo FROM Colores as C order by C.color_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione color</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $codigo=$row["color_nombre"];
                                        $nombre=$row["color_nombre"];
                                        echo "<option value='".$codigo."'>".$nombre."</option>";         
                                    }
                                    pg_close($link);
                                ?>
                            </select>
                            <i class="fas fa-paint-roller"></i>
                        </span>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_precio' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </span>
                    <span class='form-row'>
                        <span class="input-icon">
                            <input type='number' min="25" id='producto_talla' placeholder='Talla' required>
                            <i class="fas fa-shoe-prints"></i>
                        </span>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_cantidad' placeholder='Cantidad' required>
                            <i class="fas fa-layer-group"></i>
                        </span>
                    </span>
                    <span class="input-icon">
                        <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="marca-select">
                            <?php
                                $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                $query = "SELECT M.marca_nombre FROM Marcas as M order by M.marca_nombre";
                                $result = pg_query($link, $query);
                                echo "<option value=default selected=selected disabled>Seleccione marca</option>";
                                while ($row = pg_fetch_assoc($result)){
                                    $codigo=$row["marca_nombre"];
                                    $nombre=$row["marca_nombre"];
                                    echo "<option value='".$codigo."'>".$nombre."</option>";         
                                }
                                pg_close($link);
                            ?>  
                        </select>
                        <i class="fas fa-adjust"></i>
                    </span>
                    
                    <textarea id="producto_descripcion" rows="4" cols="50" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                    <input type="file" id="product-image" class="inputfile" />
                    <span class="input-container"><label for="product-image"><i class="fas fa-file-image"></i></label><span id="file-name"></span></span>
                    <span class="form-row">
                        <span></span>
                        <a class="btn-register" id="btn_agregar_producto"><i class="fas fa-plus"></i> Agregar</a>
                    </span>
                    </form>


                    <form id="admin-shop-form-existence" class="admin-shop-form">
                        <span class="input-icon">
                            <select class="selectpicker" data-live-search="true" data-live-search-style="startsWith"  id="product-select1">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT DISTINCT P.precio,P.producto_nombre,M.marca_nombre FROM Productos as P, Marcas as M WHERE P.marca_nombre = M.marca_nombre ORDER BY P.producto_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione producto</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        $nombre=$row["producto_nombre"];
                                        $marca=$row["marca_nombre"];
                                        $precio=$row["precio"];
                                        echo "<option value='".$nombre."-".$marca."-".$precio."'>".$nombre.' - [ '.$marca."]</option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                        </span>
                        
                        <span class='form-row'>
                            <span class="input-icon">
                                <input type='number' min="25" id='producto_talla_existencia' placeholder='Talla' required>
                                <i class="fas fa-shoe-prints"></i>
                            </span>
                            <span class="input-icon">
                                <input type='number' min="1" id='producto_cantidad_existencia' placeholder='Cantidad' required>
                                <i class="fas fa-layer-group"></i>
                            </span>
                        </span>
                        
                        <span class='form-row'>
                            <span class="input-icon">
                                <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="color-select2">
                                    <?php
                                        $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                        $query = "SELECT DISTINCT P.precio,P.producto_nombre,M.marca_nombre FROM Productos as P, Marcas as M WHERE P.marca_nombre = M.marca_nombre ORDER BY P.producto_nombre";
                                        $result = pg_query($link, $query);
                                        echo "<option value=default selected=selected disabled>Seleccione producto</option>";
                                        while ($row = pg_fetch_assoc($result)){
                                            $nombre=$row["producto_nombre"];
                                            $marca=$row["marca_nombre"];
                                            $precio=$row["precio"];
                                            echo "<option value='".$nombre."-".$marca."-".$precio."'>".$nombre.' - [ '.$marca."]</option>";         
                                        }
                                        pg_close($link);
                                    ?>
                                </select>
                                <i class="fas fa-paint-roller"></i>
                            </span>
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_existencia_producto"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>

                    <form id="admin-shop-form-edit" class="admin-shop-form">
                        <span class="input-icon">
                            <select class="selectpicker" data-live-search="true" id="product-select2">
                                <?php
                                    $link = pg_connect("host=localhost dbname=TIENDA user=tienda password=%TiendaAdmin18%");
                                    $query = "SELECT P.producto_id, P.color_nombre, P.producto_nombre,M.marca_nombre FROM Productos as P, Marcas as M, Colores as C WHERE P.marca_nombre = M.marca_nombre AND P.color_nombre = C.color_nombre ORDER BY P.producto_nombre";
                                    $result = pg_query($link, $query);
                                    echo "<option value=default selected=selected disabled>Seleccione producto</option>";
                                    while ($row = pg_fetch_assoc($result)){
                                        // $codigo=$row["producto_id"];
                                        $codigo=$row["producto_id"];
                                        $nombre=$row["producto_nombre"];
                                        $marca=$row["marca_nombre"];
                                        $color=$row["color_nombre"];
                                        echo "<option value='".$codigo."'>".$nombre.' - [ '.$marca.", ".$color."] </option>";         
                                    }
                                    pg_close($link);
                                ?>  
                            </select>
                        </span>
                        
                        <input type='text' id='producto_nombre_editar' placeholder='Nombre' required>
                        <span class="input-icon">
                            <input type='number' min="1" id='producto_precio_editar' placeholder='Precio' required>
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <textarea id="producto_descripcion_editar" rows="4" cols="50" form="admin-shop-form" placeholder='Ingresa una descripción'></textarea>
                        <span class="form-row">
                            <a class="btn-cancel" id="btn_eliminar_producto"><i class="fas fa-trash-alt"></i> Eliminar</a>
                            <a class="btn-register" id="btn_editar_producto"><i class="fas fa-save"></i> Guardar</a>
                        </span>
                    </form>

                    <form id="admin-shop-form-brand-color" class="admin-shop-form">
                        <input type='text' id='marca_nombre' placeholder='Nombre' required>
                        <input type="file" id="brand-image" class="inputfile" />
                        <span class="input-container"><label for="brand-image"><i class="fas fa-file-image"></i></label><span id="brand-image-name"></span></span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_marca"><i class="fas fa-plus"></i> Agregar</a>
                        </span>

                        <span class="separation xl"></span>
                        <span id="form-title" class="form-title"><b>AGREGAR</b> COLOR</span>
                        <span id="form-description" class="description"><i class="fas fa-exclamation-circle"></i> Agrega nuevos colores para los productos de <span class="company-name"><b>KRAS</b>TERS</span>.</span>
                        <span class="form-row">
                            <span class="input-icon">
                                <input type='text' id='color_nombre' placeholder='Nombre' required>
                            </span>
                            <span class="input-icon">
                            <input type='text' id='color_codigo' placeholder='Codigo negro FFFFFF' required>
                                <i class="fas fa-fill-drip"></i>
                            </span>
                            
                        </span>
                        <span class="form-row">
                            <span></span>
                            <a class="btn-register" id="btn_agregar_color"><i class="fas fa-plus"></i> Agregar</a>
                        </span>
                    </form>
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
    $(document).ready(function(){
        $("#admin-shop-form-add").hide();
        $("#admin-shop-form-existence").hide();
        $("#admin-shop-form-edit").hide();
        $("#admin-shop-form-brand-color").hide();
    });

    $('#product-image').click(function() {
        $('#product-image').change(function() {
            var filename = document.getElementById("product-image").files[0].name;
            console.log(filename);
            $('#file-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });

    $('#brand-image').click(function() {
        $('#brand-image').change(function() {
            var filename = document.getElementById("brand-image").files[0].name;
            console.log(filename);
            $('#brand-image-name').html(' ' + filename + ' <i class="fas fa-check"></i>');
        });
    });

    $("#add-new-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").show();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>AGREGAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega nuevos productos a <span class="company-name"><b>KRAS</b>TERS</span> y llena la tienda.');
        }
    });

    $("#add-existence-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").show();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>AGREGAR</b> EXISTENCIA");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega existencia a los productos ya incluidos en <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $("#edit-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").show();
            $("#admin-shop-form-brand-color").hide();
            $("#form-title").html("<b>EDITAR</b> PRODUCTO");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Edita el precio, descripción y nombre de un producto de <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $("#brand-color-section").click(function(){
        if($(this).is(":checked")){
            $("#admin-shop-form-add").hide();
            $("#admin-shop-form-existence").hide();
            $("#admin-shop-form-edit").hide();
            $("#admin-shop-form-brand-color").show();
            $("#form-title").html("<b>AGREGAR</b> MARCA");
            $("#form-description").html('<i class="fas fa-exclamation-circle"></i> Agrega las marcas registradas de los productos de <span class="company-name"><b>KRAS</b>TERS</span>.');
        }
    });

    $(document).ready(function(){
        //Agregar nuevo producto
        $('#btn_agregar_producto').on('click', function(){
            nombre = document.getElementById("producto_nombre").value;
            descripcion = document.getElementById("producto_descripcion").value;
            precio = parseFloat(document.getElementById("producto_precio").value);
            talla = parseInt(document.getElementById("producto_talla").value);
            cantidad = parseInt(document.getElementById("producto_cantidad").value);
            color = $("#color-select").val();
            marca = $("#marca-select").val();
            if((precio > 0)&&(cantidad > 0)&&(talla > 0)&&(color != null)&&(marca != null)&&(nombre != "")){
                $.ajax({
                    url: "../rutas_ajax/productos/insertar.php?nombre=" + nombre + "&descripcion=" + descripcion + "&precio=" + precio + "&talla=" + talla + "&cantidad=" + cantidad + "&color=" + color + "&marca=" + marca,
                    type: "POST",
                    success: function(r){
                        //en r viene el id
                        if(r > 0){
                            //primer select
                            select = document.getElementById('product-select1');
                            select.options[select.options.length] = new Option(r, nombre);
                            //segundo select
                            select = document.getElementById('product-select2'); 
                            select.options[select.options.length] = new Option(r, nombre);   
                            new PNotify({
                                title: 'Nuevo producto',
                                text: 'Producto ingresado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("producto_nombre").value = "";
                            document.getElementById("producto_descripcion").value = "";
                            document.getElementById("producto_precio").value = "";
                            document.getElementById("producto_talla").value = "";
                            document.getElementById("producto_cantidad").value = "";                                                       
                        }else{
                            new PNotify({
                                title: 'Nuevo producto',
                                text: 'Error al insertar producto, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nuevo producto',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }                       
        });

        //Agregar existencia producto
        $('#btn_agregar_existencia_producto').on('click', function(){
            var textoComboProducto = ($("#product-select1").val()).split("-");
            nombre = textoComboProducto[0];
            marca = textoComboProducto[1];
            precio = textoComboProducto[2];
            cantidad = parseFloat(document.getElementById("producto_cantidad_existencia").value);
            talla = parseInt(document.getElementById("producto_talla_existencia").value);
            color = $("#color-select2").val();
            if((talla > 0)&&(cantidad > 0)&&(color != null)&&(marca != null)&&(nombre != null)){
                $.ajax({
                    url: "../rutas_ajax/productos/editar_insertar.php?nombre=" + nombre + "&talla=" + talla + "&cantidad=" + cantidad + "&color=" + color + "&marca=" + marca + "&precio=" + precio,
                    type: "POST",
                    success: function(r){
                        alert(r);
                        //si actualizo devolvera 0, si creo uno nuevo un id > 0 si hubo error -1
                        if(r > 0){ //creamos un producto nuevo
                            //primer select
                            select = document.getElementById('product-select1');
                            select.options[select.options.length] = new Option(r, nombre);
                            //segundo select
                            select = document.getElementById('product-select2'); 
                            select.options[select.options.length] = new Option(r, nombre);   
                            new PNotify({
                                title: 'Nuevo producto',
                                text: 'Producto ingresado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                            document.getElementById("producto_talla_existencia").value = "";
                            document.getElementById("producto_cantidad_existencia").value = "";                                                 
                        }else if(r == 0){ //actualizo productos
                            new PNotify({
                                title: 'Agregar existencias',
                                text: 'Inventario actualizado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        }else{
                            new PNotify({
                                title: 'Agregar existencias',
                                text: 'Error al agregar existencias verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Agregar existencias',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }                      
        });

        //Capturar el cambio en editar producto
        $("#product-select2").on('change',function(){
            producto = $("#product-select2").val();
            $.ajax({
                url: "../rutas_ajax/productos/listado.php?producto=" + producto,
                type: "POST",
                success: function(r){
                    if(r != 0){
                        obj = JSON.parse(r);                        
                        document.getElementById("producto_precio_editar").value = obj[0].precio;
                        document.getElementById("producto_nombre_editar").value = obj[0].producto_nombre;
                        document.getElementById("producto_descripcion_editar").value = obj[0].descripcion;                   
                    }
                }
            });              
        });


        var editar_eliminar = function(accion){
            producto = $("#product-select2").val();
            precio = document.getElementById("producto_precio_editar").value;
            nombre = document.getElementById("producto_nombre_editar").value;
            descripcion = document.getElementById("producto_descripcion_editar").value; 
            if((precio > 0)&&(nombre != "")&&(producto != null)){
                $.ajax({
                    url: "../rutas_ajax/productos/editar_eliminar.php?producto=" + producto + "&nombre=" + nombre + "&precio=" + precio + "&descripcion=" + descripcion + "&accion=" + accion,
                    type: "POST",
                    success: function(r){
                        //si elimino devolvera un 0, si actualizo un 1 y si hubo error -1
                        if(r == 1){ //actualizo producto
                            new PNotify({
                                title: 'Editar producto',
                                text: 'Producto actualizado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                                                
                        }else if(r == 0){ //elimino producto
                            new PNotify({
                                title: 'Eliminar producto',
                                text: 'Producto eliminado exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        }else{
                            new PNotify({
                                title: 'Editar/Eliminar producto',
                                text: 'Error al editar/eliminar producto, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Editar/Eliminar producto',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }               
        }
        //Editar producto
        $('#btn_editar_producto').on('click', function(){
            editar_eliminar(1);
        });

        //Eliminar producto
        $('#btn_eliminar_producto').on('click', function(){
            editar_eliminar(0);
        });        

        //Agregar nueva marca
        $('#btn_agregar_marca').on('click', function(){
            nombre = document.getElementById("marca_nombre").value;
            if(nombre != ""){
                $.ajax({
                    url: "../rutas_ajax/marcas/insertar.php?nombre=" + nombre,
                    type: "POST",
                    success: function(r){
                        //0-> guardo, -1 error
                        if(r == 0){ //actualizo producto
                            new PNotify({
                                title: 'Nueva marca',
                                text: 'Marca ingresada exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                                                
                        }else{
                            new PNotify({
                                title: 'Nueva marca',
                                text: 'Error al insertar marca, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nueva marca',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }              
        });  

        //agregar nuevo color
        $('#btn_agregar_color').on('click', function(){
            nombre = document.getElementById("color_nombre").value;
            codigo = document.getElementById("color_codigo").value;
            if(nombre != ""){
                $.ajax({
                    url: "../rutas_ajax/colores/insertar.php?nombre=" + nombre + "&codigo=" + codigo,
                    type: "POST",
                    success: function(r){
                        //0-> guardo, -1 error
                        if(r == 0){ //actualizo producto
                            new PNotify({
                                title: 'Nuevo color',
                                text: 'Color ingresada exitosamente.',
                                type: 'success',
                                styling: 'bootstrap3'
                            });                                                
                        }else{
                            new PNotify({
                                title: 'Nuevo color',
                                text: 'Error al insertar color, verifique sus datos.',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }                        
                    }
                });
            }else{
                new PNotify({
                    title: 'Nuevo color',
                    text: 'Complete correctamente todos campos porfavor.',
                    type: 'warning',
                    styling: 'bootstrap3'
                });
            }              
        });                                
    });
</script>