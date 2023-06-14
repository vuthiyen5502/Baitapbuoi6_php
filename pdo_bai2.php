<?php
$DB_TYPE = "mysql";
$DB_HOST = "localhost";
$DB_NAME = "pdo";
$USER_NAME = "root";
$USER_PASSWORD = "";

$connection = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME", $USER_NAME, $USER_PASSWORD);

// Tạo bảng
$stmt = "CREATE TABLE IF NOT EXISTS lichsugiaodich (
    ID int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    maGD varchar(10) not null ,
    ngayGD date,
    loaiGD varchar(50),
    soTien decimal(10,2),
    moTa text
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
        'maGD' => 'GD001',
        'ngayGD' => '2023-07-05',
        'loaiGD' => 'Rút tiền',
        'soTien' => '500',
        'moTa' =>'Rút tiền ATM'
    ],
    [
        'maGD' => 'GD002',
        'ngayGD' => '2023-05-05',
        'loaiGD' => 'Nạp tiền',
        'soTien' => '200',
        'moTa' =>'Nạp tiền ATM'
    ],
    [
        'maGD' => 'GD003',
        'ngayGD' => '2023-09-05',
        'loaiGD' => 'Rút tiền',
        'soTien' => '500',
        'moTa' =>'Rút tiền ATM'
    ],
    [
        'maGD' => 'GD004',
        'ngayGD' => '2023-07-06',
        'loaiGD' => 'Nạp tiền',
        'soTien' => '100',
        'moTa' =>'Nạp tiền ATM'
    ],
    [
        'maGD' => 'GD005',
        'ngayGD' => '2023-07-07',
        'loaiGD' => 'Rút tiền',
        'soTien' => '400',
        'moTa' =>'Rút tiền ATM'
    ]
];

$stmt = $connection->prepare('INSERT INTO lichsugiaodich (maGD, ngayGD, loaiGD, soTien, moTa) VALUES (:maGD, :ngayGD, :loaiGD, :soTien, :moTa)');
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
$stmt = $connection->prepare('UPDATE lichsugiaodich SET soTien = :soTien WHERE ID = :ID');
$data = [
    'soTien' => '1000',
    'ID' => '3'
];

$result = $stmt->execute($data);
if (!$result) {
    die ("<br>Update failed" .  $connection->errorInfo());
} else {
    echo "<br>Update success";
}

// Xóa dữ liệu
$stmt = $connection->prepare('DELETE FROM lichsugiaodich WHERE ID = :ID');
$data = [
    'ID' => '5'
];

$result = $stmt->execute($data);
if (!$result) {
    die ("<br>Delete failed" .  $connection->errorInfo());
} else {
    echo "<br>Delete success";
}

// Select
$stmt = $connection->prepare('SELECT * FROM lichsugiaodich');
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();

// Hiển thị kết quả
while ($row = $stmt->fetch()) {
    echo "<br>";
    echo 'Mã GD: ' . $row['maGD'] . '<br>';
    echo 'Ngày GD: ' . $row['ngayGD'] . '<br>';
    echo 'Loại GD: ' . $row['loaiGD'] . '<br>';
    echo 'Số tiền: ' . $row['soTien'] . '<br>';
    echo 'Mô tả: ' . $row['moTa'] . '<br>';
}
?>
