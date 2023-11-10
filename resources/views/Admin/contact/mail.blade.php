<style>
    table { font-family: Georgia,serif;  font-size: 16px;  text-align:left;  }
    h1 { font-size: 36px;  font-family: sans-serif;	}
    p {  line-height: 25px;	}
    .table-style {
        text-align: center;
    }
    </style>
    <center style="padding-bottom: 20px;">
    <table>
        <tr>
            <td >
                <p><style>
                    table { font-family: Georgia,serif;  font-size: 16px;  text-align:left;  }
                    h1 { font-size: 36px;  font-family: sans-serif;	}
                    p {  line-height: 25px;	}
                    .table-style {
                        text-align: center;
                    }
                    </style>
                    <center style="padding-bottom: 20px;">
                    <p>Chào bạn {{ $e_name }}!</p>
                    <p>Cảm ơn bạn đã gửi phản hồi đến chúng tôi!</p>
                    <p>Hệ thống phản hồi nội dung của bạn như sau:</p>
                    <p>{!! $e_message !!}</p>
                <p><b>Trân trọng cảm ơn !</b></p>
            </td>
        </tr>
    </table>
    </center>
