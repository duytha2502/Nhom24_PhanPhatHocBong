DROP DATABASE IF EXISTS CapPhatHocBong;
CREATE DATABASE CapPhatHocBong; 
USE    CapPhatHocBong;
    -- Tạo table
CREATE TABLE tbKhoa(
    MaKhoa VARCHAR(7) NOT NULL PRIMARY KEY,
    TenKhoa VARCHAR(50) NOT NULL
); 
CREATE TABLE tbLop(
    MaLop VARCHAR(7) NOT NULL PRIMARY KEY,
    TenLop VARCHAR(50) NOT NULL,
    MaKhoa VARCHAR(7) NOT NULL
); 
CREATE TABLE tbSinhVien(
    MaSV CHAR(13) NOT NULL PRIMARY KEY,
    TenSV VARCHAR(50) NOT NULL,
    NgaySinh DATE NOT NULL,
    GioiTinh VARCHAR(3) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    SDT CHAR(10) NOT NULL,
    DiaChi VARCHAR(50) NOT NULL,
    MatKhau VARCHAR(20) NOT NULL,
    MaLop VARCHAR(7) NOT NULL
); 
CREATE TABLE tbPhanHoi(
    MaPhanHoi int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    MaSV VARCHAR(13) NOT NULL,
    NoiDung TEXT,
    ThoiGian DATETIME
    
); 
CREATE TABLE tbPhongCTSV(
    MaCanBo CHAR(10) NOT NULL PRIMARY KEY,
    HoTen VARCHAR(50) NOT NULL,
    GioiTinh VARCHAR(3) NOT NULL,
    SDT CHAR(10) NOT NULL,
    DiaChi VARCHAR(50) NOT NULL,
    Email VARCHAR(30) NOT NULL,
    MatKhau VARCHAR(20) NOT NULL
); 
CREATE TABLE tbHocBong(
    MaHB int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    MaCanBo CHAR(10) NOT NULL,
    TenHocBong VARCHAR(50) NOT NULL,
    SoLuongThamGia INT NOT NULL,
    NgayBatDau DATE NOT NULL,
    NgayKetThuc DATE NOT NULL,
    NgayDangBai DATETIME NOT NULL,
    DoiTuong TEXT NOT NULL,
    NhaTaiTro TEXT NOT NULL,
    TieuChi TEXT NOT NULL,
    MoTa TEXT,
    Anh VARCHAR(255)
); 
CREATE TABLE tbPhieuDangKy(
    MaPhieu int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    MaHB int NOT NULL,
    MaSV CHAR(13) NOT NULL,
    TinhTrang INT DEFAULT -1,
    NgayDangKy DATETIME
);
CREATE TABLE tbAnh(
    MaAnh int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    MaPhieu int NOT NULL,
    AnhMinhChung VARCHAR(255)
);
CREATE TABLE tbPheDuyetPhieuDangKy(
    MaPhieu int NOT NULL,
    MaCanBo CHAR(10) NOT NULL,
    Diem Float,
    PRIMARY KEY(MaCanBo, MaPhieu)
);
-- Ràng buộc khóa ngoại
alter table tbLop add constraint Fk_tbLop_MaKhoa foreign key (MaKhoa) references tbKhoa(MaKhoa) on delete cascade on update cascade;
alter table tbSinhVien add constraint Fk_tbSinhVien_MaLop foreign key (MaLop) references tbLop(MaLop) on delete cascade on update cascade;
alter table tbPhanHoi add constraint Fk_tbPhanHoi_MaSV foreign key (MaSV) references tbSinhVien(MaSV) on delete cascade on update cascade;
alter table tbHocBong add constraint Fk_tbHocBong_MaCanBo foreign key (MaCanBo) references tbPhongCTSV(MaCanBo) on delete cascade on update cascade;
alter table tbPhieuDangKy add constraint Fk_tbPhieuDangKy_MaHB foreign key (MaHB) references tbHocBong(MaHB) on delete cascade on update cascade;
alter table tbPhieuDangKy add constraint Fk_tbPhieuDangKy_MaSV foreign key (MaSV) references tbSinhVien(MaSV) on delete cascade on update cascade;
alter table tbAnh add constraint Fk_tbAnh_MaPhieu foreign key (MaPhieu) references tbPhieuDangKy(MaPhieu) on delete cascade on update cascade;
alter table tbPheDuyetPhieuDangKy add constraint Fk_tbPheDuyetPhieuDangKy_MaPhieu foreign key (MaPhieu) references tbPhieuDangKy(MaPhieu) on delete cascade on update cascade;
alter table tbPheDuyetPhieuDangKy add constraint Fk_tbPheDuyetPhieuDangKy_MaCanBo foreign key (MaCanBo) references tbPhongCTSV(MaCanBo) on delete cascade on update cascade;
-- Rang Buoc cac Truong
ALTER TABLE tbPhieuDangKy ADD CONSTRAINT check_tbPhieuDangKy_TinhTrang CHECK (TinhTrang IN (-1, 1, 0));
ALTER TABLE tbSinhVien ADD CONSTRAINT check_tbSinhVien_GioiTinh CHECK (GioiTinh IN ('Nữ', 'Nam'));
ALTER TABLE tbSinhVien ADD CONSTRAINT check_tbSinhVien_Email CHECK (Email LIKE '%@%');
ALTER TABLE tbSinhVien ADD CONSTRAINT check_tbSinhVien_SDT CHECK (SDT REGEXP '[0-9]{10}');
ALTER TABLE tbPhongCTSV ADD CONSTRAINT check_tbPhongCTSV_GioiTinh CHECK (GioiTinh IN ('Nữ', 'Nam'));
ALTER TABLE tbPhongCTSV ADD CONSTRAINT check_tbPhongCTSV_Email CHECK (Email LIKE '%@%');
ALTER TABLE tbPhongCTSV ADD CONSTRAINT check_tbPhongCTSV_SDT CHECK (SDT REGEXP '[0-9]{10}');
ALTER TABLE tbHocBong ADD CONSTRAINT check_tbHocBong_date CHECK (NgayBatDau < NgayKetThuc);
ALTER TABLE tbPheDuyetPhieuDangKy ADD CONSTRAINT check_tbPheDuyetPhieuDangKy_diem CHECK ( Diem >=0 and Diem <= 10);
-- TRIGGER
-- Không được phép xoá Khoa
DROP TRIGGER IF EXISTS trg_deleteKhoa;
DELIMITER $$
CREATE TRIGGER trg_deleteKhoa
AFTER DELETE ON tbKhoa
FOR EACH ROW
BEGIN
IF (SELECT COUNT(*) FROM deleted) > 0 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số khoa là cố định, không thể xóa.';
END IF;
END$$
DELIMITER ;
-- Kiểm tra Sinh viên phải lớn hơn 18 tuổi
DROP TRIGGER IF EXISTS trg_tuoiSinhVien;
DELIMITER $$
CREATE TRIGGER trg_tuoiSinhVien
AFTER INSERT ON tbSinhVien
FOR EACH ROW
BEGIN
    DECLARE tuoi INT;
    SELECT DATEDIFF(CURDATE(), NEW.ngaySinh) INTO tuoi;

    IF tuoi < 18 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tuổi của sinh viên không hợp lệ, phải lớn hơn 18 tuổi';
    END IF;
