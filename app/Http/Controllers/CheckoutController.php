<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\District;
use App\Models\OrderModel;
use App\Models\Province;
use App\Models\TransportFee;
use App\Models\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $province = Province::orderby('_name', 'ASC')->get();
        return view('Auth.checkout.checkout')->with(compact('province'));
    }

    public function check_coupon(Request $request){
        // 
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->where('coupon_expired', '>' , date("Y/m/d"))->where('coupon_time', '>', 0)->first();
        if($coupon){
            return ['data' => $coupon, 'message' => 'Áp dụng mã giảm giá thành công', 'coupon_id' => $coupon->id];
        }else {
            return ['message' => 'Mã giảm giá không hợp hợp lệ!'];
        }
    }

    public function select_location(Request $request)
    {
        $result = '';
        if ($request->action == "province") {
            $districtList = District::where('_province_id', $request->id)->orderby('_prefix', 'ASC')->orderby('_name', 'ASC')->get();
            $result = '<option>-- Chọn quận/huyện --</option>';
            foreach ($districtList as $key => $district) {
                $result .= '<option value="' . $district->id . '">' . $district->_prefix . " " . $district->_name . '</option>';
            }
            return $result;
        } else {
            $wardList = Ward::where('_district_id', $request->id)->orderby('_prefix', 'ASC')->orderby('_name', 'ASC')->get();
            $result = '<option>-- Chọn xã/phường/thị trấn --</option>';
            foreach ($wardList as $key => $ward) {
                $result .= '<option value="' . $ward->id . '">' . $ward->_prefix . " " . $ward->_name . '</option>';
            }
            return $result;
        }
    }
    public function delivery(Request $request)
    {
        try {
            $fee = TransportFee::where('m_province_id', $request->pro)->where('m_district_id', $request->dis)->where('m_ward_id', $request->war)->first();
            return ['m_fee_ship'=> number_format($fee->m_fee_ship), 'total'=>number_format(Cart::total(0, '.', '') + $fee->m_fee_ship)];
        } catch (\Throwable $th) {
            return ['m_fee_ship'=> number_format(50000), 'total'=>number_format(Cart::total(0, '.', '') + 50000)];
        }
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $request->total_momo;
        $orderId = time() . "";
        $redirectUrl = route('checkout-success');
        $ipnUrl = route('checkout-success');
        $extraData = $request->txnRef;

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
    }

    public function vnpay_payment(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout-success');
        $vnp_TmnCode = "CIYCSN2V"; //Mã website tại VNPAY 
        $vnp_HashSecret = "CJRTNUCTOILPABSOZDOITQERKIMEGDYI"; //Chuỗi bí mật

        $vnp_TxnRef = 20000 + $request->txnRef; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán đơn hàng';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = ($request->total_vnpay + 0) * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            // "vnp_ExpireDate" => $vnp_ExpireDate,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function checkout_success(Request $request)
    {
        $data = [];
        $pay = "Thanh toán bằng tiền mặt khi nhận hàng";
        if (isset($request->vnp_SecureHash)) {
            
            $result = "";
            $vnp_HashSecret = "CJRTNUCTOILPABSOZDOITQERKIMEGDYI";
            $vnp_SecureHash = $_GET['vnp_SecureHash'];
            $inputData = array();
            foreach ($_GET as $key => $value) {
                if (substr($key, 0, 4) == "vnp_") {
                    $inputData[$key] = $value;
                }
            }

            unset($inputData['vnp_SecureHash']);
            ksort($inputData);
            $i = 0;
            $hashData = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }

            $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            if ($secureHash == $vnp_SecureHash) {
                if ($_GET['vnp_ResponseCode'] == '00') {
                    $result = "Thanh toán đơn hàng thành công!";
                    $pay = "Thanh toán qua VNPay";
                    $orderId = $inputData['vnp_TxnRef'] - 20000;
                    $order = OrderModel::find($orderId);
                    $order->m_status_pay = 1;
                    $order->save();
                } else {
                    $result = "Thanh toán đơn hàng không thành công!";
                }
            } else {
                $result = "Chữ ký VNPay không hợp lệ!";
            }
            $data = ["message" => $result];
        }
        if (isset($request->partnerCode)) {
           
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $partnerCode = $_GET["partnerCode"];
            $orderId = $_GET["orderId"];
            $message = $_GET["message"];
            $transId = $_GET["transId"];
            $orderInfo = utf8_encode($_GET["orderInfo"]);
            $amount = $_GET["amount"];
            $resultCode = $_GET["resultCode"];
            $responseTime = $_GET["responseTime"];
            $requestId = $_GET["requestId"];
            $extraData = $_GET["extraData"];
            $payType = $_GET["payType"];
            $orderType = $_GET["orderType"];
            $m2signature = $_GET["signature"]; //MoMo signature

            //Checksum
            $rawHash = "partnerCode=" . $partnerCode . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&responseTime=" . $responseTime . "&resultCode=" . $resultCode .
                "&payType=" . $payType . "&extraData=" . $extraData;

            $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
            // if ($m2signature == $partnerSignature) {
            if ($resultCode == '0') {
                $result = 'Thanh toán đơn hàng thành công!';
                $pay = "Thanh toán qua MoMo";
                $order = OrderModel::find($extraData);
                $order->m_status_pay = 1;
                $order->save();
            } else {
                $result = 'Thanh toán đơn hàng không thành công!';
            }
            // } else {
            //     $result = 'Chữ ký MoMo không hợp lệ!';
            // }
            $data = ["message" => $result];
        }

        // send mail
        $lastOrder = OrderModel::orderby('created_at', "DESC")->limit(1)->get();
        $to_name = "Kingdom Sneakers Shop";
        $to_mail = $lastOrder[0]->m_email;
        $data = array("order" => $lastOrder[0], 'pay' => $pay);
        Mail::send('Auth.checkout.order-mail', $data, function($message) use ($to_name, $to_mail, $lastOrder){
            $message->to($to_mail)->subject('Xác nhận đơn hàng #' . $lastOrder[0]->id);
            $message->from('kingdomsneakers80@gmail.com', $to_name);
        });
        Cart::destroy();
        return view('Auth.checkout.success', $data);
    }
}
