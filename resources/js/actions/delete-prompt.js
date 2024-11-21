(function () {
    $(document).on('click', '#delete', function (e) {
        e.preventDefault()

        swal({
            title: "Are you sure?",
            text: "This action is permanent and cannot be reversed!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                location.href = $(this).attr('href');
            } else {
                return false;
            }
        })
    });
})();
