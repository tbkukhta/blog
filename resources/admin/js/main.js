$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.nav-treeview a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link === location) {
            $(this).addClass('active').parent().parents('.nav-item').addClass('menu-open');
        }
    });
    if ($('.pagination').length) {
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                success: function (data) {
                    $('#paginate').html(data);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                },
            });
        });
    }
    if ($('#thumbnail').length) {
        $(document).on('change', '#thumbnail', function () {
            $(this).attr('title', this.files[0].name);
            $(this).next('label').text(this.files[0].name);
            $('#image').remove();
            $('#thumbnail-label').after('<div id="image">' +
                '<div class="mb-2">' +
                '<button class="btn btn-danger" id="delete-image">Delete</button>' +
                '</div>' +
                '</div>');
        });
        $(document).on('click', '#delete-image', function (e) {
            e.preventDefault();
            let $thumbnail = $('#thumbnail');
            $thumbnail.attr('title', 'Choose an image...');
            $thumbnail.val('');
            $('[name="deleted"]').val(1);
            $thumbnail.next('label').text('Choose an image...');
            $('#image').remove();
        });
    }
});
