<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Coupon;
use App\Models\District;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\product;
use App\Models\product_inventory;
use App\Models\Province;
use App\Models\TransportFee;
use App\Models\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $content = Cart::content();
        foreach ($content as $item) {
            $product = product::find($item->id);
            if ($product == null || $product->m_status != 1) {
                return ["IsError" => true, "message" => "Sản phẩm không tồn tại, vui lòng chọn sản phẩm khác"];
            }
        }

        $data = $request->all();
        $province = Province::find($data['province_nice-select']);
        $district = District::find($data['district_nice-select']);
        $ward = Ward::find($data['ward_nice-select']);
        $order = new OrderModel();
        $fee_ship = 0;
        if (TransportFee::where('m_province_id',  $province)->where('m_district_id', $district)->where('m_ward_id', $ward)->first()) {
            $fee = TransportFee::where('m_province_id',  $province)->where('m_district_id', $district)->where('m_ward_id', $ward)->first();
            $fee_ship = $fee->m_fee_ship;
        } else {
            $fee_ship = 50000;
        }
        if (Auth::check()) {
            $order->m_id_user = Auth::user()->id;
        }
        $order->m_name = $request->m_name;
        $order->m_email = $request->m_email;
        $order->m_address = $data['m_address'] . "," . $ward->_prefix . " " . $ward->_name . "," . $district->_prefix . " " . $district->_name . "," . $province->_name;
        $order->m_phone = $request->m_phone;
        $order->m_note = $request->m_note;
        $order->m_total_price = $request->m_total_price;
        $order->m_fee_ship = $fee_ship;
        $order->m_status_ship = 0;
        $order->m_status_pay = 0;
        $order->m_coupon = $request->m_coupon;
        $order->save();
        $id = $order->id;

        foreach ($content as $item) {
            $product = product::find($item->id);
            $product->m_buy += 1;
            $product->save();
            $size = product_inventory::find($item->options->sizeId);
            $size->m_quanti -= $item->qty;
            $size->save();
            $orderDetail = new OrderDetailModel();
            $orderDetail->m_id_order = $id;
            $orderDetail->m_id_product = $item->id;
            $orderDetail->m_price = $item->price;
            $orderDetail->m_size = $size->m_size;
            $orderDetail->m_quanti = $item->qty;
            $orderDetail->m_product_name = $item->name;
            $orderDetail->save();
        }
        if ((int)$request->m_coupon > 0) {
            $coupon = Coupon::find($request->coupon_id);
            $coupon->coupon_time -= 1;
            $coupon->save();
        }
        return ["IsError" => false, "message" => "Đặt hàng thành công !", "data" => $order];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
