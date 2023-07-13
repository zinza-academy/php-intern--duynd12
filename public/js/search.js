function searchPost(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#search').keyup(function (e) {
        if (e.keyCode === 13) {
            let data = e.target.value;
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    keyword: data
                },
            })
            e.preventDefault();
        }
    })
}
searchPost(searchUrl);
