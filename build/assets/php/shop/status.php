<html>
<head>
    <title>Krasters</title>

</head>
<?php
    include '../modules/nav.php';
?>
<body>
    <section class="status">
        <div class="status-container">
            <span class="order">
                <span class="name">
                    <b>COMPRA</b> #1345245
                </span>
            </span>
            <span class="simplified-summary">
                <a id='expand-detail-table' class='btn-register'><i class="fas fa-angle-down"></i> Detalle</a>
                <span class="detail-table">
                    <table></table>
                </span>
            </span>
            <span class="center-box">
                <span class="stage">
                    <b>Estado:</b><span class="name">Desconocido <i class="far fa-question-circle"></i></span>
                </span>
                <span class="chart-container">
                    <i id="stage-1" class="far fa-circle"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i id="stage-2" class="far fa-circle"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i id="stage-3" class="far fa-circle"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i id="stage-4" class="far fa-circle"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i class="fas fa-minus"></i><i id="stage-5" class="far fa-circle"></i>
                </span>
                <span class="status-information">Si el estado del pedido es <b>Desconocido</b>, comuníquese con su servicio de courier para más información.</span>
            </span>
        </div>
    </section>
</body>
</html>

<script>
function load_details(){
    rows = '';
    rows += '<tr class="table-titles"><th></th><th></th><th></th><th></th></tr>';
    //Como agregar elementos a la tabla de detalles.
    rows += '<tr class="element">';
    rows += '<td>- KRAST</td>'; //Nombre
    rows += '<td>Rojo</td>'; //Color
    rows += '<td>28.5</td>'; //Talla
    rows += '<td>1</td>'; //Cantidad
    rows += '</tr>';

    rows += '<tr class="element">';
    rows += '<td>- KRAST</td>'; //Nombre
    rows += '<td>Rojo</td>'; //Color
    rows += '<td>28.5</td>'; //Talla
    rows += '<td>1</td>'; //Cantidad
    rows += '</tr>';

    rows += '<tr class="element">';
    rows += '<td>- KRAST</td>'; //Nombre
    rows += '<td>Rojo</td>'; //Color
    rows += '<td>28.5</td>'; //Talla
    rows += '<td>1</td>'; //Cantidad
    rows += '</tr>';

    $('.detail-table').find('table').html(rows);
}

$(document).ready(function(){
    var expanded = 0;

    $('#expand-detail-table').click(function(){
        $('.detail-table').toggle();
        if(expanded == 0){
            $(this).find('i').css('transform', 'rotate(180deg)');
            expanded = 1;
        }else{
            $(this).find('i').css('transform', 'rotate(0deg)');
            expanded = 0;
        }
    });

    load_details();

    setStage(3);
});

//Función para cambiar el estado, 1 - 5 (int) son estados válidos, cualquier otro valor va a irse al default y si al recargar la página no se llama la función, por predeterminado, ya está cargado el default.
function setStage(stage){
    switch(stage){
        case 1:{
            switchClass($('#stage-1'), 'far', 'fas');
            switchClass($('#stage-2'), 'fas', 'far');
            switchClass($('#stage-3'), 'fas', 'far');
            switchClass($('#stage-4'), 'fas', 'far');
            switchClass($('#stage-5'), 'fas', 'far');
            $('.stage').find('.name').html('Orden Nueva <i class="fas fa-box-open"></i>');
            break;
        }
        case 2:{
            switchClass($('#stage-1'), 'far', 'fas');
            switchClass($('#stage-2'), 'far', 'fas');
            switchClass($('#stage-3'), 'fas', 'far');
            switchClass($('#stage-4'), 'fas', 'far');
            switchClass($('#stage-5'), 'fas', 'far');
            $('.stage').find('.name').html('Surtiendo <i class="fas fa-dolly"></i>');
            break;
        }
        case 3:{
            switchClass($('#stage-1'), 'far', 'fas');
            switchClass($('#stage-2'), 'far', 'fas');
            switchClass($('#stage-3'), 'far', 'fas');
            switchClass($('#stage-4'), 'fas', 'far');
            switchClass($('#stage-5'), 'fas', 'far');
            $('.stage').find('.name').html('Empacando <i class="fas fa-cube"></i>');
            break;
        }
        case 4:{
            switchClass($('#stage-1'), 'far', 'fas');
            switchClass($('#stage-2'), 'far', 'fas');
            switchClass($('#stage-3'), 'far', 'fas');
            switchClass($('#stage-4'), 'far', 'fas');
            switchClass($('#stage-5'), 'fas', 'far');
            $('.stage').find('.name').html('En Ruta <i class="fas fa-truck"></i>');
            break;
        }
        case 5:{
            switchClass($('#stage-1'), 'far', 'fas');
            switchClass($('#stage-2'), 'far', 'fas');
            switchClass($('#stage-3'), 'far', 'fas');
            switchClass($('#stage-4'), 'far', 'fas');
            switchClass($('#stage-5'), 'far', 'fas');
            $('.stage').find('.name').html('Entregado <i class="fas fa-clipboard-check"></i>');
            break;
        }
        default:{
            switchClass($('#stage-1'), 'fas', 'far');
            switchClass($('#stage-2'), 'fas', 'far');
            switchClass($('#stage-3'), 'fas', 'far');
            switchClass($('#stage-4'), 'fas', 'far');
            switchClass($('#stage-5'), 'fas', 'far');
            $('.stage').find('.name').html('Desconocido <i class="far fa-question-circle">');
            break;
        }
    }
}

//Función genérica para cambiar clases.
function switchClass(lmnt, removeClassName, addClassName){
    if(lmnt.hasClass(removeClassName)){
        lmnt.removeClass(removeClassName).addClass(addClassName);
    }
}
</script>