$(function(){
    $("#add-product").validate({
        'rules': {
            'name':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'specification':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'hsn_code':{
                required: true,
                number: true,
                minlength: 8,
                maxlength: 8
            }
        },
        submitHandler: function(form) {
            // do other things for a valid form
            form.submit();
        }
    });
});