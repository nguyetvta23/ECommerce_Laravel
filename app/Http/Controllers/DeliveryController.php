<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryRequest;
use App\Models\District;
use App\Models\Province;
use App\Models\TransportFee;
use App\Models\Ward;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $data = [
            'title' => 'Quản lý vận chuyển',
            'action' => '',
        ];
        $province = Province::orderby('_name', 'ASC')->get();
        return view('Admin.delivery.index')->with(compact('data', 'province'));
    }

    public function list_delivery()
    {
        $result = '';
        $feeList = TransportFee::with('province', 'district', 'ward')->orderby('id', 'DESC')->get();
        foreach ($feeList as $key => $fee) {
            $result .= '<tr>
            <td>' . $fee->id . '</td>
            <td>' . $fee->province->_name . '</td>
            <td>' . $fee->district->_prefix . " " . $fee->district->_name . '</td>
            <td>' . $fee->ward->_prefix . " " . $fee->ward->_name . '</td>
            <td><input class="form-control fee-ship" data-toggle="input-mask" data-mask-format="000,000,000,000,000" data-reverse="true" name="m_fee_ship" data-id="' . $fee->id . '" value="' . number_format($fee->m_fee_ship) . '"/></td>
            </tr>';
        }
        return $result;
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

    public function insert_delivery(DeliveryRequest $request)
    {
        $fee = new TransportFee();
        $fee->m_province_id = $request->province;
        $fee->m_district_id = $request->district;
        $fee->m_ward_id = $request->ward;
        $fee->m_fee_ship = str_replace(',', '', $request->m_fee_ship);
        $fee->save();
        return $fee;
    }

    public function edit_delivery(Request $request)
    {
        $fee = TransportFee::find($request->id);
        $fee->m_fee_ship = str_replace(',', '', $request->fee_ship);
        $fee->save();
        $result = $this->list_delivery();
        return $result;
    }
}
