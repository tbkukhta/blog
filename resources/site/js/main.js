$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
});
