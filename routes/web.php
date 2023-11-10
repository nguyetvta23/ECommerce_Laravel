<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryModel;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Models\product;
use App\Http\Controllers\productController;
use App\Http\Resources\UserResource;
use App\Models\User;

//  start Comment sent
use App\Http\Controllers\Comment_Product;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Utilities\Request;

// end comment
// start comment blog
// emd comment blog
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// error
Route::group(['prefix' => 'error'], function () {
    Route::get('/404-error', [\App\Http\Controllers\ErrorController::class, 'error404'])->name('error404');
});
// AuthClients
Route::group(['prefix' => 'account'], function () {
    Auth::routes();
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
// AuthAdmin
Route::group(['prefix' => 'admintrator'], function () {
    Auth::routes();
    Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('login-admin-form');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout-admin');
});
// Admin
Route::group(['prefix' => 'admintrator', 'middleware' => ['checkAdmin', 'auth']], function () {

    //dashboard
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('admintrator');
    Route::resource('dashboard', DashboardController::class);

    // Post
    Route::get('post', [PostController::class, 'index'])->name('post-list');
    Route::get('post/add', [PostController::class, 'add_form'])->name('add-form');
    Route::get('post/edit/{id}', [PostController::class, 'edit_form'])->name('edit-form');
    Route::post('/update-trangthai', [Comment_Product::class, 'update_trangthai']);
    // Route::post("/update-trangthai", "Comment_Product@update_trangthai")->name('updatedh');
    // Profile
    Route::resource('profile', App\Http\Controllers\UserController::class);
    Route::post('doi-matkhau-admin', [App\Http\Controllers\UserController::class, 'doimatkhauadmin'])->name('doimatkhauadmin');
    Route::post('doi-thongtin-admin', [App\Http\Controllers\UserController::class, 'doithongtinadmin'])->name('doithongtinadmin');
    // Quản lý user
    Route::get('user', [App\Http\Controllers\UserController::class, 'list'])->name('list-user');
    Route::get('/user/add', [UserController::class, 'add_user'])->name('add_user');
    Route::get('user/edit/{id}', [UserController::class, 'update_form'])->name('update_user');
    // Product
    Route::resources([
        'product' => App\Http\Controllers\productController::class,
        'slider' => App\Http\Controllers\sliderController::class,
    ]);
    // lọc sản phẩm
    Route::post('filterdate', [App\Http\Controllers\DashboardController::class, 'filterdate'])->name('filterdate');
    Route::post('orderdate', [App\Http\Controllers\DashboardController::class, 'orderdate'])->name('orderdate');
    // start Comment
    Route::get('/list_cmt', [Comment_Product::class, 'index'])->name('list_comment');
    Route::get('/delete_cmt/{id}', [Comment_Product::class, 'delete_comment'])->name('delete_cmtpro');
    Route::post('/answer_data/{id}', [Comment_Product::class, 'answer_data']);

    // ajax category
    Route::get('category', [CategoryController::class, 'index'])->name('category-admin');
    Route::post('category/{id}/delete', [CategoryController::class, 'delete']);

    // category
    Route::get('category/add', [CategoryController::class, 'getAddCategory'])->name('category-add-admin');
    Route::post('category/add', [CategoryController::class, 'postAddCategory'])->name('category-post-admin');
    Route::get('category/{id}/edit', [CategoryController::class, 'getEditCategory'])->name('category-edit-admin');
    Route::post('category/{id}/edit', [CategoryController::class, 'postEditCategory']);
    Route::get('category_loadlist', [CategoryController::class, 'loadlist']);

    // contact
    Route::get('contact', [ContactController::class, 'getContact'])->name('contact-admin');
    Route::get('contact/{id}/edit', [ContactController::class, 'getEditContact'])->name('contact-edit-admin');
    Route::post('contact/{id}/edit', [ContactController::class, 'postEditContact']);
    Route::delete('contact/{id}/delete', [ContactController::class, 'getDeleteContact'])->name('contact-delete-admin');

    // order
    Route::get('order', [AdminOrderController::class, 'index'])->name('order');
    Route::post('order/store', [AdminOrderController::class, 'store'])->name('order.store');
    Route::post('order/action', [AdminOrderController::class, 'action'])->name('order.action');
    Route::get('order/detail/{id}', [AdminOrderController::class, 'detail'])->name('order.detail');

    // file images
    Route::get('/file', [App\Http\Controllers\DashboardController::class, 'file'])->name('file');

    // delivery
    Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('delivery');
    Route::post('/delivery/select-location', [DeliveryController::class, 'select_location'])->name('select-location');
    Route::post('/delivery/insert', [DeliveryController::class, 'insert_delivery'])->name('insert-fee');
    Route::post('/delivery/list', [DeliveryController::class, 'list_delivery'])->name('list-delivery');
    Route::post('/delivery/edit', [DeliveryController::class, 'edit_delivery'])->name('edit-delivery');

    //coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/coupon/load', [CouponController::class, 'load_coupon'])->name('coupon-load');
    Route::get('/coupon/delete/{id}', [CouponController::class, 'delete_coupon'])->name('coupon-delete');
    Route::get('/coupon/insert', [CouponController::class, 'insert_coupon'])->name('coupon-insert');
    Route::post('/coupon/save', [CouponController::class, 'save_coupon'])->name('save-coupon');

    // chức năng nâng cao admin product
    Route::post('/cap-nhat-gia-san-pham', [App\Http\Controllers\productController::class, 'capnhatprice'])->name('capnhatprice');
    Route::delete('/delete-all-san-pham', [App\Http\Controllers\productController::class, 'deleteallsp'])->name('deleteallsp');
});


// Client
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/compare', function () {
    return view('Auth.home-compare.compare');
});
Route::get('/product_list', function () {
    // dd('123');
    $categories = CategoryModel::orderBy('id','desc')->get();
    $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->search()->paginate(9);
    if (Auth::user()) {
        $userLogin = Auth::user()->id;
        $list_favourite = DB::table('t_product')->join('t_user_favourite', 't_user_favourite.id_product', '=', 't_product.id')->where('t_user_favourite.id_user', $userLogin)->get();
        // dd($list_favourite);
    } else {
        $list_favourite = [];
        // dd($list_favourite);
    }
    if (isset($_GET['danhsach'])) {
        $sort_by = $_GET['danhsach'];
        if ($sort_by == 'sanphamaz') {
            $showproduct = product::orderBy('id', 'ASC')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'sanphamza') {
            $showproduct = product::orderBy('id', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'giathapdencao') {
            $showproduct = product::orderBy('m_original_price', 'asc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'giacaodenthap') {
            $showproduct = product::orderBy('m_original_price', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'moicapnhat') {
            $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        }
    }
    return view('Auth.product_list.product_list', compact('categories', 'showproduct', 'list_favourite'));
});
Route::get('/product_list_search', function (Request $request) {
    $keyword = '';
    if (!empty($request->input('keywork'))) {
        $keywork =  $request->input('keywork');
        $showproduct = product::orderBy('updated_at', 'desc')->where("m_product_name", 'LIKE', "%{$keywork}%")->where('m_status', 1)->search()->paginate(9);
    }
    $categories = CategoryModel::orderBy('id','desc')->get();
    // return $showproduct;
    if (Auth::user()) {
        $userLogin = Auth::user()->id;
        $list_favourite = DB::table('t_product')->join('t_user_favourite', 't_user_favourite.id_product', '=', 't_product.id')->where('t_user_favourite.id_user', $userLogin)->get();
    } else {
        $list_favourite = [];
    }
    if (isset($_GET['danhsach'])) {
        $sort_by = $_GET['danhsach'];
        if ($sort_by == 'sanphamaz') {
            $showproduct = product::orderBy('id', 'ASC')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'sanphamza') {
            $showproduct = product::orderBy('id', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'giathapdencao') {
            $showproduct = product::orderBy('m_original_price', 'asc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'giacaodenthap') {
            $showproduct = product::orderBy('m_original_price', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        } elseif ($sort_by == 'moicapnhat') {
            $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->search()->paginate(9);
            $showproduct->render();
        }
    }
    return view('Auth.product_list.product_list', compact('categories', 'showproduct', 'list_favourite'));
})->name('search');
Route::get('/loc-gia-sp', [HomeController::class, 'locgiasp'])->name('locgia');
Route::get('/product_list/{id}', [HomeController::class, 'showcategoryid'])->name('showcategoryid');

Route::get('/wishlist', function () {
    return view('Auth.wishlist.wishlist');
});
Route::get('/cart', function () {
    return view('Auth.cart.cart');
});
Route::get('/checkout', function () {
    return view('Auth.checkout.checkout');
});

// Profile Client
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::get('/chi-tiet-don-hang/{id}', [App\Http\Controllers\ProfileController::class, 'order']);
    Route::get('/huy-don-hang/{id}', [App\Http\Controllers\ProfileController::class, 'cancelled']);
    Route::post('/doi-thong-tin-profile/{id}', [App\Http\Controllers\ProfileController::class, 'updateProfile']);
});

Route::post('doi-mat-khau-user',[App\Http\Controllers\ProfileController::class, 'doimatkhauuser'])->name('doimatkhauuser');
Route::post('doi-thong-tin-user',[App\Http\Controllers\ProfileController::class, 'doithongtinuser'])->name('doithongtinuser');


Route::get('/chi-tiet-san-pham/{slug}', [HomeController::class, 'productdetail'])->name('productdetails');
Route::post('postcomment', [HomeController::class, 'postcomment'])->name('postcomment');
Route::post('showdelete', [HomeController::class, 'showdelete'])->name('showdelete');

Route::get('/login', function () {
    return view('Auth.login');
});
Route::get('/register', function () {
    return view('Auth.register');
});

// Order
Route::get('/cart', function () {
    return view('Auth.cart.cart');
})->name('cart');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout-coupon', [CheckoutController::class, 'check_coupon'])->name('checkout-coupon');
Route::get('/checkout-success', [CheckoutController::class, 'checkout_success'])->name('checkout-success');
Route::post('/checkout-location', [CheckoutController::class, 'select_location'])->name('checkout-location');
Route::post('/checkout-delivery', [CheckoutController::class, 'delivery'])->name('checkout-delivery');
Route::post('/momo-payment', [CheckoutController::class, 'momo_payment'])->name('momo-payment');
Route::post('/vnpay-payment', [CheckoutController::class, 'vnpay_payment'])->name('vnpay-payment');

// Product
Route::get('/product_list', function () {
    $categories = CategoryModel::orderBy('id','desc')->get();
    $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->search()->paginate(9);
    return view('Auth.product_list.product_list', compact('categories', 'showproduct'));
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
    Route::get('/chi-tiet-don-hang/{id}', [App\Http\Controllers\ProfileController::class, 'order']);
    Route::get('/huy-don-hang/{id}', [App\Http\Controllers\ProfileController::class, 'cancelled']);
    Route::post('/doi-thong-tin-profile', [App\Http\Controllers\ProfileController::class, 'updateProfile']);
});

Route::get('/chi-tiet-san-pham/{slug}', [HomeController::class, 'productdetail'])->name('productdetails');
Route::post('postcomment', [HomeController::class, 'postcomment'])->name('postcomment');
Route::post('showdelete', [HomeController::class, 'showdelete'])->name('showdelete');
Route::get('/wishlist', function () {
    return view('Auth.wishlist.wishlist');
});
// Blog
Route::get('/blog-detail/{m_slug}', [PostController::class, 'detail'])->name('blog-detail');
Route::get('/blog', [PostController::class, 'blog_list'])->name('blog-list');
Route::get('/get_data_cmt/{id}', [Comment_Product::class, 'get_data_cmt']);
Route::get('/get_data_khachang/{id}', [Comment_Product::class, 'get_data_khachang']);

// Liên hệ phần người dùng
Route::get('/contact', [ContactController::class, 'index'])->name('contact-auth');
Route::post('/contact', [ContactController::class, 'postMessage']);
Route::get('/get_data_khachang/{id}', [Comment_Product::class, 'get_data_khachang']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
//Chọn sản phẩm yêu thích
Route::post('/product-favourite', [productController::class, 'productFavourite']);

// Route::post('/check-product-favourite', [productController::class, 'checkProductFavourite']);
//Danh sách sản phẩm yêu thích của user đã chọn
Route::get('/list-product-favourite', [productController::class, 'listProductFavourite'])->name('list-favourite');

//Search
Route::post('/search', [productController::class, 'search']);
//Sản phẩm theo danh mục
Route::get('category/{id}', [productController::class, 'categoryProduct'])->name('categoryProduct');
// pages
Route::get('/quydinh', function () {
    return view('pages.quydinh');
})->name('quydinh');
Route::get('/chinh-sach-doi-tra', function () {
    return view('pages.chinhsachdoitra');
})->name('chinhsachdoitra');
Route::get('huong-dan-chon-size', function () {
    return view('pages.hdsize');
})->name('hdsize');
//Tuyển dụng
Route::get('/tuyendung', [HomeController::class, 'tuyendung'])->name('tuyendung');
//Bảo mật
Route::get('/baomat', [HomeController::class, 'baomat'])->name('baomat');
// about us
Route::get('/ve-kingdom-sneakers', function () {
    return view('Auth.about-us.index');
})->name('about-us');
