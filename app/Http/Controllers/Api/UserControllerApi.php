<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddUserRequest;


class UserControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->m_address = $request->m_address;
            $user->role = $request->role;
            $get_image = $request->file('m_avatar');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/avatar', $new_image);
            $user->m_avatar = $new_image;
            $user->save();
            return ['data' => $user, 'isError' => false, 'message' => "Thêm tài khoản thành công!"];
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
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->m_address = $request->m_address;
            $user->role = $request->role;
            // $user->m_status = $request->m_status;
            if ($request->file('m_avatar')) {
                $get_image = $request->file('m_avatar');
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/avatar', $new_image);
                $user->m_avatar = $new_image;
            }
            $user->save();
            return ['data' => $user, 'isError' => false, 'message' => "Sửa tài khoản thành công!"];
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
        $user = User::find($id);
        if (file_exists(public_path('uploads/avatar/' . $user->m_avatar))) {
            Storage::delete(public_path('uploads/avatar/' . $user->m_avatar));
        }
        if (User::destroy($id)) {
            return  ['isError' => false, 'message' => "Xóa tài khoản thành công!"];
        } else {
            return ['isError' => true, 'message' => "Xóa tài khoản không thành công!"];
        }
    }
}
