@extends('ctsv.layout.master')

@section('title', 'Thống Kê Sinh Viên')

@section('body')
    <style>
        .container {
            max-width: 100%;
            min-height: 717px;
        }

        .title {
            margin: 20px 0;
        }

        .empty-text {
            margin-top: 5%;
            margin-bottom: 5%;
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <!-- Spinner Start -->
    {{-- <div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>  --}}
    <!-- Spinner End -->
    <div class="container">
        <div class="title col-md-12">
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 text-center">
                    <h1 class="aos-init aos-animate" data-aos="fade-up">Thống kê Sinh viên nhận Học bổng</h1>
                </div>
            </div>
            <div class="form-search-wrap aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <form action="{{ route('filter_SV') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                            <div class="select-wrap">
                                <span class="icon"><span class="icon-keyboard_arrow_down">Tên Học bổng</span></span>
                                <select class="form-control rounded" name="hocbong_id" id="hocbong_id">
                                    <option value="">--Tên Học Bổng--</option>
                                    @foreach ($dshb as $hb)
                                        <option value="{{ $hb->MaHB }}">{{ $hb->TenHocBong }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="select-wrap">
                                <span class="icon"><span class="icon-keyboard_arrow_down">Khoa</span></span>
                                <select class="form-control rounded" name="tbkhoa_id" id="tbkhoa_id">
                                    <option value="">--Khoa--</option>
                                    @foreach ($khoas as $khoa)
                                        <option value="{{ $khoa->MaKhoa }}">{{ $khoa->TenKhoa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="select-wrap">
                                <span class="icon"><span class="icon-keyboard_arrow_down">Lớp</span></span>
                                <select class="form-control rounded" name="tblop_id" id="tblop_id">
                                    <option value="">--Lớp--</option>
                                    @foreach ($lops as $lop)
                                        <option value="{{ $lop->MaLop }}">{{ $lop->TenLop }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-3">
                            <div class="wrap-icon">
                                <span class="icon icon-room">Số lượng sinh viên</span>
                                <div class="form-control rounded">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="soluongsv" id="inlineRadio1"
                                            value="0">
                                        <label class="form-check-label" for="inlineRadio1">SV đậu học bổng</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="soluongsv" id="inlineRadio2"
                                            value="1" checked>
                                        <label class="form-check-label" for="inlineRadio2">Tất cả đăng ký</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-1">
                            <input type="submit" style="margin-top: 20%;"
                                class="btn btn-primary rounded py-2 px-4 text-white" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div style="display: flex;justify-content: space-between;" class="bg-light text-center rounded p-4">
                <h3 class="mb-0 text-left font-weight text-primary">Kết quả</h3>
                <button class="btn btn-outline-primary rounded-pill" onclick="exportTableToExcel('tableId')">Xuất
                    File</button>
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0" id="tableId">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">STT</th>
                            <th scope="col">Mã Sinh Viên</th>
                            <th scope="col">Khoa</th>
                            <th scope="col">Lớp</th>
                            <th scope="col">Tên Sinh Viên</th>
                            <th scope="col">Ngày Sinh</th>
                            <th scope="col">Giới Tính</th>
                            <th scope="col">Email</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">Địa Chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsSV as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $value->MaSV }}</td>
                                <td>{{ $value->TenKhoa }}</td>
                                <td>{{ $value->TenLop }}</td>
                                <td>{{ $value->TenSV }}</td>
                                <td>{{ $value->NgaySinh }}</td>
                                <td>{{ $value->GioiTinh }}</td>
                                <td>{{ $value->Email }}</td>
                                <td>{{ $value->SDT }}</td>
                                <td>{{ $value->DiaChi }}</td>
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td>01 Jan 2045</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td>INV-0123</td>
                            <td>Jhon Doe</td>
                            <td>$123</td>
                            <td>Paid</td>
                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                        </tr> --}}
                    </tbody>
                </table>
                @empty($value)
                    <p class="empty-text">Không có sinh viên nào.</p>
                @endempty
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>
    <script>
        //Export excel 
        function exportTableToExcel(tableId) {

            const table = document.getElementById(tableId);
            const downloadLink = document.createElement('a');
            const dataType = 'application/vnd.ms-excel';
            const tableHTML = table.outerHTML.replace(/ /g, '%20');


            // Lấy thời gian xuất
            const currentTime = new Date();
            const timestamp = currentTime.getTime();

            // Định dạng thời gian và ngày
            const timeFormat = currentTime.toLocaleTimeString('vi-VN', {
                hour12: false
            }).replace(/:/g, '');
            const dateFormat = currentTime.toLocaleDateString('vi-VN').replace(/\//g, '-');


            // Set the download file name
            filename = 'bao-cao-'+timeFormat+'-'+dateFormat+'.xls';

            // Create download link element
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            downloadLink.download = filename;

            // Trigger the download
            downloadLink.click();
        }
    </script>
@endsection
