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
            <span class='total'><b>TOTAL:</b> <span class='value'>Q 2,300.00</span></span>
            <span class='proceed'>
                <a id='proceed-button' class='btn-register'><i class='fas fa-credit-card'></i> Proceder</a>
            </span>
            <span class="squared-absolute">
                <span class="content">
                    <span class="exit-button">
                        <a class='btn-delete'><i class='fas fa-times'></i></a>
                    </span>
                    <form id="proceed-form">
                        <span class="proceed-total">

                        </span>
                        <span class="input-icon">
                            <input type='text' id='user-card' placeholder='Número de Tarjeta' required>
                            <i class="fas fa-credit-card"></i>
                        </span>
                        <span class="input-icon">
                            <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker" id="place-select">
                                <option value=default selected=selected disabled>Seleccione lugar</option>
                                <option value="Capital">Capital</option>
                            </select>
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                    </form>
                </span>
            </span>
        </div>
    </section>
</body>
</html>

<script>
    function load_summaries(){
        rows = "";
        rows += "<span class='title'>DETALLE</span>";
        rows += "<p class='justify'><i class='fas fa-exclamation'></i> Verifica que los productos listados a continuación sean los desados antes de proceder.</p>";
        rows += "<span class='product-summary'>";
        rows += "<img class='image' src='../../img/productos/default2.webp'>";
        rows += "<span class='information'>";
        rows += "<a class='btn-delete'><i class='fas fa-times'></i></a>";
        rows += "<span class='name'>KRAST</span>";
        rows += "<span class='info-row'>";
        rows += "<span class='details-container'>";
        rows += "<span class='details'>";
        rows += "<span class='color' style='background:#E6FF00;'></span>";
        rows += "<span class='size'>28.5</span>";
        rows += "</span>";
        rows += "<img src ='../../img/brands/adidas-white.png'>";
        rows += "</span>";
        rows += "<span class='money-quantity'>";
        rows += "<span class='quantity'><i class='fas fa-layer-group'></i> 3 </span>";
        rows += "<b>|</b>";
        rows += "<span class='money'> Q 600.00</span>";
        rows += "</span>";
        rows += "</span>";
        rows += "<span class='price'>Q 1,800.00</span>";
        rows += "</span>";
        rows += "</span>";

        //Únicamente para ver como se ven varios juntos. (Se puede borrar)
        rows += "<span class='product-summary'>";
        rows += "<img class='image' src='../../img/productos/default.jpg'>";
        rows += "<span class='information'>";
        rows += "<a class='btn-delete'><i class='fas fa-times'></i></a>";
        rows += "<span class='name'>SASS</span>";
        rows += "<span class='info-row'>";
        rows += "<span class='details-container'>";
        rows += "<span class='details'>";
        rows += "<span class='color' style='background:#FF8000;'></span>";
        rows += "<span class='size'>30</span>";
        rows += "</span>";
        rows += "<img src ='../../img/brands/nike-white.png'>";
        rows += "</span>";
        rows += "<span class='money-quantity'>";
        rows += "<span class='quantity'><i class='fas fa-layer-group'></i> 1 </span>";
        rows += "<b>|</b>";
        rows += "<span class='money'> Q 500.00</span>";
        rows += "</span>";
        rows += "</span>";
        rows += "<span class='price'>Q 500.00</span>";
        rows += "</span>";
        rows += "</span>";
        $(".container-1").html(rows);
    }

    $(document).ready(function(){
        load_summaries();
        proceed = 0;

        $('#proceed-button').click(function(){
            $('.mask').addClass('active');
            $('.squared-absolute').addClass('active');
            $('.proceed-total').html($('.total').html());
            proceed = 1;
        });

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