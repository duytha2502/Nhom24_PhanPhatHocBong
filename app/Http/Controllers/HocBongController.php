<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HocBongController extends Controller
{

    //show form create HocBong
    public function create()
    {
        return view('ctsv/TaoBaiDang_CTSV');
    }

    public function store(Request $request)
    {
        $user = session()->get('ctsv');        
        $validatedData = $request->validate([
            'tenHocBong' => 'required',
            'soLuongThamGia' => 'required|integer',
            'ngayBatDau' => 'required|date',
            'ngayKetThuc' => 'required|date',
            'doiTuong' => 'required',
            'nhaTaiTro' => 'required',
            'tieuChi' => 'required',
            'moTa' => 'required',
            'anh' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
       
        
        // Store the uploaded image on the server
        $imageName = time().'.'.$validatedData['anh']->extension();
        $validatedData['anh']->move(public_path('image'), $imageName);
        $MaCanBo = $user->MaCanBo;

        try {
            DB::beginTransaction();
        
            $hocBongData = [
                'MaCanBo' => $MaCanBo,
                'TenHocBong' => $validatedData['tenHocBong'],
                'SoLuongThamGia' => $validatedData['soLuongThamGia'],
                'NgayBatDau' => $validatedData['ngayBatDau'],
                'NgayKetThuc' => $validatedData['ngayKetThuc'],
                'NgayDangBai' => date('Y-m-d H:i:s'),
                'DoiTuong' => $validatedData['doiTuong'],
                'NhaTaiTro' => $validatedData['nhaTaiTro'],
                'TieuChi' => $validatedData['tieuChi'],
                'MoTa' => $validatedData['moTa'],
                'Anh' => '/image/'.$imageName
            ];
            DB::table('tbhocbong')->insert($hocBongData);
        
            DB::commit();
        
            return back()->with('condition', true);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('fail','Đã xảy lỗi khi tạo.');
        }
    }
}