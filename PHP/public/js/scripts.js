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

$("#product-table").ready(function () {
    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable`,
        success: function (html) {
            $('#product-table').empty();
            $('#product-table').append(html);
        }
    });
});

$("#filter-category").change(function () {
    $selected_category = $("#filter-category option:selected").val();
    $selected_group = $("#filter-group option:selected").val();

    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable?cat=${$selected_category}&grp=${$selected_group}`,
        success: function (html) {
            $('#product-table').empty();
            $('#product-table').append(html);
        }
    });
});

$("#filter-group").change(function () {
    $selected_category = $("#filter-category option:selected").val();
    $selected_group = $("#filter-group option:selected").val();

    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable?cat=${$selected_category}&grp=${$selected_group}`,
        success: function (html) {
            $('#product-table').empty();
            $('#product-table').append(html);
        }
    });
});

$("#product-table").on('click', '.pagination-link', function () {
    $selected_page = $(this).text();
    $selected_category = $("#filter-category option:selected").val();
    $selected_group = $("#filter-group option:selected").val();

    $.ajax({
        async: true,
        type: 'GET',
        url: `/product/fetchTable?pg=${$selected_page}&cat=${$selected_category}&grp=${$selected_group}`,
        success: function (html) {
            $('#product-table').empty();
            $('#product-table').append(html);
        }
    });
});