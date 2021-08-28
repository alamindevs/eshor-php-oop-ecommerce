<?php
    if ( !empty( $_SESSION['message_success'] ) ) {
        $message = $_SESSION['message_success'];
    ?>

<script>
    $.toast({
            heading: 'Success',
            text: "<?=$message?>",
            position: 'top-left',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });
</script>

<?php }

    unset( $_SESSION['message_success'] )
?>

<?php
    if ( !empty( $_SESSION['message_error'] ) ) {
        $message = $_SESSION['message_error'];
    ?>

<script>
    $.toast({
            heading: 'Error',
            text: "<?=$message?>",
            position: 'top-left',
            loaderBg:'#ff6849',
            icon: 'error',
            hideAfter: 3000,
            stack: 6
        });
</script>

<?php }

unset( $_SESSION['message_error'] )
?>