<?php

use App\Http\Controllers\HocBongController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ctsv\HomeController;
use App\Http\Controllers\sinhvien\HomeControllerSV;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('TrangChu');
});


// Login
Route::get('/login', function () {
    return (new LoginController)->showLoginForm();
})->name('login');
Route::post('/login', function (Illuminate\Http\Request $request) {
    return (new LoginController)->login($request);
});
Route::get('/logout',[LoginController::class,'logout']);



Route::middleware('ctsv')->group(function () {
    // Các route dành cho nhóm quyền Cong Tac SInhVien
    Route::get('/CTHB/{MaHB}', [\App\Http\Controllers\hocbong\HocBongController::class,'CHITIETHB']);
    Route::get('/delete/{MaHB}', [\App\Http\Controllers\hocbong\HocBongController::class,'destroy']);
    Route::get('/update/{MaPhieu}', [\App\Http\Controllers\ctsv\PheDuyetHBController::class,'cancle']);
    Route::post('/add/{MaPhieu}', [\App\Http\Controllers\ctsv\PheDuyetHBController::class,'CDiem']);

    // Route::resource('hocbong', HocBongController::class);
    Route::get('/hocbong/create',[HocBongController::class,'create'])->name('create');
    Route::post('/hocbong/create',[HocBongController::class,'store'])->name('store');

    Route::get('/DSPH',[\App\Http\Controllers\ctsv\PheDuyetHBController::class,'DSPhanHoi']);
    Route::get('/CTPH/{MaPhanHoi}',[\App\Http\Controllers\ctsv\PheDuyetHBController::class,'CTPhanHoi']);

    Route::group(['prefix' => 'ctsv'], function () {

        Route::get('/TrangChu', 'ctsv\HomeController@HocBongCTSV')->name('TrangChu_CTSV');

        Route::get('/DoiMatKhau_CTSV', [HomeController::class,'doiMatKhau'])->name('DoiMatKhau');
        Route::post('/DoiMatKhau_CTSV',[HomeController::class,'capNhatMatKhau'])->name('CapNhatMatKhau');

        Route::get('/CapNhatThongTin_CTSV',[HomeController::class,'suaThongTin'])->name('SuaThongTin');
        Route::put('/CapNhatThongTin_CTSV',[HomeController::class,'capNhatThongTin'])->name('CapNhatThongTinController');

        Route::get('/ThongTinCanBo',[HomeController::class,'thongTinCanBo'])->name('ThongTinCanBo');

        Route::post('/TrangChu_CTSV',[HomeController::class,'timKiemHocBong'])->name('TimKiemHocBong');

        Route::get('/DSPDHB/{MaHB}',[\App\Http\Controllers\ctsv\PheDuyetHBController::class,'DSPDHB']);
        Route::get('/CTPDHB/{MaPhieu}',[\App\Http\Controllers\ctsv\PheDuyetHBController::class,'CTPDHB']);

        Route::get('/ThongKe_HB',[\App\Http\Controllers\ctsv\ThongKeController::class,'showHB'])->name('Thongke_HB');
        Route::post('/ThongKe_HB',[\App\Http\Controllers\ctsv\ThongKeController::class,'searchHocBong'])->name('Thongke_HB_search');

        Route::get('/ThongKe_SV',[\App\Http\Controllers\ctsv\ThongKeController::class,'showSV'])->name('Thongke_SV');
        Route::post('/ThongKe_SV',[\App\Http\Controllers\ctsv\ThongKeController::class,'filterSV'])->name('filter_SV');
        

    });
});

Route::middleware('user')->group(function () {
    // Các route dành cho nhóm quyền SInhVien

    Route::post('/add', [HomeControllerSV::class,'PhanHoi']);
    Route::get('/CTHB/{MaHB}', [\App\Http\Controllers\hocbong\HocBongController::class,'CHITIETHB']);    

    Route::group(['prefix' => 'sv'], function () {

        Route::get('/TrangChu', 'sinhvien\HomeController@HocBongSV')->name('TrangChu_SV');

        Route::get('/DoiMatKhau', [HomeControllerSV::class,'doiMatKhauSV'])->name('DoiMatKhauSV');
        Route::post('/DoiMatKhau',[HomeControllerSV::class,'capNhatMatKhauSV'])->name('CapNhatMatKhauSV');

        Route::get('/CapNhatThongTin',[HomeControllerSV::class,'suaThongTinSV'])->name('SuaThongTinSV');
        Route::put('/CapNhatThongTin',[HomeControllerSV::class,'capNhatThongTinSV'])->name('CapNhatThongTinSVController');

        Route::get('/TTSV',[HomeControllerSV::class,'thongTinSV'])->name('ThongTinSV');

        Route::post('/TrangChu_SinhVien',[HomeControllerSV::class,'timKiemHocBongSV'])->name('TimKiemHocBongSV');

        Route::get('/DangKyHB/{MaHB}',[\App\Http\Controllers\sinhvien\HomeController::class,'showDangKyHB'])->name('ShowDangKyHB');
        Route::post('/DangKyHB/{MaHB}',[\App\Http\Controllers\sinhvien\HomeController::class,'dangKyHB'])->name('DangKyHB');

        Route::get('/PhanHoi', function () {return view('sinhvien/PhanHoi');})->name('Phanhoi');


    });
});





