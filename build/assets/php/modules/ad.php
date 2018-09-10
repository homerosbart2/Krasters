<html>
<head>
    <title>Krasters</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../js/pnotify.custom.min.js" type="text/javascript"></script>
    <link href="../../css/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.css" media="all" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="../../css/main.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
    <span class="advertising-container">
        <img class="bg" src="../../img/ads/&shop/bg.jpg">
        <img class="logo" src="../../img/ads/&shop/logo.jpg">
        <span class="information">
            Obtén hasta un 25% en
            <span class="brand">
                &Shop
            </span> 
             por la compra de cualquier producto!
        </span>
        <a class="hide"><i class="fas fa-times"></i></a>
    </span>
</body>
</html>

<script>
$(document).ready(function(){
    $('.hide').click(function(){
        $('.advertising-container').hide();
    })
});
</script>