<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\product;
use App\Models\product_inventory;
use App\Models\User;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Cookie;
// use Session;
// use Illuminate\Http\Response;


class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Danh Mục',
            'action' => 'Sản phẩm'
        ];
        $showdanhmuc = CategoryModel::orderBy('id', 'asc')->get();
        $datas = product::orderBy('id', 'asc')->search()->paginate(10);
        if (isset($_GET['danhsach'])) {
            $sort_by = $_GET['danhsach'];
            foreach ($showdanhmuc as $key => $value) {
                $dataid = $value->id;
                if ($sort_by == $dataid) {
                    $datas = product::orderBy('id', 'asc')->where('m_id_category', $dataid)->search()->paginate(10);
                    $datas->render();
                }
            }
            if ($sort_by == 'tatca') {
                $datas = product::orderBy('id', 'asc')->search()->paginate(10);
                $datas->render();
            }
        }
        return view('admin.product.index', compact('datas', 'data', 'showdanhmuc'));
    }
    // giảm giá theo sản phẩm và giảm giá theo danh mục sản phẩm
    public function capnhatprice(Request $request)
    {
        $data = $request->all();
        if ($data['idsotiengiam'] == 2 && isset($data['allids'])) {
            product::whereIn('id', $data['allids'])->update(['m_original_price' => $data['inputprice']]);
        } elseif ($data['idsotiengiam'] == 1 && isset($data['allids'])) {
            $input = $data['inputprice'];
            $ids = $data['allids'];
            foreach (product::whereIn('id', $data['allids'])->get() as $val) {
                $updated = product::find($val->id);
                $updated->m_original_price = $val->m_original_price - ($val->m_original_price * $data['inputprice']) / 100;
                $updated->save();
            }
        } elseif ($data['iddanhmuc'] != 0 && !isset($data['allids']) && $data['idsotiengiam'] == 2) {
            product::where('m_id_category', $data['iddanhmuc'])->update(['m_original_price' => $data['inputprice']]);
        } elseif ($data['iddanhmuc'] != 0 && !isset($data['allids']) && $data['idsotiengiam'] == 1) {
            foreach (product::where('m_id_category', $data['iddanhmuc'])->get() as $val) {
                $updated = product::find($val->id);
                $updated->m_original_price = $val->m_original_price - ($val->m_original_price * $data['inputprice']) / 100;
                $updated->save();
            }
        }
    }
    // xóa tất cả
    public function deleteallsp(Request $request)
    {
        $data = $request->all();
        if (isset($data['ids'])) {
            foreach (product::whereIn('id', $data['ids'])->get() as $key => $val) {
                $deleteimg = json_decode($val->m_picture);
                $length = count($deleteimg);
                for ($i = 0; $i < $length; $i++) {
                    $path = public_path("uploads/" . $deleteimg[$i]);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            DB::table('t_order_detail')->whereIn('m_id_product', $data['ids'])->delete();
            DB::table('t_commentproduct')->whereIn('m_id_maloai', $data['ids'])->delete();
            product_inventory::whereIn('m_id_product', $data['ids'])->delete();
            product::whereIn('id', $data['ids'])->delete();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Sản phẩm',
            'action' => 'Thêm sản phẩm'
        ];
        $showcategory = CategoryModel::orderBy('id', 'asc')->get();
        return view('admin.product.create', compact('data', 'showcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'm_product_name' => 'required|unique:t_product',
                'm_short_description' => 'required|max:255',
                'm_description' => 'required',
                'file_upload' => 'required|max:2048',
                'm_price' => 'required',
                'm_original_price' => 'required',
            ],
            [
                'm_product_name.required' => 'Tên sản phẩm không để trống',
                'm_short_description.required' => 'mô tả ngắn không để trống',
                'm_short_description.max' => 'mô tả ngắn tối đa 255 ký tự',
                'm_description.required' => 'mô tả không để trống',
                'file_upload.required' => 'hình ảnh không để trống',
                'file_upload.max' => 'hình ảnh tối đa là 2000kb',
                'm_price.required' => 'giá gốc không được để trống',
                'm_original_price.required' => 'giá khuyến mãi không được để trống',
                'm_product_name.unique' => 'Tên sản phẩm này đã có trong CSDL',
            ]
        );
        $data = $request->all();
        $create = new product();
        $create->m_product_name = $request->m_product_name;
        $create->m_id_category = $request->m_id_category;
        $create->m_product_slug = Str::slug($request->m_product_name) . '.html';
        $create->m_short_description = $request->m_short_description;
        $create->m_description = $request->m_description;
        $create->m_price = $request->m_price;
        $create->m_original_price = $request->m_original_price;
        $create->m_buy = 1;
        $create->m_status = $request->m_status;
        $file_upload = array();
        if ($files = $request->file('file_upload')) {
            // $file = $request->file_upload;
            // $ext[] = $request->file_upload->extension();
            // $file_name = random(8).'-'.'sanpham.'.$ext;
            // $file->move(public_path('uploads'), $file_name);
            foreach ($files as $file) {
                $name = $file->getClientOriginalName();
                $uploadname = time() . '-' . 'sanpham.' . $name;
                $file->move('uploads', $uploadname);
                $file_name[] = $uploadname;
            }
            $layhinh = implode(", ", $file_name);
            $chuyenhinh = explode(", ", $layhinh);
            $luuhinh = json_encode($chuyenhinh, JSON_UNESCAPED_SLASHES);
        }
        $create->m_picture = $luuhinh;
        if ($create->save()) {
            if ($request->soluong) {
                if ($data['soluong'] != null && $data['size']) {
                    $syncdata = [];
                    $soluong = $data['soluong'];
                    $size = $data['size'];
                    for ($i = 0; $i < count($data['soluong']); $i++) {
                        $syncdata[$size[$i]] = ['m_quanti' => $soluong[$i], 'm_size' => $size[$i]];
                    }
                    $create->themsoluong()->attach($syncdata);
                    return redirect()->route('product.index')->with('alert_success', 'Thêm mới sản phẩm thành công.');
                }
            } else {
                return redirect()->route('product.index')->with('alert_success', 'Thêm mới sản phẩm thành công. nhưng chưa có số lượng tồn kho sản phẩm');
            }
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Sản phẩm',
            'action' => 'sửa sản phẩm'
        ];
        $updated = product::find($id);
        $updatene = product::where('id', $updated->id)->first();
        $soluongvasize = product_inventory::where('m_id_product', $updatene->id)->first();
        $showsoluongvasize = product_inventory::where('m_id_product', $updatene->id)->get();
        $showcategory = CategoryModel::orderBy('id', 'asc')->get();
        return view('admin.product.edit', compact('data', 'updated', 'showcategory', 'soluongvasize', 'showsoluongvasize'));
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
        $validated = $request->validate(
            [
                'm_product_name' => 'required',
                'm_short_description' => 'required|max:255',
                'm_description' => 'required',
                'file_upload' => 'max:2048',
                'm_price' => 'required',
                'm_original_price' => 'required',
            ],
            [
                'm_product_name.required' => 'Tên sản phẩm không để trống',
                'm_short_description.required' => 'Mô tả ngắn không để trống',
                'm_short_description.max' => 'Mô tả ngắn tối đa 255 ký tự',
                'm_description.required' => 'Mô tả không để trống',
                'file_upload.max' => 'Mình ảnh tối đa là 2000kb',
                'm_price.required' => 'Giá gốc không được để trống',
                'm_original_price.required' => 'Giá khuyến mãi không được để trống',
            ]
        );
        $data = $request->all();
        $updated = product::find($id);
        $updated->m_product_name = $request->m_product_name;
        $updated->m_id_category = $request->m_id_category;
        $updated->m_product_slug = Str::slug($request->m_product_name) . '.html';
        $updated->m_short_description = $request->m_short_description;
        $updated->m_description = $request->m_description;
        $updated->m_price = $request->m_price;
        $updated->m_original_price = $request->m_original_price;
        $updated->m_buy = 1;
        $updated->m_status = $request->m_status;
        $file_upload = array();
        if ($files = $request->file('file_upload')) {
            if ($request->file('file_upload') == null) {
            } elseif ($request->file('file_upload')) {
                $deleteimg = json_decode($updated->m_picture);
                $length = count($deleteimg);
                for ($i = 0; $i < $length; $i++) {
                    $path = public_path("uploads/" . $deleteimg[$i]);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $uploadname = time() . '-' . 'sanpham.' . $name;
                    $file->move('uploads', $uploadname);
                    $file_name[] = $uploadname;
                }
                $layhinh = implode(", ", $file_name);
                $chuyenhinh = explode(", ", $layhinh);
                $luuhinh = json_encode($chuyenhinh, JSON_UNESCAPED_SLASHES);
                $updated->m_picture = $luuhinh;
            }
        }
        if ($updated->save()) {
            if ($request->soluong && $request->size) {
                if ($data['soluong'] != null && $data['size'] != null) {
                    $syncdatane = [];
                    $soluong = $data['soluong'];
                    $size = $data['size'];
                    for ($i = 0; $i < count($data['soluong']); $i++) {
                        $syncdatane[$size[$i]] = ['m_quanti' => $soluong[$i], 'm_size' => $size[$i]];
                    }
                    $updated->themsoluong()->sync($syncdatane);
                }
                return redirect()->route('product.index')->with('alert_success', 'Sửa sản phẩm thành công.');
            } else {
                return redirect()->route('product.index')->with('alert_success', 'Sửa sản phẩm thành công. nhưng sản phẩm tồn kho và size vẫn đang được giữ nguyên.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = product::find($id);
        $deleteimg = json_decode($delete->m_picture);
        $length = count($deleteimg);
        for ($i = 0; $i < $length; $i++) {
            $path = public_path("uploads/" . $deleteimg[$i]);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        DB::table('t_order_detail')->whereIn('m_id_product', [$delete->id])->delete();
        DB::table('t_commentproduct')->whereIn('m_id_maloai', [$delete->id])->delete();
        product_inventory::whereIn('m_id_product', [$delete->id])->delete();
        $delete->delete();
        return redirect()->back()->with('alert_success', 'Xóa sản phẩm thành công.');
    }


    //chọn sản phẩm yêu thích
    // public function productFavourite(Request $request)
    // {
    //     $idProduct = $request->idProduct;
    //     $product = DB::table('t_product')->where('id', $idProduct)->first();
    //     return response()->json([
    //         'data' => $product,
    //     ]);
    // }

    // public function listProductFavourite(Request $request)
    // {

    //     return view('Auth.product_list.favourite');
    // }

    // public function checkProductFavourite(Request $request) {
    //     $list_favourite = $request->storedNames;
    //     return redirect()->route('fav')->with( ['list_favourite' => $list_favourite] );
    // }
    public function productFavourite(Request $request)
    {
        if(Auth::user()) {
            $userLogin = Auth::user()->id;
        $idProduct = $request->idProduct;
        $checkData = DB::table('t_user_favourite')->where('id_user', $userLogin)->where('id_product', $idProduct)->first();
        if ($checkData) {
            return response()->json([
                'status' => 401,
                'message' => 'Sản phẩm này đã được chọn'
            ]);
        }
        $addFavourite = DB::table('t_user_favourite')->insert([
            'id_user' =>  $userLogin,
            'id_product' => $idProduct
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Bạn đã chọn sản phẩm yêu thích thành công',
            'data' =>  $addFavourite,
        ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Vui lòng đăng nhập để thực hiện chức năng này'
            ]);
        }

    }

    public function listProductFavourite()
    {
       if(Auth::user()) {
        $userLogin = Auth::user()->id;
        $list_favourite = DB::table('t_product')->join('t_user_favourite', 't_user_favourite.id_product', '=', 't_product.id')->where('t_user_favourite.id_user', $userLogin)->get();
        return view('Auth.product_list.favourite', compact('list_favourite'));
       } else {
            $list_favourite = [];
            return view('Auth.product_list.favourite', compact('list_favourite'));
       }
    }
    //Lấy danh sách sản phẩm theo danh mục
    public function categoryProduct($id)
    {
        $categories = CategoryModel::orderBy('id', 'desc')->get();
        $category = DB::table('t_category')->where('m_id_parent', $id)->first();
        if ($category) {
            $showproduct = DB::table('t_product')->where('m_id_category', $id)->orWhere('m_id_category', $category->id)->get();
        } else {
            $showproduct = DB::table('t_product')->where('m_id_category', $id)->get();
        }
        return view('Auth.category.index', compact('showproduct', 'categories'));
    }
}
