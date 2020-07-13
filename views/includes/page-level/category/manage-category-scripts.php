<script src="<?=BASEASSETS;?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=BASEASSETS;?>vendor/datatables/datatables.bootstrap4.min.js"></script>
<script src="<?=BASEASSETS;?>vendor/toastr/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    <?php
    if(Session::hasSession(VALIDATION_ERROR)):
    ?>
        toastr.success("<?=Session::getSession(VALIDATION_ERROR);?>", "Failed!");
    <?php
        Session::unsetSession(VALIDATION_ERROR);
    elseif(Session::hasSession(ADD_SUCCESS)):
    ?>
        toastr.success("<?=Session::getSession(ADD_SUCCESS);?>", "Success");
    <?php
        Session::unsetSession(ADD_SUCCESS);
    elseif(Session::hasSession(ADD_ERROR)):
    ?>
        toastr.error("<?=Session::getSession(ADD_ERROR);?>", "Failure!");
    <?php
        Session::unsetSession(ADD_ERROR);
    elseif(Session::hasSession(EDIT_SUCCESS)):
    ?>
        toastr.success("<?=Session::getSession(EDIT_SUCCESS);?>", "Success");
    <?php
        Session::unsetSession(EDIT_SUCCESS);
    elseif(Session::hasSession(EDIT_ERROR)):
    ?>
        toastr.error("<?=Session::getSession(EDIT_ERROR);?>", "Failure!");
    <?php
        Session::unsetSession(EDIT_ERROR);
    elseif(Session::hasSession(DELETE_SUCCESS)):
    ?>
        toastr.success("<?=Session::getSession(DELETE_SUCCESS);?>", "Success");
    <?php
        Session::unsetSession(DELETE_SUCCESS);
    elseif(Session::hasSession(DELETE_ERROR)):
    ?>
        toastr.error("<?=Session::getSession(DELETE_ERROR);?>", "Failure!");
    <?php
        Session::unsetSession(DELETE_ERROR);
    endif;
    ?>
</script>
<script src="<?=BASEASSETS;?>js/pages/category/manage-category.js"></script>