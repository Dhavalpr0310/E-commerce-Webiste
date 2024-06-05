<script>
    $(document).on("click", '.delete_record', function() {

        var id = $(this).val();
        var action = 'delete';
        var tbl_name = '<?php echo $table; ?>';
        var field_name = '<?php echo $primary_key; ?>';

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recoverd this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {



                $.ajax({
                    url: 'ajax/action.php',

                    method: "POST",
                    data: {
                        id: id,
                        action: action,
                        tbl_name: tbl_name,
                        field_name: field_name
                    },
                    success: function() {


                        Swal.fire(
                            'Deleted!',
                            'Your Record has been deleted.',
                            'success'
                        )
                        window.setTimeout(function() {
                            window.location.href = "<?php echo $list_link; ?>";
                        }, 2000);


                    }
                })
            } else {}
        })



    });
</script>