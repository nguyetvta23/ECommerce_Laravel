<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sliderModel;

class sliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Quản lý slider',
            'action' => 'quản lý slider'
        ];
        $datas = sliderModel::orderBy('id','asc')->search()->paginate(10);
        return view('admin.slider.index', compact('data','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Thêm slider',
            'action' => 'quản lý slider'
        ];
        return view('admin.slider.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'm_subtitle' => 'required',
            'm_title' => 'required',
            'm_link' => 'required',
            'm_description' => 'required',
            'file_upload' => 'required',
        ],
        [
            'm_subtitle.required' => 'Tên phụ đề không để trống',
            'm_title.required' => 'Tên tiêu đề không để trống',
            'm_link.required' => 'Đường dẫn không để trống',
            'm_description.required' => 'Mô tả ngắn không để trống',
            'file_upload.required' => 'Hình ảnh không để trống'
        ]);
        $create = new sliderModel();
        $create->m_subtitle = $request->m_subtitle;
        $create->m_title = $request->m_title;
        $create->m_link = $request->m_link;
        $create->m_description = $request->m_description;
        $create->m_status = $request->m_status;
        if($request->file('file_upload')){
            $file= $request->file_upload;
            $ext = $request->file_upload->extension();
            $file_name = time().'-'.'slider.'.$ext;
            $file->move(public_path('uploads'), $file_name);
        }
        $create->m_images = $file_name;
        $create->save();
        return redirect()->route('slider.index')->with('alert_success', 'Thêm mới slide thành công.');
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
            'title' => 'quản lý slider',
            'action' => 'quản lý slider'
        ];
        $idslider = sliderModel::find($id);
        return view('admin.slider.edit', compact('idslider','data'));
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
        $request->validate([
            'm_subtitle' => 'required',
            'm_title' => 'required',
            'm_link' => 'required',
            'm_description' => 'required',
        ],
        [
            'm_subtitle.required' => 'Tên phụ đề không để trống',
            'm_title.required' => 'Tên tiêu đề không để trống',
            'm_link.required' => 'Đường dẫn không để trống',
            'm_description.required' => 'Mô tả ngắn không để trống',
        ]);
        $updated = sliderModel::find($id);
        $updated->m_subtitle = $request->m_subtitle;
        $updated->m_title = $request->m_title;
        $updated->m_link = $request->m_link;
        $updated->m_description = $request->m_description;
        $updated->m_status = $request->m_status;
        if($request->file('file_upload') == null)
        {

        }elseif($request->file('file_upload')){
                $path = public_path('uploads').'/'.$updated->m_images;
                if(file_exists($path)){
                    unlink($path);
                }
                $file= $request->file_upload;
                $ext = $request->file_upload->extension();
                $file_name = time().'-'.'slider.'.$ext;
                $file->move(public_path('uploads'), $file_name);
                $updated->m_images = $file_name;
        }
        $updated->save();
        return redirect()->route('slider.index')->with('alert_success', 'Cập nhật slide thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove = sliderModel::find($id);
        $path = public_path('uploads').'/'.$remove->m_images;
        if(file_exists($path)){
                unlink($path);
        }
        $remove->delete();
        return redirect()->route('slider.index')->with('alert_success', 'Xóa slide thành công.');
    }
}
