$(function () {
    $('#logout-btn').on('click', function () {
        Swal.fire({
            title: 'Log Out?',
            text: "You can get back again next time.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/auth/logout',
                    type: 'GET',
                    success: function (response) {
                        Swal.fire(
                            'Logged Out',
                            response.message,
                            'success'
                        )
                        setInterval(function () {
                            location.reload();
                        }, 2000);
                    }
                })
            }
        })
    });
});