END$$
DELIMITER ;
-- Số điện thoại, Email của sinh viên là duy nhất
DROP TRIGGER IF EXISTS trg_tbSinhVien_insert;
DELIMITER $$
CREATE TRIGGER trg_tbSinhVien_insert
AFTER INSERT ON tbSinhVien
FOR EACH ROW
BEGIN
    DECLARE MaSV CHAR(13);
    DECLARE sodt CHAR(10);
    DECLARE mail VARCHAR(30);
    SET MaSV = NEW.MaSV;
    SET sodt = NEW.SDT;
    SET mail = NEW.Email;

    -- Kiểm tra số điện thoại duy nhất
    IF((SELECT COUNT(*) FROM tbSinhVien WHERE SDT = sodt AND MaSV != MaSV) > 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số điện thoại này đã tồn tại!';
    END IF;

    -- Kiểm tra email duy nhất
    IF((SELECT COUNT(*) FROM tbSinhVien WHERE Email = mail AND MaSV != MaSV) > 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email này đã tồn tại!';
    END IF;
END$$
DELIMITER ;
-- Số điện thoại, Email của sinh viên là duy nhất
DROP TRIGGER IF EXISTS trg_tbSinhVien_update;
DELIMITER $$
CREATE TRIGGER trg_tbSinhVien_update
AFTER UPDATE
ON tbSinhVien
FOR EACH ROW
BEGIN
    DECLARE MaSV CHAR(13);
    DECLARE sodt CHAR(10);
    DECLARE mail VARCHAR(30);
    SET MaSV = NEW.MaSV;
    SET sodt = NEW.SDT;
    SET mail = NEW.Email;

    -- Kiểm tra số điện thoại duy nhất
    IF((SELECT COUNT(*) FROM tbSinhVien WHERE SDT = sodt AND MaSV != MaSV) > 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số điện thoại này đã tồn tại!';
    END IF;

    -- Kiểm tra email duy nhất
    IF((SELECT COUNT(*) FROM tbSinhVien WHERE Email = mail AND MaSV != MaSV) > 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email này đã tồn tại!';
    END IF;
END$$
DELIMITER ;
-- Số điện thoại, Email của Cán bộ là duy nhất
DROP TRIGGER IF EXISTS trg_tbPhongCTSV_update;
DELIMITER $$
CREATE TRIGGER trg_tbPhongCTSV_update
AFTER UPDATE ON tbPhongCTSV
FOR EACH ROW
BEGIN
DECLARE MaCB CHAR(10);
DECLARE sodt CHAR(10);
DECLARE mail VARCHAR(30);
SET MaCB = NEW.MaCanBo;
SET sodt = NEW.SDT;
SET mail = NEW.Email;

-- Kiểm tra số điện thoại duy nhất
IF((SELECT COUNT(MaCB) FROM tbPhongCTSV WHERE SDT = sodt) > 1) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số điện thoại này đã tồn tại!';
END IF;

-- Kiểm tra email duy nhất
IF((SELECT COUNT(MaCB) FROM tbPhongCTSV WHERE Email = mail) > 1) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email này đã tồn tại!';
END IF;
END$$
DELIMITER ;
-- Số điện thoại, Email của Cán bộ là duy nhất
DROP TRIGGER IF EXISTS trg_tbPhongCTSV_insert;
DELIMITER $$
CREATE TRIGGER trg_tbPhongCTSV_insert
AFTER INSERT ON tbPhongCTSV
FOR EACH ROW
BEGIN
DECLARE MaCB CHAR(10);
DECLARE sodt CHAR(10);
DECLARE mail VARCHAR(30);
SET MaCB = NEW.MaCanBo;
SET sodt = NEW.SDT;
SET mail = NEW.Email;

-- Kiểm tra số điện thoại duy nhất
IF((SELECT COUNT(MaCB) FROM tbPhongCTSV WHERE SDT = sodt) > 1) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Số điện thoại này đã tồn tại!';
END IF;

-- Kiểm tra email duy nhất
IF((SELECT COUNT(MaCB) FROM tbPhongCTSV WHERE Email = mail) > 1) THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Email này đã tồn tại!';
END IF;
END$$
DELIMITER ;
-- Insert data
-- Thêm dữ liệu cho bảng Khoa
INSERT INTO tbKhoa (MaKhoa, TenKhoa)
VALUES ('CNTT', 'Công nghệ thông tin'),
       ('QT', 'Quản trị kinh doanh'),
       ('KHTN', 'Khoa học tự nhiên'),
       ('KT', 'Kỹ thuật'),
       ('NN', 'Ngoại ngữ');

-- Thêm dữ liệu cho bảng Lop
INSERT INTO tbLop (MaLop, MaKhoa, TenLop)
VALUES ('CNTT01', 'CNTT', 'Công nghệ thông tin 01'),
       ('CNTT02', 'CNTT', 'Công nghệ thông tin 02'),
       ('QT01', 'QT', 'Quản trị kinh doanh 01'),
       ('QT02', 'QT', 'Quản trị kinh doanh 02'),
       ('KHTN01', 'KHTN', 'Khoa học tự nhiên 01'),
       ('KHTN02', 'KHTN', 'Khoa học tự nhiên 02'),
       ('KT01', 'KT', 'Kỹ thuật 01'),
       ('KT02', 'KT', 'Kỹ thuật 02'),
       ('NN01', 'NN', 'Ngoại ngữ 01'),
       ('NN02', 'NN', 'Ngoại ngữ 02');

-- Thêm dữ liệu cho bảng SinhVien
INSERT INTO tbSinhVien (MaSV, TenSV, NgaySinh, GioiTinh, Email, SDT, DiaChi, MaLop, MatKhau)
VALUES ('2050531200258', 'Nguyễn Văn A', '2000-01-01', 'Nam', 'nguyenvana@gmail.com', '0987654321', 'Hà Nội', 'CNTT01', '123456'),
       ('2050531200259', 'Trần Thị B', '2000-02-01', 'Nữ', 'tranthib@gmail.com', '0987654322', 'Hải Phòng', 'CNTT01', '123456'),
       ('2050531200260', 'Lê Văn C', '2000-03-01', 'Nam', 'levanc@gmail.com', '0987654323', 'Nghệ An', 'QT01', '123456'),
       ('2050531200261', 'Phạm Thị D', '2000-04-01', 'Nữ', 'phamthid@gmail.com', '0987654324', 'Bắc Ninh', 'QT01', '123456'),
       ('2050531200262', 'Hoàng Văn E', '2000-05-01', 'Nam', 'hoangvane@gmail.com', '0987654325', 'Hà Tây', 'KHTN01', '123456');
-- Thêm dữ liệu cho bảng PhanHoi
INSERT INTO tbPhanHoi (MaSV, NoiDung, ThoiGian)
VALUES ('2050531200258', 'Phản hồi của sinh viên 1', '2023-04-25 10:00:00'),
	('2050531200259', 'Phản hồi của sinh viên 2', '2023-04-25 11:00:00'),
	('2050531200260', 'Phản hồi của sinh viên 3', '2023-04-25 12:00:00');
-- Thêm dữ liệu cho bảng Phong CTSV
INSERT INTO tbPhongCTSV (MaCanBo, HoTen, GioiTinh, SDT, DiaChi, Email, MatKhau)
VALUES ('1111111111', 'Nguyễn Văn A', 'Nam', '0987654321', 'Hà Nội', 'nguyenvana@gmail.com', 'admin'),
	('1111111112', 'Trần Thị B', 'Nữ', '0123456789', 'Hồ Chí Minh', 'tranthib@gmail.com', 'admin'),
	('1111111113', 'Lê Văn C', 'Nam', '0987654322', 'Đà Nẵng', 'levanc@gmail.com', 'admin');
-- Thêm dữ liệu cho bảng HocBong
INSERT INTO tbHocBong (MaCanBo, TenHocBong, SoLuongThamGia, NgayBatDau, NgayKetThuc, NgayDangBai, DoiTuong, NhaTaiTro, TieuChi, MoTa, Anh) 
VALUES 
('1111111111', 'Học bổng A', 50, '2023-05-01', '2023-06-30', '2023-04-30', 'Sinh viên năm 2 trở lên', 'Công ty ABC', 'Học tập giỏi, có hoàn cảnh khó khăn', 'Học bổng dành cho các sinh viên có thành tích học tập tốt, hoàn cảnh khó khăn', '/image/scholarship1.svg'),
('1111111111', 'Học bổng B', 30, '2023-07-01', '2023-08-31', '2023-06-30', 'Sinh viên có thành tích học tập tốt', 'Công ty XYZ', 'Học tập giỏi', 'Học bổng dành cho các sinh viên có thành tích học tập tốt', '/image/scholarship1.svg'),
('1111111112', 'Học bổng C', 20, '2023-06-01', '2023-07-31', '2023-05-31', 'Sinh viên năm 3 trở lên', 'Tập đoàn MNP', 'Học tập giỏi', 'Học bổng dành cho các sinh viên có thành tích học tập tốt', '/image/scholarship1.svg'),
('1111111112', 'Học bổng D', 40, '2023-08-01', '2023-09-30', '2023-07-31', 'Sinh viên có hoàn cảnh khó khăn', 'Công ty KLM', 'Học tập giỏi, có hoàn cảnh khó khăn', 'Học bổng dành cho các sinh viên có hoàn cảnh khó khăn, có thành tích học tập tốt', '/image/scholarship1.svg'),
('1111111113', 'Học bổng E', 10, '2023-09-01', '2023-10-31', '2023-08-31', 'Sinh viên có hoàn cảnh khó khăn', 'Công ty PQR', 'Học tập giỏi, có hoàn cảnh khó khăn', 'Học bổng dành cho các sinh viên có hoàn cảnh khó khăn, có thành tích học tập tốt', '/image/scholarship1.svg');
-- Thêm dữ liệu cho bảng Phiếu đăng ký
INSERT INTO tbPhieuDangKy (MaHB, MaSV,TinhTrang, NgayDangKy)
VALUES
('1', '2050531200258', DEFAULT,'2023-05-05'),
('2', '2050531200259', DEFAULT,'2023-07-04'),
('3', '2050531200260', DEFAULT,'2023-06-07'),
('4', '2050531200261', DEFAULT,'2023-08-03'),
('5', '2050531200262', DEFAULT,'2023-09-08');
-- Thêm dữ liệu cho bảng Phiếu đăng ký
INSERT INTO tbAnh (MaPhieu, AnhMinhChung)
VALUES
('1','https://media.tinmoi.vn/2014/08/30/bangdiem.jpg'),
('1','https://laizhongliuxue.com/wp-content/uploads/2020/05/0ad6c8e0b2de488011cf-1107x800.jpg'),
('2','https://kenh14cdn.com/2018/11/10/1-1541849126604148339853.jpg'),
('2','https://accgroup.vn/wp-content/uploads/2022/02/image-55.png'),
('3','https://media.doisongphapluat.com/602/2019/7/23/trao-bang-gioi-roi-thu-lai-phat-bang-kha-1.jpg'),
('3','https://free.vector6.com/wp-content/uploads/2020/09/free-000686-mau-chung-chi-dep-vector.jpg'),
('4','https://photo-cms-giaoduc.epicdn.me/w700/Uploaded/2023/bpcgtqvp/2021_05_19/1-5571.jpg'),
('4','https://indecalnhanh.net/wp-content/uploads/2022/06/3-3.png'),
('5','https://www.udn.vn/app/webroot/upload/images/0001(7).jpg'),
('5','https://inducdung.vn/wp-content/uploads/2021/03/chung-chi-certificate-1-1.jpg');


