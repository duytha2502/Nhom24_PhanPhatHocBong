<?php

namespace App\Http\Controllers\ctsv;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function showHB()
    {
        $hocbongs = DB::table('tbhocbong')
            ->join('tbphongctsv', 'tbhocbong.MaCanBo', '=', 'tbphongctsv.MaCanBo')
            ->select('tbhocbong.*', 'tbphongctsv.HoTen')
            ->get();
        $canbos = DB::table('tbphongctsv')
            ->get();
        try {
            $nhataitros = DB::table('tbhocbong')
                ->select('NhaTaiTro')
                ->groupBy('NhaTaiTro')
                ->get();
        } catch (\Exception $e) {
            dd($e);
        }
        return view('/ctsv/ThongKe_XuatFile_HB', compact('hocbongs', 'canbos', 'nhataitros'));
    }
    public function searchHocBong(Request $request)
    {
        $canbos = DB::table('tbphongctsv')
            ->get();
        $nhataitros = DB::table('tbhocbong')
            ->select('NhaTaiTro')
            ->groupBy('NhaTaiTro')
            ->get();
        $canbo = $request['canbo'];
        $start = $request['start'];
        $end = $request['end'];
        $nhataitro = $request['nhataitro'];
        $search = $request['search'];
        $hocbongs = null;
        try {
            if ($search == null) {
                $hocbongs = DB::table('tbhocbong')
                    ->join('tbphongctsv', 'tbhocbong.MaCanBo', '=', 'tbphongctsv.MaCanBo')
                    ->when($canbo, function ($query) use ($canbo) {
                        return $query->where('tbhocbong.MaCanBo', $canbo);
                    })
                    ->when($start, function ($query) use ($start) {
                        return $query->where('tbhocbong.NgayBatDau', '>=', $start);
                    })
                    ->when($end, function ($query) use ($end) {
                        return $query->where('tbhocbong.NgayKetThuc', '<=', $end);
                    })
                    ->when($nhataitro, function ($query) use ($nhataitro) {
                        return $query->where('tbhocbong.NhaTaiTro', $nhataitro);
                    })
                    ->get();
            } else {
                $hocbongs = DB::table('tbhocbong')->where('TenHocBong', 'LIKE', "%$search%")
                    ->orWhere('MoTa', 'LIKE', "%$search%")
                    ->orWhere('TieuChi', 'LIKE', "%$search%")
                    ->orWhere('DoiTuong', 'LIKE', "%$search%")
                    ->get();
            }


            // dd($hocbongs);
            return view('/ctsv/ThongKe_XuatFile_HB', compact('hocbongs', 'nhataitros', 'canbos'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function showSV()
    {
        $dshb = DB::table('tbhocbong')->get();
        $khoas = DB::table('tbkhoa')->get();
        $lops = DB::table('tblop')->get();

        $dsSV = DB::table('tbsinhvien')
            ->join('tblop', 'tbsinhvien.MaLop', '=', 'tblop.MaLop')
            ->join('tbkhoa', 'tblop.MaKhoa', '=', 'tbkhoa.MaKhoa')
            ->join('tbphieudangky', 'tbsinhvien.MaSV', '=', 'tbphieudangky.MaSV')
            // ->where('TinhTrang', 1)
            ->orderBy('tbsinhvien.MaSV', 'ASC')->get();
        return view('/ctsv/ThongKe_XuatFile_SV', compact('dsSV', 'khoas', 'lops', 'dshb'));
    }

    public function filterSV(Request $request)
    {
        $mahocbong = $request->hocbong_id;
        $makhoa = $request->tbkhoa_id;
        $malop = $request->tblop_id;
        $check = $request->soluongsv;
        //1=all, 0=sv dau hoc bong
        if ($malop) {
            $makhoa = null;
        }

        $dshb = DB::table('tbhocbong')->get();
        $khoas = DB::table('tbkhoa')->get();
        $lops = DB::table('tblop')->get();
        $dsSV = DB::table('tbsinhvien')
            ->join('tblop', 'tbsinhvien.MaLop', '=', 'tblop.MaLop')
            ->join('tbkhoa', 'tblop.MaKhoa', '=', 'tbkhoa.MaKhoa')
            ->join('tbphieudangky', 'tbsinhvien.MaSV', '=', 'tbphieudangky.MaSV')
            ->when($mahocbong, function ($query) use ($mahocbong) {
                return $query->where('MaHB', $mahocbong);
            })
            ->when($malop, function ($query) use ($malop) {
                return $query->where('tbsinhvien.MaLop', $malop);
            })
            ->when($makhoa, function ($query) use ($makhoa) {
                return $query->where('tblop.MaKhoa', $makhoa);
            })
            ->when($check == 0, function ($query) use ($check) {
                return $query->where('TinhTrang', 1);
            })->get();
        return view('/ctsv/ThongKe_XuatFile_SV', compact('dsSV', 'khoas', 'lops', 'dshb'));
    }
}
