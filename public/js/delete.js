function deleteItems(url, itemSelector, successMessage) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var recordIds = [];
    $(itemSelector + ':checked').each(function () {
        recordIds.push($(this).val());
    });
    if (recordIds.length > 0) {
        let confirmDelete = confirm("Bạn có chắc chắn muốn xóa?");
        if (confirmDelete) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    ids: recordIds,
                },
                success: function (response) {
                    alert(successMessage);
                    window.location.reload();
                },
                error: function (xhr) {
                    alert("Xóa thất bại");
                }
            });
        }
    }
}

$('#delete-topics-btn').on('click', function () {
    deleteItems(deleteTopicsUrl, 'input[name="topic_ids[]"]', "Các chủ đề đã được xóa thành công");
});

$('#delete-users-btn').on('click', function () {
    deleteItems(deleteUsersUrl, 'input[name="user_ids[]"]', "Người dùng đã được xóa thành công");
});

$('#delete-tags-btn').on('click', function () {
    deleteItems(deleteTagsUrl, 'input[name="tag_ids[]"]', "Các tag đã được xóa thành công");
});

