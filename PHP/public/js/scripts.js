$('.login-form').validate({
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

$('#product-form').validate({
    onfocusout: false,
    rules: {
        product_name: {
            required: true,
            minlength: 5
        },
        category: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submit()
    }
});

$('#group-form').validate({
    onfocusout: false,
    rules: {
        group_name: {
            required: true,
            minlength: 5
        },
        leader: {
            required: true,
        }
    },
    submitHandler: function (form) {
        form.submit()
    }
});

$(".del").click(function(){
    if (!confirm("Do you want to delete?")){
        return false;
    }
});

$("#leader").change(function () {
    $(":checkbox").each(function (){
        $(this).removeAttr("disabled");
    });
    $selected_user = $("#leader option:selected").val();
    $checkbox = $(`:checkbox[value=${$selected_user}]`);
    $checkbox.prop("checked", false);
    $checkbox.prop("disabled", true);
});

$("#filter-by").change(function () {
    $("#filter-select").empty();
    $selected_filter = $("#filter-by option:selected").val();
    if ($selected_filter != "") {
        $.ajax({
            async: true,
            type: 'GET',
            url: `/${$selected_filter}/fetch`,
            success: function (html) {
                $('#filter-select').append(html);
            }
        });
    }
    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable`,
        success: function (html) {
            $('#product-table tbody').empty();
            $('#product-table tbody').append(html);
        }
    });
});

$("#filter-select").change(function () {
    $filter_by = $("#filter-by option:selected").val();
    $selected_filter = $("#filter-select option:selected").val();
    if ($selected_filter == "") {
        $.ajax({
            async: true,
            type: 'GET',
            url: `/product/fetchTable`,
            success: function (html) {
                $('#product-table tbody').empty();
                $('#product-table tbody').append(html);
            }
        });
        return;
    }
    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable?${$filter_by}=${$selected_filter}`,
        success: function (html) {
            $('#product-table tbody').empty();
            $('#product-table tbody').append(html);
        }
    });
});