<!-- Plugin JS File -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
<script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="assets/vendor/floating-parallax/parallax.min.js"></script>
<script src="assets/vendor/zoom/jquery.zoom.js"></script>

<!-- Main Js -->
<script src="assets/js/main.min.js"></script>
<script>
    function checkCart() {
        let user_id = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>";
        if (user_id != '') {
            window.location = "cart.php";
        } else {
            alert("You Have To Login First");
        }
    }
</script>
<script>
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
        return true;
    }
</script>
