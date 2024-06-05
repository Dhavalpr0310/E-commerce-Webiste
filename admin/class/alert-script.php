<script>

	
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
$('.mybtn').click(function() {


Toast.fire({
 type: '<?php echo $alert;?>',

title: '<?php echo $msg;?>'
})
    
  });

    </script> 