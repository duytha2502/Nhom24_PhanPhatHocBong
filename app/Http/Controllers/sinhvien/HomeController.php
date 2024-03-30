<?php

namespace App\Http\Controllers\sinhvien;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function HocBongSV(){
        $hocbong = DB::table('tbhocbong')->get();
        $soluong = DB::table('tbphieudangky')->where('MaHB')->count();
        return view('sinhvien/TrangChu_SinhVien',compact('hocbong','soluong'));
    }
    public function showDangKyHB($MaHB)
    {
        $hocbong = DB::table('tbhocbong')->where('MaHB', $MaHB)->first();
        return view('sinhvien/DangKyHocBong',compact('hocbong'));
    }
    public function DangKyHB(Request $request, $MaHB)
    {      
        $user = session()->get('user');
        $request->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        //Dem So Hoc Bong của SV
        $countHB = DB::table('tbphieudangky')
            ->where('MaSV', $user->MaSV)
            ->where('TinhTrang', 1)
            ->count();
        //Kiem Tra SV da Dang Ky hoc bong chua
        $existingData = DB::table('tbphieudangky')
            ->where('MaHB', $MaHB)
            ->where('MaSV', $user->MaSV)
            ->exists();
        if ($countHB > 0) {
            //Moi SV Chi Dang Ky 1 Hoc Bong
            return back()->with('fail', 'Sinh Viên đã có học bổng');           
        } else {
            if (!$existingData) {
                if($request->hasfile('imageFile')) {
                    //Tao Phieu Dang Ky
                    DB::table('tbphieudangky')->insert([
                        'MaHB' => $MaHB,
                        'MaSV' => $user->MaSV,
                        'NgayDangKy' => now(),
                    ]);

                    $maPhieu = DB::table('tbphieudangky')
                        ->where('MaHB', $MaHB)
                        ->where('MaSV', $user->MaSV)
                        ->value('MaPhieu');
                    foreach($request->file('imageFile') as $file)
                    {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path().'/uploads/', $name);  
                        //$imgData[] = $name;  
                        DB::table('tbanh')->insert([
                            'MaPhieu' => $maPhieu,
                            'AnhMinhChung' => '/uploads/' . $name
                        ]);
                    }                    
                    return back()->with('condition', true);
                }
            } else {
                return back()->with('fail', 'Sinh Viên đã đăng ký học bổng này');
            }
        }     
    }
}
