$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.password a').click(function (e) {
    e.preventDefault();
    let $input = $(this).parents('.password').find('input');
    let $span = $(this).find('span');
    if ($input.attr('type') === 'text') {
        $input.attr('type', 'password');
        $(this).attr('title', 'Show password');
        $span.removeClass('fa-lock-open').addClass('fa-lock');
    } else if ($input.attr('type') === 'password') {
        $input.attr('type', 'text');
        $(this).attr('title', 'Hide password');
        $span.removeClass('fa-lock').addClass('fa-lock-open');
    }
});
$('form').submit(function (e) {
    e.preventDefault();
    let $form = $(this);
    $('.form-control').removeClass('is-invalid');
    $('.custom-file').removeClass('is-invalid');
    $('.invalid-feedback').empty();
    $('.alert').remove();
    $.ajax({
        type: 'post',
        url: $form.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status === 'errors') {
                $.each(data.errors, function (key, value) {
                    if (key === 'avatar') {
                        $('[name="' + key + '"]').addClass('is-invalid');
                        $('.custom-file').addClass('is-invalid').nextAll('.invalid-feedback').text(value[0]);
                    } else {
                        $('[name="' + key + '"]').addClass('is-invalid').nextAll('.invalid-feedback').text(value[0]);
                    }
                });
            } else if (data.status === 'question') {
                $('#question').val(data.question).parent().show();
                $('#answer').parent().show();
            } else if (data.status === 'answer') {
                $('#scenario').val(2);
                $('#question').parent().hide();
                $('#answer').parent().hide();
                $('#password').attr('title', 'New password').attr('placeholder', 'New password').parent().show();
                $('#password_confirmation').parent().show();
            } else if (data.status === 'error') {
                $form.before('<div class="alert alert-danger">' + data.error + '</div>');
            } else if (data.status === 'success') {
                window.location.href = data.url;
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    })
});
