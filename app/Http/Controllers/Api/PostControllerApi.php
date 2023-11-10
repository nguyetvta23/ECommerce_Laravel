<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PostControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $post = new Post();
            $post->m_title = $request->m_title;
            $post->m_id_user = $request->m_id_user;
            $post->m_slug = $request->m_slug;
            $post->m_desc = $request->m_desc;
            $post->m_content = $request->m_content;
            $post->m_meta_keyword = $request->m_meta_keyword;
            $post->m_meta_desc = $request->m_meta_desc;
            $post->m_status = $request->m_status;
            $get_image = $request->file('m_image');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/post', $new_image);
            $post->m_image = $new_image;
            $post->save();
            return ['data' => $post, 'isError' => false, 'message' => "Thêm bài viết thành công!"];
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
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
        return Post::find($id);
    }

    /**0
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {
        $request->validate([
            'm_slug' => 'required',
            'm_file' => 'bail',
        ]);
        try {
            $post = Post::find($id);
            $post->m_title = $request->m_title;
            $post->m_slug = $request->m_slug;
            $post->m_desc = $request->m_desc;
            $post->m_content = $request->m_content;
            $post->m_meta_keyword = $request->m_meta_keyword;
            $post->m_meta_desc = $request->m_meta_desc;
            $post->m_status = $request->m_status;
            if ($request->file('m_image')) {
                $get_image = $request->file('m_image');
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/post', $new_image);
                $post->m_image = $new_image;
            }
            $post->save();
            return ['data' => $post, 'isError' => false, 'message' => "Sửa bài viết thành công!"];
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
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
        $post = Post::find($id);
        if (file_exists(public_path('uploads/post/' . $post->m_image))) {
            Storage::delete(public_path('uploads/post/' . $post->m_image));
        }
        if (Post::destroy($id)) {
            return  ['isError' => false, 'message' => "Xóa bài viết thành công!"];
        } else {
            return ['isError' => true, 'message' => "Xóa bài viết không thành công!"];
        }
    }
}
