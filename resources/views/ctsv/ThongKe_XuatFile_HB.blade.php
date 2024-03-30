@extends('ctsv.layout.master')

@section('title', 'Thống Kê Học Bổng')
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
        footer {
            margin-top: 3% !important;
        }
    </style>
    <div class="container">
        <div class="title col-md-12">
            <div class="row justify-content-center mb-4">
                <div class="col-md-8 text-center">
                    <h1 class="aos-init aos-animate" data-aos="fade-up">Thống kê theo Học bổng</h1>
                </div>
            </div>
            <div class="form-search-wrap aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                <form action="{{ route('Thongke_HB_search') }}" method="post">
                    @csrf
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="select-wrap">
                                <span class="icon"><span class="icon-keyboard_arrow_down">Cán bộ đăng bài</span></span>
                                <select class="form-control rounded" name="canbo">
                                    <option value="">Tất cả</option>
                                    @foreach ($canbos as $cb)
                                        <option value="{{ $cb->MaCanBo }}">{{ $cb->HoTen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="wrap-icon">
                                <span class="icon icon-room">Ngày bắt đầu</span>
                                <input type="date" class="form-control rounded" placeholder="Ngày bắt đầu"
                                    name="start">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="wrap-icon">
                                <span class="icon icon-room">Ngày kết thúc</span>
                                <input type="date" class="form-control rounded" placeholder="Ngày kết thúc"
                                    name="end">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="select-wrap">
                                <span class="icon"><span class="icon-keyboard_arrow_down">Nhà tài trợ</span></span>
                                <select class="form-control rounded" name="nhataitro">
                                    <option value="">Tất cả</option>
                                    @foreach ($nhataitros as $ntt)
                                        <option value="{{ $ntt->NhaTaiTro }}">{{ $ntt->NhaTaiTro }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4 mb-xl-0 col-xl-2">
                            <div class="wrap-icon">
                                <span class="icon icon-room">Tìm kiếm</span>
                                <input type="text" class="form-control rounded" name="search"
                                    placeholder="Nhập học bổng cần tìm">
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <input type="submit" style="width: 50%;" class="btn btn-primary rounded py-2 px-4 text-white"
                                value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div style="display: flex;justify-content: space-between;" class="bg-light text-center rounded p-4">
                <h3 class="mb-0 text-left font-weight text-primary">Kết quả</h3>
                <!-- Add this button or link wherever appropriate -->
                <button class="btn btn-outline-primary rounded-pill"
                    onclick="exportTableToExcel('tableId', 'filename')">Export Excel</button>
            </div>
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table id="tableId" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col" class="sortable">Mã HB
                                <span class="sort-icon">
                                    <i class="fas fa-sort"></i>
                                </span>
                            </th>
                            <th scope="col" class="sortable">Tên Học Bổng
                                <span class="sort-icon">
                                    <i class="fas fa-sort"></i>
                                </span>
                            </th>
                            <th scope="col" class="sortable">Số suất
                                <span class="sort-icon">
                                    <i class="fas fa-sort"></i>
                                </span>
                            </th>
                            <th scope="col" class="sortable">Ngày bắt đầu
                                <span class="sort-icon">
                                    <i class="fas fa-sort"></i>
                                </span>
                            </th>
                            <th scope="col" class="sortable">Ngày kết thúc
                                <span class="sort-icon">
                                    <i class="fas fa-sort"></i>
                                </span>
                            </th>
                            <th scope="col">Đối tượng</th>
                            <th scope="col">Nhà tài trợ</th>
                            <th scope="col">Tiêu chí</th>
                            <th scope="col">Mô tả</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hocbongs as $hocbong)
                            <tr>
                                <td>{{ $hocbong->MaHB }}</td>
                                <td>{{ $hocbong->TenHocBong }}</td>
                                <td>{{ $hocbong->SoLuongThamGia }}</td>
                                <td>{{ $hocbong->NgayBatDau }}</td>
                                <td>{{ $hocbong->NgayKetThuc }}</td>
                                <td>{{ $hocbong->DoiTuong }}</td>
                                <td>{{ $hocbong->NhaTaiTro }}</td>
                                <td>{{ $hocbong->TieuChi }}</td>
                                <td>{{ $hocbong->MoTa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @empty($hocbong)
                    <p class="empty-text">Không có học bổng nào.</p>
                @endempty
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/c38e569116.js" crossorigin="anonymous"></script>
    <!-- <script src="https://unpkg.com/tabletoexcel/dist/tableToExcel.min.js"></script> -->

    <script>
        $(document).ready(function() {
            $('.sortable').click(function() {
                var table = $(this).parents('table').eq(0);
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()));
                this.asc = !this.asc;
                if (!this.asc) {
                    rows = rows.reverse();
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i]);
                }
            });

            function comparer(index) {
                return function(a, b) {
                    var valA = getCellValue(a, index);
                    var valB = getCellValue(b, index);
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(
                        valB);
                };
            }

            function getCellValue(row, index) {
                return $(row).children('td').eq(index).text();
            }
        });
        //Export excel 
        function exportTableToExcel(tableId, filename = '') {
            const downloadLink = document.createElement('a');
            const dataType = 'application/vnd.ms-excel';
            const table = document.getElementById(tableId);
            const tableHTML = table.outerHTML.replace(/ /g, '%20');

            // Set the download file name
            filename = filename ? filename + '.xls' : 'export.xls';

            // Create download link element
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            downloadLink.download = filename;

            // Trigger the download
            downloadLink.click();
        }
    </script>

@endsection
