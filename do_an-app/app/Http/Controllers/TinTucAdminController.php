<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TinTucAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_tin_tuc = DB::table('sb_tin_tuc')
            ->select(DB::raw('sb_tin_tuc.*,ten_loai_tin'))
            ->join('sb_loai_tin_tuc', 'sb_tin_tuc.id_loai_tin_tuc', '=', 'sb_loai_tin_tuc.ID')
            ->get();
        return view('page_admin.trang_ds_tin_tuc')->with('ds_tin_tuc', $ds_tin_tuc);
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
        $ds_tin = DB::table('sb_tin_tuc')->get();
        $ds_ncc = DB::table('sb_nha_cung_cap')->get();

        $tin_tuc_san_pham = DB::table('sb_tin_tuc')->where('ID', $id)->first();

        return view('page_admin.trang_them_tin_tuc')
            ->with('ds_tin', $ds_tin)
            ->with('tin_tuc_san_pham', $tin_tuc_san_pham);
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
        $tieu_de = $request->get('tieu_de');
        $tom_tat = $request->get('tom_tat');
        $id_loai_tin_tuc = $request->get('id_loai_tin_tuc');
        $chi_tiet = $request->get('chi_tiet');
        $ngay_dang = $request->get('ngay_dang');
       

        $hinh = $request->get('hinh');

        if ($request->hasFile('hinh_tin_tuc')) {
            $hinh_tin_tuc = $request->file('hinh_tin_tuc');

            $cur_time = time();

            $name_file = $hinh_tin_tuc->getClientOriginalName();
            $arr_name_file = explode('.', $name_file);

            $public_path = public_path();
            $hinh = $arr_name_file[0] . '_' . $cur_time . '.' . $arr_name_file[count($arr_name_file) - 1];
            if ($hinh_tin_tuc->isValid()) {
                $hinh_tin_tuc->move($public_path . '/images/hinh_tt', $hinh);
            }
        }

        $result = DB::table('sb_tin_tuc')
            ->where('ID', $id)
            ->update([
                'tieu_de' => $tieu_de,
                'tom_tat' => $tom_tat,
                'chi_tiet' => $chi_tiet,
                'id_loai_tin_tuc' => $id_loai_tin_tuc,
                'ngay_dang' => $ngay_dang,

            ]);

        return redirect('/admin/ql-tin-tuc/edit/' . $id)->with('NoticeSuccess', 'Cập nhật tin tức mới thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::table('sb_tin_tuc')->where('ID', $id)->delete();
            DB::table('sb_loai_tin_tuc')->where('ID', $id)->delete();
            return redirect($_SERVER['HTTP_REFERER'])->withErrors('Xoá thành công ', 'NoticeDelete');
        } catch (Exception $e) {
            return redirect($_SERVER['HTTP_REFERER'])->withErrors('Bị lỗi trong quá trình xóa vui lòng thử lại: ' . $e, 'NoticeDelete');
        }
    }
}
