<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\AccountModel;
use App\Models\OrderDeTailModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Tests\Shoppingcart\Fixtures\ProductModel;
use App\Models\product;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;


class ProfileController extends Controller
{
    // Profile
    public function profile()
    {
        $order = OrderModel::where('m_id_user', Auth::user()->id)->get();
        return view('Auth.account.profile', compact('order'));
    }
    // Chi tiết đơn hàng
    public function order($id)
    {
        $order = OrderModel::where('id', $id)->get();
        $orderDetail = OrderDeTailModel::with('showimgproduct')->where('m_id_order', $id)->get();
        return view('Auth.account.order', compact('orderDetail', 'order'));
    }
    // Hủy đơn hàng nếu chưa được xác nhận
    public function cancelled($id)
    {
        $order = OrderModel::find($id);
        $order->m_status = "3";
        $order->update();
        return redirect()->back()->with('alert_success', 'Hủy đơn hàng thành công');
    }
    public function productDetail($id)
    {
    }
    // Cập nhật thông tin profile
    // public function updateProfile(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|max:55',
    //         'email' => 'required',
    //         'phone' => ['required','regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
    //         'm_address'=> 'required',
    //     ],[
    //         'name.required' => 'Họ và tên không được bỏ trống!',
    //         'name.max'=> 'Họ và tên quá dài!',
    //         'email' => 'Email không được bỏ trống!',
    //         'phone.regex' => 'Số điện thoại không đúng định dạng',
    //         'phone.required' => 'Số điện thoại không được bỏ trống!',
    //         'address.required' => 'Địa chỉ không được bỏ trống!'
    //     ]);
    //     $updated = accountModel::find(\Auth::user()->id);
    //     $updated->name = $request->name;
    //     $updated->email = $request->email;
    //     $updated->phone = $request->phone;
    //     $updated->m_address = $request->m_address;
    //     if($updated->save()){
    //         return redirect()->route('updateProfile')->with('alert_success', 'Cập nhật thông tin thành công.');}
    // }

    public function doithongtinuser(UpdateProfileRequest $request)
    {
        $updated = accountModel::find(\Auth::user()->id);
        $updated->name = $request->name;
        $updated->email = $request->email;
        $updated->phone = $request->phone;
        $updated->m_address = $request->m_address;
        if ($updated->save()) {
            return redirect()->back()->with('alert_success', 'Cập nhật thông tin thành công.');
        }
    }
    public function doimatkhauuser(ChangePasswordRequest $request)
    {
        $id = $request->id;
        $data = $request->all();
        $passold = $data['matkhaucu'];
        // dd($data['matkhaucu']);
        // dd($data['xacnhanmatkhau']);
        if (Hash::check($passold, \Auth::user()->password)) {
            if ($data['matkhaumoi'] == $data['xacnhanmatkhau']) {
                $updated = accountModel::find(\Auth::user()->id);
                $updated->password = Hash::make($data['matkhaumoi']);
                if ($updated->save()) {
                    echo 'Đổi mật khẩu thành công!';
                }
            }
        }
    }
}
