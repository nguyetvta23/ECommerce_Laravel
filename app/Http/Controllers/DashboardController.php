<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\categoryModel;
use App\Models\OrderModel;
use App\Models\Cmt_Product;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    // public function login(){
    //     $data = [
    //         'title' => 'Thống kê',
    //         'action'=> 'dashboard'
    //     ];


    //     if(!Auth::guest()){
    //         return redirect()->route('admintrator');
    //     }else{
    //         return view('admin.account.login');
    //     }
    // }
    public function index()
    {
        $data = [
            'title' => 'Thống kê',
            'action' => 'dashboard'
        ];
        $tongsanpham = product::all();
        $tongdanhmuc = categoryModel::all();
        $cmtproduct = Cmt_Product::all();
        $cmtproduct5sao = Cmt_Product::where('ratings', 5)->get()->count();
        $cmtproduct4sao = Cmt_Product::where('ratings', 4)->get()->count();
        $cmtproduct3sao = Cmt_Product::where('ratings', 3)->get()->count();
        $cmtproduct2sao = Cmt_Product::where('ratings', 2)->get()->count();
        $cmtproduct1sao = Cmt_Product::where('ratings', 1)->get()->count();
        $showcmtganday = Cmt_Product::orderBy('idbl', 'desc')->take(5)->get();
        $sub14day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $tongdonhang = OrderModel::whereBetween('updated_at', [$sub14day, $now])->get();
        $showdonhangganday = OrderModel::orderBy('id', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('data', 'tongsanpham', 'tongdanhmuc', 'tongdonhang', 'cmtproduct', 'cmtproduct5sao', 'cmtproduct4sao', 'cmtproduct3sao', 'cmtproduct2sao', 'cmtproduct1sao', 'showcmtganday', 'showdonhangganday'));
    }
    public function file()
    {
        $data = [
            'title' => 'file Hình',
            'action' => 'file'
        ];
        return view('admin.file', compact('data'));
    }

    public function orderdate(Request $request)
    {
        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $get = OrderModel::whereBetween('updated_at', [$sub7day, $now])->orderBy('updated_at', 'ASC')->get();
        foreach ($get as $val) {
            $chart_data[] = array(
                'name' => $val->m_name,
                'tongtien' => $val->m_total_price,
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function filterdate(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $chart_data[] = array(
            'name' => '',
            'tongtien' => 0,
        );
        $get = OrderModel::whereBetween('updated_at', [$from_date, $to_date])->orderBy('updated_at', 'ASC')->get();
        foreach ($get as $val) {

            $chart_data[] = array(
                'name' => $val->m_name,
                'tongtien' => $val->m_total_price,
            );
        }
        echo $data = json_encode($chart_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
