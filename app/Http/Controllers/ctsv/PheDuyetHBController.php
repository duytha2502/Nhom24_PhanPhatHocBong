<?php

namespace App\Http\Controllers\ctsv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PheDuyetHBController extends Controller
{
    public function DSPDHB($MaHB){
        $dsPD = DB::table('tbphieudangky')
            ->join('tbhocbong','tbphieudangky.MaHB','=','tbhocbong.MaHB')
            ->join('tbsinhvien','tbphieudangky.MaSV','=','tbsinhvien.MaSV')
            ->join('tblop','tbsinhvien.MaLop','=','tblop.MaLop')
            ->join('tbkhoa','tblop.MaKhoa','=','tbkhoa.MaKhoa')
            ->where('tbphieudangky.MaHB',$MaHB)->get();
        $hocbong = DB::table('tbhocbong')->where('MaHB',$MaHB)->first();
        return view('ctsv/DS_PheDuyetHocBong',compact('MaHB','dsPD','hocbong'));
    }
    public function CTPDHB($MaPhieu){
        $ctPD = DB::table('tbphieudangky')
            ->join('tbhocbong','tbphieudangky.MaHB','=','tbhocbong.MaHB')
            ->join('tbsinhvien','tbphieudangky.MaSV','=','tbsinhvien.MaSV')
            ->join('tblop','tbsinhvien.MaLop','=','tblop.MaLop')
            ->join('tbkhoa','tblop.MaKhoa','=','tbkhoa.MaKhoa')
            ->where('tbphieudangky.MaPhieu',$MaPhieu)->first();
        $Anh = DB::table('tbanh')->where('MaPhieu',$MaPhieu)->get();
        return view('ctsv/ChiTietDuyetHocBong',compact('MaPhieu','ctPD','Anh'));
    }

    public function cancle(Request $request, $MaPhieu){
        DB::table('tbphieudangky')->where('MaPhieu', $MaPhieu)->update(['TinhTrang' => 0]);
          return redirect()->route('TrangChu_CTSV');
    }

    public function CDiem(Request $request, $MaPhieu){
        $current_user = session()->get('ctsv');
        $data = array(
            'MaPhieu' => $MaPhieu,
            'MaCanBo' => $current_user->MaCanBo,
            'Diem' => $request->Diem
        );
        DB::table('tbpheduyetphieudangky')->insert($data);
        DB::table('tbphieudangky')->where('MaPhieu', $MaPhieu)->update(['TinhTrang' => 1]);
        return redirect()->route('TrangChu_CTSV');
    }

    public function DSPhanHoi(){
        $dsPH = DB::table('tbphanhoi')
            ->join('tbsinhvien','tbphanhoi.MaSV','=','tbsinhvien.MaSV')
            ->join('tblop','tbsinhvien.MaLop','=','tblop.MaLop')
            ->join('tbkhoa','tblop.MaKhoa','=','tbkhoa.MaKhoa')->orderBy('ThoiGian', 'desc')->get();
        return view('ctsv/DS_PhanHoi',compact('dsPH'));
    }

    public function CTPhanHoi($MaPhanHoi){
        $ctPH = DB::table('tbphanhoi')
            ->join('tbsinhvien','tbphanhoi.MaSV','=','tbsinhvien.MaSV')
            ->join('tblop','tbsinhvien.MaLop','=','tblop.MaLop')
            ->join('tbkhoa','tblop.MaKhoa','=','tbkhoa.MaKhoa')
            ->where('tbphanhoi.MaPhanHoi',$MaPhanHoi)->first();
        return view('ctsv/ChiTietPhanHoi',compact('ctPH'));
    }
}
