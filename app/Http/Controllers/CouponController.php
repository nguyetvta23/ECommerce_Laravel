<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Danh sách mã giảm giá',
            'action' => '',
        ];
        return view('Admin.coupon.index')->with(compact('data'));
    }

    public function load_coupon()
    {
        $data = Coupon::orderby('id', 'DESC')->get();
        return ["data" => $data];
    }

    public function delete_coupon($id)
    {
        Coupon::destroy($id);
        return ["messenger" => "Xóa thành công!"];
    }

    public function insert_coupon()
    {
        $data = [
            'title' => 'Thêm mã giảm giá',
            'action' => '',
        ];
        return view('Admin.coupon.insert')->with(compact('data'));
    }

    public function save_coupon(CouponRequest $request)
    {
        $coupon = new Coupon();
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_value = $request->coupon_value;
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_time = $request->coupon_time;
        $coupon->coupon_method = $request->coupon_method;
        $coupon->coupon_expired = $request->coupon_expired;
        $result = $coupon->save();
        return ["result" => $result];
    }
}
