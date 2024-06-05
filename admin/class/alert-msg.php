

<script>$(document).ready(function() {
      $('.mybtn').trigger('click');
    window.setTimeout(function (){
    window.location.href = "<?php echo $redirect_link;?>";},2000);
    
    });</script>