<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Http\Requests\PostCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorySelect = CategoryModel::where('m_id_parent', 0)->get();
        $data = [
            'title' => 'Danh Mục',
            'action' => 'category'
        ];
        return view('Admin.category.index', compact('data', 'categorySelect'));
    }

    public function loadlist()
    {
        $Category = new CategoryModel();
        $result = [
            'status' => 'OK',
            'msg' => 'Tải danh sách category thành công',
            'data' => [],
        ];
        $listCategory = $Category->getAllCategory();
        if (!empty($listCategory)) {
            $result['data'] = $listCategory;
        } else {
            $result = [
                'status' => 'OK',
                'msg' => 'Tải danh sách category không thành công',
                'data' => [],
            ];
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function delete($id)
    {
        $category = CategoryModel::where('id', $id)->delete();
        $sub_category = CategoryModel::where('m_id_parent', $id)->first();
        if($sub_category) {
            CategoryModel::where('m_id_parent', $id)->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'Xóa danh mục thành công'
        ]);
    }

    public function getAddCategory()
    {
        $data = [
            'title' => 'Danh mục',
            'action' => 'category'
        ];
        $categorySelect = CategoryModel::all();
        return view('admin.category.add', compact('data', 'categorySelect'));
    }

    public function postAddCategory(PostCategoryRequest $request)
    {
        $request->validated();
        CategoryModel::insert([
            'm_title' => $request->nameCategory,
            'm_id_parent' => $request->parentCategory,
            'm_index' => 1,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Thêm danh mục thành công'
        ]);
    }

    public function getEditCategory($id)
    {
        $category = CategoryModel::where('id', $id)->first();
        $categorySelect = CategoryModel::all();
        $data = [
            'title' => 'Danh mục',
            'action' => 'category'
        ];
        return response()->json([
            'status' => 200,
            'message' => 'Lấy thông tin danh mục thành công',
            'category' => $category,
        ]);
    }

    public function postEditCategory(UpdateCategoryRequest $request, $id)
    {
        CategoryModel::where('id', $id)->update([
            'm_title' => $request->nameEditCategory,
            'm_id_parent' => $request->parentEditCategory,
            'm_index' => 1,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật danh mục thành công'
        ]);
    }
}