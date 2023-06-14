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
$sql_stmt = "CREATE TABLE IF NOT EXISTS lichsugiaodich (
  ID int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  maGD varchar(10) not null ,
  ngayGD date,
  loaiGD varchar(50),
  soTien decimal(10,2),
  moTa text
);";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
   die("Create failed" . mysqli_error($connection));
} else {
   echo "Create success";
}

// Insert new data
$sql_stmt = "INSERT INTO lichsugiaodich (ID, maGD, ngayGD, loaiGD, soTien, moTa)
                             VALUES ('1', 'GD001', '2023-07-05', 'Rút tiền', 500, 'Rút tiền ATM'),
                             ('2', 'GD002', '2023-05-05', 'Nạp tiền', 200, 'Nạp tiền ATM'),
                             ('3', 'GD003', '2023-09-05', 'Rút tiền', 500, 'Rút tiền ATM'),
                             ('4', 'GD004', '2023-07-06', 'Nạp tiền', 100, 'Nạp tiền ATM'),
                             ('5', 'GD005', '2023-07-07', 'Rút tiền', 400, 'Rút tiền ATM')";
$result = mysqli_query($connection, $sql_stmt);

if (!$result) {
    die("Thêm thất bại: " . mysqli_error($connection));
} else {
    echo "<br> Thêm thành công";
}

// Update
$sql_stmt = "UPDATE lichsugiaodich SET soTien = 1000 WHERE ID = '3'";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
    die("<br> Cập nhật thất bại: " . mysqli_error($connection));
} else {
    echo "<br> Cập nhật thành công";
}
//Delete
$sql_stmt = "DELETE FROM lichsugiaodich WHERE ID = '5'";
$result = mysqli_query($connection, $sql_stmt);
if (!$result){
    die("<br> Xóa thất bại:" . mysqli_error($connection));
} else {
    echo "<br> Xóa thành công";
}
// Select
$sql_stmt = "SELECT * FROM lichsugiaodich";
$result = mysqli_query($connection, $sql_stmt);
if (!$result) {
    die("Lỗi khi thực hiện truy vấn: " . mysqli_error($connection));
}

$rows = mysqli_num_rows($result);

if ($rows) {
    while ($row = mysqli_fetch_array($result)) {
        echo '<br>';
        echo 'ID: ' . $row['ID'] . '<br>';
        echo 'Mã GD: ' . $row['maGD'] . '<br>';
        echo 'Ngày GD: ' . $row['ngayGD'] . '<br>';
        echo 'Loại GD: ' . $row['loaiGD'] . '<br>';
        echo 'Số tiền: ' . $row['soTien'] . '<br>';
        echo 'Mô tả: ' . $row['moTa'] . '<br><br>';
    }
}

mysqli_close($connection);
?>
