$('#form').validate({
    onfocusout: false,
    rules: {
        username: {
            required: true,
            minlength: 5
        },
        password: {
            required: true,
            minlength: 8
        },
        agree_terms: {
            required: true
        }
    },
    messages: {
        agree_terms: {
            required: "Please accept the terms to proceed."
        }
    },
    errorPlacement: function(error, element) {
        if (element.is(':checkbox')) {
            error.insertBefore($('.submit'));
        }
        else {
            error.insertAfter(element);
        }
    },
    submitHandler: function (form) {
        form.submit()
    }
});