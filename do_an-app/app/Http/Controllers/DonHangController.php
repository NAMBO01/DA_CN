<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_info = Session::get('user_info');

        $don_hang = DB::table('bs_don_hang')
            ->select(DB::raw('bs_don_hang.ID,ma_don_hang,ten_trang_thai,trang_thai_moi,tong_tien'))
            ->join('bs_thanh_vien', 'bs_thanh_vien.ID', '=', 'bs_don_hang.id_nguoi_dung')
            ->join('bs_trang_thai', 'bs_trang_thai.id_don_hang', '=', 'bs_don_hang.ID')
            ->join('loai_trang_thai', 'loai_trang_thai.id', '=', 'bs_trang_thai.trang_thai_moi')
            ->where('id_nguoi_dung', $user_info->ID)
            ->distinct()
            ->get();

        return view('lich_su_dh')
            ->with('user_info', $user_info)
            ->with('don_hang', $don_hang);
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
    }
    function chi_tiet_don_hang($id_dh)
    {
        $user_info = Session::get('user_info');
        $ct_don_hang = DB::table('bs_don_hang')
            ->select(DB::raw('ma_don_hang,ten_trang_thai,trang_thai_moi,tong_tien'))
            ->join('bs_ct_don_hang', 'bs_ct_don_hang.ID_don_hang', 'bs_don_hang.ID')
            ->join('bs_thanh_vien', 'bs_thanh_vien.ID', '=', 'bs_don_hang.id_nguoi_dung')
            ->join('bs_trang_thai', 'bs_trang_thai.id_don_hang', '=', 'bs_don_hang.ID')
            ->join('loai_trang_thai', 'loai_trang_thai.id', '=', 'bs_trang_thai.trang_thai_moi')
            ->where('id_nguoi_dung', $user_info->ID)
            ->where('bs_don_hang.ID', $id_dh)
            ->get();

        return view('chi_tiet_don_hang')
            ->with('user_info', $user_info)
            ->with('ct_don_hang', $ct_don_hang);
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
