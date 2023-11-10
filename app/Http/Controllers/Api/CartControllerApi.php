<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\product_inventory;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CartControllerApi extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            "data" => Cart::content(),
            "subtotal" => Cart::subtotal(0), 'total' => Cart::total(0),
            'tax' => Cart::tax(0), 'count' => count(Cart::content()), 'totalNoTax' => Cart::priceTotal()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->productId;
        $product = product::find($id);
        $size = product_inventory::find($request->sizeId);
        if ($product == null || $product->m_status != 1) {
            return ["isError" => true, "message" => "Sản phẩm không tồn tại, vui lòng chọn sản phẩm khác"];
        }
        if ((int)$request->quantity > (int)$size->m_quanti) {
            return ["isError" => true, "message" => "Sản phẩm không còn đủ số lượng cần mua"];
        }
        $quantity = $request->quantity;
        $data['id'] = $id;
        $data['qty'] = $quantity;
        $data['price'] = $product->m_original_price;
        $data['name'] = $product->m_product_name;
        $data['options']['image'] = $product->m_picture ? json_decode($product->m_picture)[0] : '';
        $data['options']['slug'] = $product->m_product_slug;
        $data['options']['sizeId'] = $request->sizeId;
        $data['options']['sizeName'] = $size->m_size;
        $data['weight'] = 0;
        $result = Cart::add($data);
        return ["isError" => false, "message" => "Thêm giỏ hàng thành công", "data" => $result];
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
        $size = product_inventory::find(Cart::get($id)->options->sizeId);
        if ((int)$request->qty > (int)$size->m_quanti) {
            return ["isError" => true, "message" => "Sản phẩm không còn đủ số lượng cần mua"];
        }
        $id = $request->id;
        $qty = $request->qty;
        $result = Cart::update($id, $qty);
        return ["isError" => false, "message" => "Cập nhật giỏ hàng thành công", "data" => $result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return ["isError" => false, "message" => "Xóa giỏ hàng thành công"];
    }
}
