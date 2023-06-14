<?php
$DB_TYPE = "mysql";
$DB_HOST = "localhost";
$DB_NAME = "pdo";
$USER_NAME = "root";
$USER_PASSWORD = "";

$connection = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME", $USER_NAME, $USER_PASSWORD);

// Tạo bảng
$stmt = "CREATE TABLE IF NOT EXISTS sinhvien (
    maSV varchar(10) not null PRIMARY key,
    hoTen varchar(50) not null,
    ngaySinh DATE,
    lopHoc VARCHAR(50),
    diemTB float
)";
$result = $connection->exec($stmt);
if ($result === false) {
    die("Create failed: " . $connection->errorInfo());
} else {
    echo "Create success";
}

// Insert
$data = [
    [
        'maSV' => 'SV001',
        'hoTen' => 'Nguyen Van A',
        'ngaySinh' => '2002-05-05',
        'lopHoc' => 'K56SD2',
        'diemTB' => '8.0'
    ],
    [
        'maSV' => 'SV002',
        'hoTen' => 'Nguyen Van B',
        'ngaySinh' => '2002-05-06',
        'lopHoc' => 'K56SD3',
        'diemTB' => '8.8'
    ],
    [
        'maSV' => 'SV003',
        'hoTen' => 'Nguyen Van C',
        'ngaySinh' => '2002-05-07',
        'lopHoc' => 'K56SD2',
        'diemTB' => '8.0'
    ],
    [
        'maSV' => 'SV004',
        'hoTen' => 'Nguyen Van D',
        'ngaySinh' => '2002-05-08',
        'lopHoc' => 'K56SD2',
        'diemTB' => '8.2'
    ],
    [
        'maSV' => 'SV005',
        'hoTen' => 'Nguyen Van E',
        'ngaySinh' => '2002-05-09',
        'lopHoc' => 'K56SD2',
        'diemTB' => '8.5'
    ]
];

$stmt = $connection->prepare('INSERT INTO sinhvien (maSV, hoTen, ngaySinh, lopHoc, diemTB) VALUES (:maSV, :hoTen, :ngaySinh, :lopHoc, :diemTB)');
try{
foreach ($data as $row) {
    $result = $stmt->execute($row);
}
    echo "<br>Insert success";
}
catch (Exception $e)
{
    echo "<br>insert failed" . $e->getMessage();
}
// Update
$stmt = $connection->prepare('UPDATE sinhvien SET diemTB = :diemTB WHERE maSV = :maSV');
$data = [
    'maSV' => 'SV001',
    'diemTB' => 8.5
];

$result = $stmt->execute($data);
if (!$result) {
    die ("<br>Update failed" .  $connection->errorInfo());
} else {
    echo "<br>Update success";
}

// Xóa dữ liệu
$stmt = $connection->prepare('DELETE FROM sinhvien WHERE maSV = :maSV');
$data = [
    'maSV' => 'SV003'
];

$result = $stmt->execute($data);
if (!$result) {
    die ("<br>Delete failed" .  $connection->errorInfo());
} else {
    echo "<br>Delete success";
}

// Select
$stmt = $connection->prepare('SELECT * FROM sinhvien');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

// Hiển thị kết quả
while ($row = $stmt->fetch()) {
    echo "<br>";
    echo 'Mã SV: ' . $row['maSV'] . '<br>';
    echo 'Họ Tên: ' . $row['hoTen'] . '<br>';
    echo 'Ngày Sinh: ' . $row['ngaySinh'] . '<br>';
    echo 'Lớp học: ' . $row['lopHoc'] . '<br>';
    echo 'Điểm TB: ' . $row['diemTB'] . '<br>';
}
?>
