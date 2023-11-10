<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\product;
use App\Models\Cmt_product;
use App\Models\product_inventory;
use App\Models\OrderModel;
use App\Models\Post;
use App\Models\sliderModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $categories = CategoryModel::where('m_id_parent', 0)->get();
        $sliders = sliderModel::where('m_status', 1)->get();
        $myProducts = product::with('updatedsoluong1')->where('m_status', 1)->get();
        $myProductSells = product::where('m_status', 1)->orderBy('m_buy', 'DESC')->paginate(6);
        $blogs = Post::where('m_status', 1)->paginate(4);
        return view('Auth.home-compare.home_page', compact('categories','sliders','myProducts','myProductSells', 'blogs'));
    }
    public function locgiasp(){
        if(isset($_GET['minamount']) && isset($_GET['maxamount'])){
            $minprice=$_GET['minamount'];
            $maxprice=$_GET['maxamount'];
            $showproduct = product::whereBetween('m_original_price', [$minprice, $maxprice])->orderBy('id', 'asc')->search()->paginate(10);
        }
        $categories = CategoryModel::where('m_id_parent', 0)->get();
        if (\Auth::user()) {
            $userLogin = \Auth::user()->id;
            $list_favourite = DB::table('t_product')->join('t_user_favourite', 't_user_favourite.id_product', '=', 't_product.id')->where('t_user_favourite.id_user', $userLogin)->get();
        } else {
            $list_favourite = [];
        }
        if(isset($_GET['danhsach'])){
            $sort_by = $_GET['danhsach'];
            if($sort_by == 'sanphamaz'){
                $showproduct = product::orderBy('id', 'ASC')->where('m_status', 1)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'sanphamza'){
                $showproduct = product::orderBy('id', 'desc')->where('m_status', 1)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'giathapdencao'){
                $showproduct = product::orderBy('m_original_price', 'asc')->where('m_status', 1)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'giacaodenthap'){
                $showproduct = product::orderBy('m_original_price', 'desc')->where('m_status', 1)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'moicapnhat'){
                $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->search()->paginate(10);
                $showproduct->render();
            }
        }
        return view('Auth.product_list.product_list', compact('showproduct','categories','list_favourite'));
    }
    public function showcategoryid($id){
        $categories = CategoryModel::where('m_id_parent', 0)->get();
        $showproduct = product::orderBy('updated_at', 'desc')->where('m_id_category', $id)->where('m_status', 1)->search()->paginate(10);
        if (\Auth::user()) {
            $userLogin = \Auth::user()->id;
            $list_favourite = DB::table('t_product')->join('t_user_favourite', 't_user_favourite.id_product', '=', 't_product.id')->where('t_user_favourite.id_user', $userLogin)->get();
        } else {
            $list_favourite = [];
        }
        if(isset($_GET['danhsach'])){
            $sort_by = $_GET['danhsach'];
            if($sort_by == 'sanphamaz'){
                $showproduct = product::orderBy('id', 'ASC')->where('m_status', 1)->where('m_id_category', $id)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'sanphamza'){
                $showproduct = product::orderBy('id', 'desc')->where('m_status', 1)->where('m_id_category', $id)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'giathapdencao'){
                $showproduct = product::orderBy('m_original_price', 'asc')->where('m_status', 1)->where('m_id_category', $id)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'giacaodenthap'){
                $showproduct = product::orderBy('m_original_price', 'desc')->where('m_status', 1)->where('m_id_category', $id)->search()->paginate(10);
                $showproduct->render();
            }elseif($sort_by == 'moicapnhat'){
                $showproduct = product::orderBy('updated_at', 'desc')->where('m_status', 1)->where('m_id_category', $id)->search()->paginate(10);
                $showproduct->render();
            }
        }
        return view('Auth.product_list.product_list', compact('showproduct','categories','list_favourite'));
    }
    public function productdetail($slug){
        $showproductdetail = product::where('m_product_slug', $slug)->first();
        $showcategoryid = CategoryModel::where('id', $showproductdetail->m_id_category)->first();
        $showproductdetailget = product::where('id', $showproductdetail->id)->where('m_status', 1)->get();
        $showsize = product_inventory::where('m_id_product', $showproductdetail->id)->get();
        $showproductrelated  = product::where('m_id_category', $showcategoryid->id)->where('id','!=',$showproductdetail->id)->inRandomOrder()->where('m_status', 1)->take(8)->get();
        $showcomment = Cmt_product::where('m_id_maloai', $showproductdetail->id)->where('m_status', 1)->get();

        return view('Auth.product_details.productdetails', compact('showproductdetail','showproductdetailget','showsize','showproductrelated','showcomment'));
    }
    public function postcomment(Request $request){
        if($datacmt = Cmt_product::where('m_id_user', \Auth::user()->id)->where('m_id_maloai', $request->idmaloai)->exists()){
            if($datacmt){
                $datarq = $request->all();
                $updated = Cmt_product::find($datarq['idbl']);
                $updated->m_id_parent = 1;
                $updated->m_content = $datarq['noi_dung'];
                $updated->ratings = $datarq['rating'];
                $updated->save();
                echo 'thanhcong';
            }
        }elseif($data = DB::table('t_order')->where('m_id_user', $request->iduser)->exists() &&  $data1 = DB::table('t_order_detail')->where('m_id_product', $request->idmaloai)->exists()){
            if($data && $data1){
                $data = $request->all();
                $created = new Cmt_product();
                $created->m_id_maloai = $data['idmaloai'];
                $created->m_id_user = $data['iduser'];
                $created->m_id_parent = 1;
                $created->m_content = $data['noi_dung'];
                $created->ratings = $data['rating'];
                $created->save();
                echo 'thanhcong';
            }
        }
    }

    public function showdelete(Request $request){
        $data = $request->all();
        $deleted = Cmt_product::find($data['iddelete']);
        $deleted->delete();
        echo 'thanhcong';
    }

    // Các chính sách
    public function tuyendung(){
        return view('pages.tuyendung');
    }
    public function baomat(){
        return view('pages.baomat');
    }
}
