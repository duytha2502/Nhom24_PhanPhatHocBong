<?php

namespace App\Http\Controllers\sinhvien;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequestSV;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeControllerSV extends Controller
{
    public function thongTinSV()
    {
        $user = session()->get('user');
        $lop = DB::table('tblop')->where('MaLop', $user->MaLop)->first();
        $khoa = DB::table('tbkhoa')->where('MaKhoa', $lop->MaKhoa)->first();
        return view('/sinhvien/ThongTinSinhVien',compact('lop','khoa'));
    }
    public function doiMatKhauSV()
    {
        return view('sinhvien.DoiMatKhau');
    }

    public function capNhatMatKhauSV(Request $request)
    {
        $request->validate(
            [
                'matKhauCu' => 'required|min:1|max:20',
                'matKhauMoi' => 'required|min:1|max:20',
                'xacNhanMatKhau' => 'required|same:matKhauMoi'
            ],
            [
                'matKhauCu.required' => 'Mật khẩu cũ bắt buộc',
                'matKhauMoi.required' => 'Mật khẩu mới bắt buộc',
                'xacNhanMatKhau.required' => 'Xác nhận mật khẩu bắt buộc',
            ]
        );
        $current_user = session()->get('user');
        // dd($current_user);
        if ($request->matKhauCu == $current_user->MatKhau) {
            $user = DB::table('tbsinhvien')->where('MaSV', $current_user->MaSV)->first();
            if (!is_null($user)) {
                //Lấy ra newUser sau update database và session => message success 
                $newUser = DB::table('tbsinhvien')->where('MaSV', $current_user->MaSV);
                $newUser->update(['MatKhau' => $request->matKhauMoi]);
                session()->put('user', $newUser->first());

                return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công');
            }
            return back()->withErrors(['fail' => 'Mật khẩu không trùng khớp']);
        }
        return back()->withErrors(['fail' => 'Mật khẩu không trùng khớp']);
    }

    public function suaThongTinSV()
    {
        $data = session()->get('user');     
        return view('sinhvien.CapNhatThongTin', compact('data'));
    }

    public function capNhatThongTinSV(HomeRequestSV $request)
    {

        $current_user = session()->get('user');   

        $user = DB::table('tbsinhvien')->where('MaSV', $current_user->MaSV);

            if (!is_null($user)) { 
            $newUser = DB::table('tbsinhvien')->where('MaSV', $current_user->MaSV);
            $newUser->update([
                'TenSV' => $request->TenSV,
                'GioiTinh' => $request->GioiTinh,
                'NgaySinh' => $request->NgaySinh,
                'DiaChi' => $request->DiaChi,
                'SDT' => $request->SDT,
                'Email' => $request->Email
            ]);            
            session()->put('user', $newUser->first());
            return redirect()->route('SuaThongTinSV')->with('success', 'Cập nhật thông tin thành công');
        } 
        return redirect()->back()->with('fail', 'Cập nhật thông tin thất bại');
    }

    public function timKiemHocBongSV(Request $request){
        $search = $request['search'] ?? "";
        if($search != ""){
            $hocbong = DB::table('tbhocbong')->where('TenHocBong','LIKE',"%$search%")
                                             ->orWhere('MoTa','LIKE',"%$search%")
                                             ->orWhere('TieuChi','LIKE',"%$search%")
                                             ->orWhere('DoiTuong','LIKE',"%$search%")
                                             ->get();
        }
        else{
            $hocbong = DB::table('tbhocbong')->get();
        }
        $data = compact('hocbong','search');
        return view('sinhvien/TrangChu_SinhVien', compact('hocbong'));
    }

    public function PhanHoi(Request $request){
        $current_user = session()->get('user');
        $data = array(
            'MaSV' => $current_user->MaSV,
            'NoiDung' => $request->NoiDung,
            'ThoiGian' => now()
        );
        DB::table('tbphanhoi')->insert($data);
        return redirect()->route('TrangChu_SV');
    }
}
