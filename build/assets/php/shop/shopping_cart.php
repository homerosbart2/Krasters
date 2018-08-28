<html>
<head>
    <title>Krasters</title>   
</head>
<?php
    include '../modules/nav.php';
?>
<body>
    <section class="summary">
        <div class="summaries-container"> 
            
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

        rows += "<span class='total'><b>TOTAL</b>: Q 2,300.00</span>";
        rows += "<span class='proceed'>";
        rows += "<a class='btn-register'><i class='fas fa-credit-card'></i> Proceder</a>";
        rows += "</span>";
        $(".summaries-container").html(rows);
    }

    $(document).ready(function(){
        load_summaries();
    });
</script>