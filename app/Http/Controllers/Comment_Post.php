<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cmt_Blog;


class Comment_Product extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'QUẢN LÍ COMMENT BLOG',
            'action' => 'category'
        ];
        $query = Cmt_Blog::join('t_user','t_commentproduct.m_id_user','=','t_user.id')
                ->join('t_product','t_commentproduct.m_id','=','t_product.id')
                ->select('t_commentproduct.*','t_user.m_username','t_product.id','t_product.m_product_name')
                ->orderBy('t_commentproduct.created_at')
                ->get();
        $d = json_decode(json_encode($query), true);
        return view("admin.comment-product.Comment_Product", compact('data', 'd'));
    }
    public function delete_comment($id){
        $get_id = $id;
        Cmt_Blog::where('id','=',$get_id)->delete();
        return redirect()->route('list_comment');
    }
}
