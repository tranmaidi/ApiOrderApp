<?php
include "connect.php";
$iduser = $_POST['iduser'];

$query = 'SELECT * FROM `donhang` WHERE `iduser` = '.$iduser.' ORDER BY id DESC';
$data = mysqli_query($conn, $query);
$result = array();

while ($row = mysqli_fetch_assoc($data)) {
    $truyvan = 'SELECT * FROM `chitietdonhang` 
                INNER JOIN sanphammoi ON chitietdonhang.idsp = sanphammoi.id 
                WHERE chitietdonhang.iddonhang = '.$row['id'];
    $data1 = mysqli_query($conn, $truyvan);
    $item = array();
    $ngaymua = ""; // Khởi tạo biến ngày mua

    while ($row1 = mysqli_fetch_assoc($data1)) {
        if ($ngaymua == "") {
            $ngaymua = $row1['ngaymua']; // Lấy ngày mua từ dòng đầu tiên
        }
        $item[] = $row1;
    }

    $row['ngaymua'] = $ngaymua; // Gán ngày mua vào đơn hàng
    $row['item'] = $item;
    $result[] = $row;
}

if (!empty($result)) {
    $arr = [
        'success' => true,
        'message' => "thanh cong",
        'result' => $result
    ];
} else {
    $arr = [
        'success' => false,
        'message' => "khong thanh cong",
        'result' => $result
    ];
}
print_r(json_encode($arr));
?>
