$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteData(id) {
    swal({
        title: "Xác nhận xóa",
        text: "Bạn có chắc chắn muốn xóa danh mục này không?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Đồng ý",
        // closeOnConfirm: false,
        // closeOnCancel: false,
    })
        .then((result) => {
            if (result.value == true) {
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name=" csrf-token"]').attr('content')
                //     }
                // });
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "/admintrator/category/" + id + "/delete",
                    type: "POST",
                    data:{_token:_token},
                    success: function (results) {
                        swal("Thành công!", results.message, "success");
                        location.reload();
                    },
                    error: function () {
                        swal({
                            title: 'Đã xảy ra lỗi ...',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                })
            }
        });
}


