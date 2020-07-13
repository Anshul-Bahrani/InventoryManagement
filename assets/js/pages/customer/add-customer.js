$(function(){
    $("#add-customer").validate({
        'rules': {
            'first_name':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'last_name':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'street':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'city':{
                required: true,
                minlength: 2,
                maxlength: 255
            },
            'pincode':{
                required: true,
                minlength: 2,
                maxlength: 10
            },
            'state':{
                required: true,
                minlength: 2,
                maxlength:255
            },
            'contry':{
                required: true,
                minlength: 2,
                maxlength:255
            },
            'town':{
                required: true,
                minlength: 2,
                maxlength:255
            },
            'block_no':{
                required: true,
                minlength: 2,
                maxlength:255
            },
            'phone_no':{
                required: true,
                minlength: 10,
                maxlength:10
            },
            'email_id':{
                required: true,
                minlength: 2,
                maxlength:255
            },
            'gst_no':{
                required: true,
                minlength: 10,
                maxlength: 10
            }
        },
        submitHandler: function(form) {
            // do other things for a valid form
            form.submit();
        }
    });
});