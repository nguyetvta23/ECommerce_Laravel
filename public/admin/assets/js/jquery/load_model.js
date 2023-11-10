$(document).ready(function(){
  
    $('.get_value').click(function(){
        var btn = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '/get_data_cmt/'+btn,
            type: "GET",
            success: function(data) {
                // in ra bên ngoài 
                console.log(data);
               $('#content_user').html(data.query[0].m_content);
               $('#id_user').html(data.query[0].name);
            }
        })
    })
});

$(document).ready(function(){
    $('.statust').click(function(){
        var idbl =$(this).data('order_id');
        var m_status = $(this).val();
        var _token = $('input[name="_token"]').val();
        // alert(m_status);
        $.ajax({
            url:'/admintrator/update-trangthai',
            method:'post',
            data:{idbl:idbl, m_status:m_status, _token: _token},
            success: function(data) 
            {   
                console.log(data);
                if(data == 'done')
                {
                    alert('Bạn đã thay đổi trạng thái');
                    location.reload();
                }
                else
                {
                    alert('Gặp lỗi rồi !');
                }
            }
        });
    });
});
$(document).ready(function(){
    $('.answer_queston').click(function(){
        var idbl = $(this).val();
        console.log(idbl)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           url :'/get_data_khachang/'+idbl,
           type : 'GET',
           data : {
             id : idbl
           }
           ,success : function(data){
              $('.name_').text(data.query[0].name)
              $('.content_').text(data.query[0].m_content)
              $('.input-answer').attr('value',data.query[0].idbl)
            //   sử dụng nối chuỗi để gửi dữ liệu 
            var action_controller = "/admintrator/answer_data/"+idbl;
              $('.form_').attr('action',action_controller) 
           }
        })

    })
  
})
