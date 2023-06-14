<?php
$servername = "localhost";
$database = "sd_sqli";
$username = "root";
$password = "";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
    die("Kết nối thất bại" . mysqli_error($connection));
}
if (!mysqli_select_db($connection, $database)) {
    die("Không tìm thấy database" . mysqli_error($connection));
}

// Create table
$sql_stmt = "CREATE TABLE IF NOT EXISTS sinhvien (
  maSV varchar(10) not null PRIMARY key,
  hoTen varchar(50) not null,
  ngaySinh DATE,
  lopHoc VARCHAR(50),
  diemTB float
);";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
   die("Create failed" . mysqli_error($connection));
} else {
   echo "Create success";
}

// Insert new data
$sql_stmt = "INSERT INTO sinhvien (maSV, hoTen, ngaySinh, lopHoc, diemTB)
                             VALUES ('SV001', 'Nguyen Van A', '2002-05-05', 'K56SD2', 8.0),
                             ('SV002', 'Nguyen Van B', '2002-05-06', 'K56SD3', 8.8),
                             ('SV003', 'Nguyen Van C', '2002-05-07', 'K56SD2', 8.0),
                             ('SV004', 'Nguyen Van D', '2002-05-08', 'K56SD2', 8.2),
                             ('SV005', 'Nguyen Van E', '2002-05-09', 'K56SD2', 8.5)";
$result = mysqli_query($connection, $sql_stmt);

if (!$result) {
    die("<br> Thêm thất bại: " . mysqli_error($connection));
} else {
    echo "<br> Thêm thành công";
}

// Update
$sql_stmt = "UPDATE sinhvien SET diemTB = 8.5 WHERE maSV = 'SV001'";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
    die("<br> Cập nhật thất bại: " . mysqli_error($connection));
} else {
    echo "<br> Cập nhật thành công";
}
//Delete
$sql_stmt = "DELETE FROM sinhvien WHERE maSV = 'SV003'";
$result = mysqli_query($connection, $sql_stmt);
if (!$result){
    die("<br> Xóa thất bại:" . mysqli_error($connection));
} else {
    echo "<br> Xóa thành công";
}
// Select
$sql_stmt = "SELECT * FROM sinhvien";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
    die("<br> Lỗi khi thực hiện truy vấn: " . mysqli_error($connection));
}

$rows = mysqli_num_rows($result);

if ($rows) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<br>";
        echo 'Mã SV: ' . $row['maSV'] . '<br>';
        echo 'Họ Tên: ' . $row['hoTen'] . '<br>';
        echo 'Ngày Sinh: ' . $row['ngaySinh'] . '<br>';
        echo 'Lớp học: ' . $row['lopHoc'] . '<br>';
        echo 'Điểm TB: ' . $row['diemTB'] . '<br>';
    }
}

mysqli_close($connection);
?>
