<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

session_start();
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('/DangNhap');
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Kiểm tra đăng nhập của sinhvien
        if (strlen($username) == 13) {
            $sinhvien = DB::table('tbsinhvien')->where('MaSV', $username)->first();
            if ($sinhvien && $sinhvien->MatKhau == $password) {
                session(['user' => $sinhvien]);
                return redirect()->route('TrangChu_SV');
            }
            else {
                return back()->withInput()->withErrors(['fail' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
            }
        }
        
        // Kiểm tra đăng nhập của ctsv
        elseif (strlen($username) == 10) {
            $ctsv = DB::table('tbphongctsv')->where('MaCanBo', $username)->first();
            if ($ctsv && $ctsv->MatKhau == $password) {
                session(['ctsv' => $ctsv]);
                return redirect()->route('TrangChu_CTSV');
            }
            else {
                return back()->withInput()->withErrors(['fail' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
            }
        }
        
        // Trường hợp tên đăng nhập không hợp lệ
        else {
            return back()->withInput()->withErrors(['fail' => 'Tên đăng nhập không hợp lệ']);
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
