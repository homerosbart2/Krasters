<html>
<body>
    <span class="ad">
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
    </span>
</body>
</html>

<script>
$(document).ready(function(){
    $('.hide').click(function(){
        $('.ad').css('bottom','-50px');
    })
});
</script>