<?php

namespace App\Http\Controllers\ctsv;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function thongTinCanBo()
    {
        $data =  session()->get('ctsv');
        return view('ctsv.ThongTinCanBo', compact('data'));
    }

    public function HocBongCTSV()
    {
        $hocbong = DB::select('SELECT * FROM tbhocbong');
        return view('ctsv/TrangChu_CTSV', compact('hocbong'));
    }

    public function doiMatKhau()
    {
        return view('ctsv.DoiMatKhau_CTSV');
    }

    public function capNhatMatKhau(Request $request)
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
        $current_user = session()->get('ctsv');
        // dd($current_user);
        if ($request->matKhauCu == $current_user->MatKhau) {
            $user = DB::table('tbphongctsv')->where('MaCanBo', $current_user->MaCanBo)->first();
            if (!is_null($user)) {
                //Lấy ra newUser sau update database và session => message success
                $newUser = DB::table('tbphongctsv')->where('MaCanBo', $current_user->MaCanBo);
                $newUser->update(['MatKhau' => $request->matKhauMoi]);
                session()->put('ctsv', $newUser->first());

                return redirect()->back()->with('success', 'Cập nhật mật khẩu thành công');
            }
            return back()->withErrors(['fail' => 'Mật khẩu không trùng khớp']);
        }
        return back()->withErrors(['fail' => 'Mật khẩu không trùng khớp']);
    }

    public function suaThongTin()
    {
        $data = session()->get('ctsv');
        return view('ctsv.CapNhatThongTin_CTSV', compact('data'));
    }

    public function capNhatThongTin(HomeRequest $request)
    {
        $current_user = session()->get('ctsv');
        $user = DB::table('tbphongctsv')->where('MaCanBo', $current_user->MaCanBo);

        if (!is_null($user)) {
            $newUser = DB::table('tbphongctsv')->where('MaCanBo', $current_user->MaCanBo);
            $newUser->update([
                'HoTen' => $request->HoTen,
                'GioiTinh' => $request->GioiTinh,
                'DiaChi' => $request->DiaChi,
                'SDT' => $request->SDT,
                'Email' => $request->Email
            ]);
            session()->put('ctsv', $newUser->first());

            return redirect()->route('SuaThongTin')->with('success', 'Cập nhật thông tin thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
    }

    public function timKiemHocBong(Request $request){
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
        return view('ctsv/TrangChu_CTSV', compact('hocbong'));
    }
}
