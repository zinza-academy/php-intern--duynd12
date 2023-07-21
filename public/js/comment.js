$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.btn-submit-content', function (e) {
    let content = $('#content').val();
    if (content == "") {
        alert("Vui lòng nhập dữ liệu");
    }
    else {
        var url = $(this).parents('form').data('url');
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'content': content,
                'post_id': $('#post_id').val()
            },
            success: function (data) {
                $('#content').val('');
                $("#comment-wrap").append(data.content);
            },
            error: function (xhr) {
            }
        })
    }
    e.preventDefault();
})
