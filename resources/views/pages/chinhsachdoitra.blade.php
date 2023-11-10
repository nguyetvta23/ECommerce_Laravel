@extends('Auth.layouts.master')
@section('content')
    <main class="m-5">
        <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title">Chính sách đổi trả</h1>
                                <ul class="breadcrumb">
                                    <li style="list-style: none" class="breadcrumb-item "><a href="index.html">Trang chủ</a></li>
                                    <l style="list-style: none" class="breadcrumb-item active" aria-current="page">Chính sách đổi trả</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <h3>I. Chính sách đổi sản phẩm</h3>
        <h5>Trường hợp đổi hàng:</h5>
        <ol>
            <li>Quý khách được đổi size nếu như sản phẩm được thử không vừa chân</li>
            <li>Drake giao nhầm mã, nhầm size, nhầm màu</li>
            <li>Sản phẩm có lỗi khi không được báo trước.</li>
        </ol>
        <h5>Các trường hợp không chấp nhận đổi hàng:</h5>
        <ol>
            <li>Sản phẩm không được xác nhận mua từ Drake.</li>
            <li>Sản phẩm đã được sử dụng hoặc dính bẩn.</li>
            <li>Sản phẩm không được vận hành đúng theo chỉ dẫn, gây hỏng hóc sản phẩm.</li>
            <li>Sản phẩm được bán với giá sale từ 30% trở lên.</li>
        </ol>
        <h5> Điều kiện đổi hàng:</h5>
        <ol>
            <li>            Các sản phẩm mua tại Drake được áp dụng đổi size trong vòng 7 ngày (kể từ ngày quý khách nhận được hàng, căn cứ vào ngày gửi theo dấu bưu cục)
            </li>
            <li>            Trong trường hợp sản phẩm hết size và Kingdom Sneakers hỗ trợ đổi qua sản phẩm khác, sản phẩm đổi phải có giá trị bằng hoặc cao hơn so với giá trị hàng khách đã nhận trước đó. Chúng tôi sẽ không hoàn trả lại số tiền chênh lệch.
            </li>
            <li>            Sản phẩm chưa qua sử dụng (không bị dính bẩn)  và còn đủ hộp (còn nguyên vẹn), phụ kiện đi kèm, đủ phiếu bảo hành, và hóa đơn (nếu có).
            </li>
            <li>            Khách hàng đến trực tiếp cửa hàng để đổi size, nếu trường hợp ở xa gửi về khách hàng phải chịu phí ship.
            </li>
            <li>            Các sản phẩm đều chỉ được đổi 1 lần duy nhất.
            </li>
        </ol>
        <h4>Quy trình cách thức đổi hàng cho khách hàng:</h4>
        <p>
            <b>Bước 1: Xác nhận tình trạng đổi</b> <br>

        Trong vòng 7 ngày kể từ ngày nhận được sản phẩm, nếu sản phẩm thuộc các trường hợp đổi hàng, quý khách phải tiến hành chụp hiện trạng của sản phẩm: Thấy rõ mã hàng, tem, phiếu bảo hành của chúng tôi, chỗ sản phẩm bị lỗi (nếu có). Sau đó liên hệ với bộ phận chăm sóc khách hàng của chúng tôi qua hotline để thông báo thông tin đổi sản phẩm và gửi hình ảnh xác nhận.
            <br>
        <b>Bước 2: Chúng tôi xác nhận</b>
            <br>
        Chúng tôi sau khi nhận được thông tin sẽ tiến hành xác nhận tình trạng hàng hóa và xác nhận cho khách hàng sản phẩm có được đổi hay không.
            <br>
        Sau khi xác nhận sản phẩm được đổi, quý khách vui lòng giữ hàng hóa trong trạng thái nguyên vẹn  cùng với những phụ kiện và giấy tờ liên quan.
            <br>
        <b>Bước 3: Khách hàng gửi hàng</b>
            <br>
        Trường hợp ở xa, quý khách gửi lại sản phẩm còn nguyên cùng với các phụ kiện và giấy tờ liên quan, được đóng gói cẩn thận và gửi theo địa chỉ chúng tôi cung cấp.
            <br>
        Trường hợp khách hàng đến cửa hàng đổi trực tiếp, mang theo đầy đủ sản phẩm, phụ kiện và giấy tờ liên quan đến địa chỉ chúng tôi cung cấp sau 15h30.
            <br>
        <b>Bước 4: Chúng tôi xác nhận và gửi hàng cho khách hàng</b>
            <br>
        Sau khi đã nhận, kiểm tra và chấp nhận sản phẩm mà quý khách muốn đổi, chúng tôi sẽ liên hệ để xác nhận đổi hàng và gửi hàng cho quý khách.
            <br>
        <b>Lưu ý:</b> Nếu sản phẩm gửi về cho chúng tôi không đáp ứng đủ điều kiện đổi đã nêu ở trên hoặc không đủ điều kiện để bán lại, khách hàng phải chịu trách nhiệm chi trả phần thiệt hại cho chúng tôi hoặc được cộng thêm và số tiền mà quý khách phải chi trả cho sản phẩm được đổi.
            <br>
        </p>
        

        <h3>II. Chính sách hoàn trả sản phẩm</h3>
        <h5>Trường hợp trả hàng:</h5>
        <ol>
            <li>            Sản phẩm được phát hiện lỗi khi không được báo trước.
            </li>
            <li>            Sản phẩm không đúng như thông tin trên web, đơn đặt hàng.
            </li>
            <h5>Các trường hợp không chấp nhận trả hàng:</h5>
            <li>Sản phẩm không được xác nhận mua từ Drake.</li>
            <li> Sản phẩm đã được sử dụng hoặc dính bẩn.</li>
            <li>Các trường hợp đổi ý, không thích sản phẩm.</li>
        </ol>
        <h5>Điều kiện trả hàng</h5>
        Các sản phẩm mua tại Drake được áp dụng trả trong vòng 3 ngày (kể từ ngày quý khách nhận được hàng, căn cứ vào ngày gửi theo dấu bưu cục)
        Sản phẩm chưa qua sử dụng (không bị dính bẩn)  và còn đủ hộp (còn nguyên vẹn), phụ kiện đi kèm, đủ phiếu bảo hành, và hóa đơn (nếu có).
        <h5>Quy trình cách thức trả hàng cho khách hàng:</h5>
       <b> Bước 1: Xác nhận tình trạng hoàn trả</b>

        Trong vòng 3 ngày kể từ ngày nhận được sản phẩm, quý khách phải tiến hành chụp hiện trạng của sản phẩm: Thấy rõ mã hàng, tem, phiếu bảo hành của chúng tôi, chỗ sản phẩm bị lỗi. Sau đó liên hệ với bộ phận chăm sóc khách hàng của chúng tôi qua hotline để thông báo thông tin đổi sản phẩm và gửi hình ảnh xác nhận.

        <b>Bước 2: Chúng tôi xác nhận</b>

        Chúng tôi sau khi nhận được thông tin sẽ tiến hành xác nhận tình trạng hàng hóa và xác nhận cho khách hàng sản phẩm có được hoàn trả hay không.

        Sau khi xác nhận sản phẩm được trả, quý khách vui lòng giữ hàng hóa trong trạng thái nguyên vẹn  cùng với những phụ kiện và giấy tờ liên quan (phiếu bảo hành, hóa đơn bưu cục..)

        <b>Bước 3: Khách hàng gửi hàng</b>

        Trường hợp ở xa, quý khách gửi lại sản phẩm còn nguyên cùng với các phụ kiện và giấy tờ liên quan (phiếu bảo hành, hóa đơn bưu cục..), được đóng gói cẩn thận và gửi theo địa chỉ chúng tôi cung cấp.

        Trường hợp khách hàng đến cửa hàng trực tiếp, mang theo đầy đủ sản phẩm, phụ kiện và giấy tờ liên quan (phiếu bảo hành, hóa đơn..) đến địa chỉ chúng tôi cung cấp sau 15h30.

        <b>Bước 4: Chúng tôi xác nhận hoàn tiền cho quý khách</b>

        Sau khi đã nhận, kiểm tra và chấp nhận sản phẩm mà quý khách muốn trả, chúng tôi sẽ liên hệ để xác nhận và thực hiện quá trình hoàn tiền cho quý khách qua tài khoản ngân hàng trong vòng 7-10 ngày.

        <b>Lưu ý:</b> Nếu sản phẩm gửi về cho chúng tôi không đáp ứng đủ điều kiện trả đã nêu ở trên, khách hàng phải chịu trách nhiệm chi trả phần thiệt hại cho chúng tôi hoặc được trừ thẻm vào số tiền mà quý khách đã chi trả cho sản phẩm.

        

        <h3>II. Chính sách hủy đơn hàng</h3>

        <h5>Trường hợp hủy đơn hàng</h5>
        <ol>
            <li>            Đơn hàng sẽ được thông báo hủy nếu như sản phẩm không có sẵn vì bất kỳ lý do nào.</li>
            <li>            Đơn hàng sẽ được thông báo hủy khi quý khách có yêu cầu thay đổi thông tin về sản phẩm của đơn hàng (trừ trường hợp đơn hàng đã được xử lý và giao cho đơn vị chuyển phát).
            </li>
            <li>            Đơn hàng sẽ được phép hủy khi quý khách có yêu cầu hủy đơn hàng trước khi đơn hàng được xử lý giao cho đơn vị vận chuyển.    
            </li>
        </ol>
        <h5>Cam kết khi hủy đơn hàng</h5>
        <ol>
            <li>            Trong trường hợp đơn hàng được hủy bởi chúng tôi, chúng tôi sẽ có trách nhiệm thông báo đến quý khách trong thời gian sớm nhất. Quý khách sẽ không phải trả bất kỳ chi phí hủy đơn hàng nào trong trường hợp này.            </li>
            <li>            Trong trường hợp đơn hàng được hủy bởi quý khách, quý khách phải có trách nhiệm thông báo đến chúng tôi trong thời gian sớm nhất. Nếu không, mọi khiếu nại sẽ không được giải quyết khi đơn hàng đã được xử lý.
            </li>
            <li>            Nếu quý khách hủy đơn hàng trước khi hàng được vận chuyển, thông thường là trong vòng 1 giờ kể từ lúc nhân viên liên hệ xác nhận đặt hàng, Chúng tôi sẽ hoàn trả 100% tiền cho những quý khách đã thanh toán.
            </li>
            <li>            Nếu quý khách hủy đơn hàng sau khi hàng đã được vận chuyển, chúng tôi sẽ giải quyết hoàn tiền cho quý khách sau khi đã trừ các chi phí phát sinh của đơn hàng như: phí vận chuyển...(hoặc chúng tôi sẽ KHÔNG chấp nhận hủy đơn hàng).
            </li>
            <li>            Để biết tình trạng hiện tại của đơn hàng, quý khách vui lòng xem trong mục Quản lý đơn hàng trên website hoặc liên hệ bộ phận chăm sóc khách hàng.
            </li>
            <li>            Quá thời gian qui định trên, mọi yêu cầu hủy đơn hàng của Quý khách sẽ không được chấp nhận.
            </li>
            <li>            Quý khách lưu ý phí dịch vụ cho xử lý giao dịch thẻ với ngân hàng sẽ không hoàn trả một khi đã thanh toán
            </li>
        </ol>
        <b>Lưu ý:</b> Mã giảm giá và ưu đãi sẽ không còn hiệu lực cho đơn hàng tiếp theo. Qúy khách vui lòng cân nhắc kỹ trước khi thực hiện hủy đơn hàng. 

        

        <h3>II. Chính sách bảo hành :</h3>

        <ol>
            <li>            Sản phẩm phải được xác thực là sản phẩm của Drake (kèm phiếu bảo hành).
            </li>
            <li>            Sản phẩm được đem đến đủ hộp, phiếu bảo hành, và sản phẩm phải được vệ sinh lại.
            </li>
            <li>            Sản phẩm được bảo hành chính hãng 30 ngày kể từ ngày nhận hàng.
            </li>
            <li>            Sản phẩm được Drake hỗ trợ bảo hành 3 tháng.
            </li>
        </ol>
        

        <b>-Lưu ý:</b>

        <ol>
            <li>            Thời gian xử lý vấn đề bảo hành sau 15H30 mỗi ngày tại tất cả cửa hàng.
            </li>
            <li>            Nếu quý khách tự ý thay đổi, sửa chữa sản phẩm hoặc không tuân theo phương pháp bảo quản dẫn đến sản phẩm bị hư hại. Công ty chúng tôi sẽ hoàn toàn không chịu trách nhiệm về việc bảo hành lỗi sản phẩm trên.
            </li>
            <li>            Với các sản phẩm Sale dưới 20% đều được bảo hành chính hãng của công ty phân phối độc quyền tại Việt Nam. Còn lại những sản phẩm Sale trên 20% vẫn nhận được bảo hành của kingdom Sneakers trong vòng 1 tháng với những lỗi do nhà sản xuất như bung keo, sứt chỉ.
            </li>
            <li>            Nhằm mục đích mang đến sự hài lòng cho khách hàng , toàn bộ các sản phẩm bán ra đều hỗ trợ bảo hành sau khi hết bảo hành nếu hệ thống xử lý được.
            </li>
        </ol>
        

        Mọi vấn đề thắc mắc về đổi – trả – bảo hành và hủy đơn hàng, quý khách vui lòng liên hệ bộ phận chăm sóc khách hàng:


        Văn phòng đại diện: 879 Nguyễn Kiệm, phường 3, quận Gò Vấp, TP.HCM.

Hotline : 1800.0080 – 0978261116
    </main>
@endsection