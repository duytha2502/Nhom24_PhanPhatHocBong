<?php

namespace App\Http\Controllers\hocbong;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HocBongController extends Controller
{
    public function CHITIETHB($MaHB){
        $hocbong = DB::table('tbhocbong')->where('MaHB',$MaHB)->first();
        return view('ChiTietHocBong',compact('MaHB','hocbong'));
    }
    public function destroy(Request $request, $MaHB){
        DB::table('tbhocbong')->where('MaHB', $MaHB)->delete();
        return back();
    }
}
