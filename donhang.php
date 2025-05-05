<?php
include "connect.php";

$sdt = $_POST['sdt'];
$email = $_POST['email'];
$tongtien = $_POST['tongtien'];
$iduser = $_POST['iduser'];
$diachi = $_POST['diachi'];
$soluong = $_POST['soluong'];
$chitiet = $_POST['chitiet'];

$query = 'INSERT INTO `donhang` (`iduser`, `diachi`, `sodienthoai`, `email`, `soluong`, `tongtien`) 
          VALUES (' . $iduser . ',"' . $diachi . '","' . $sdt . '","' . $email . '",' . $soluong . ',' . $tongtien . ')';

$data = mysqli_query($conn, $query);

if ($data == true) {
    $query = 'SELECT id AS iddonhang FROM `donhang` WHERE `iduser` = ' . $iduser . ' ORDER BY id DESC LIMIT 1';
    $data = mysqli_query($conn, $query);

    $iddonhang = null;
    while ($row = mysqli_fetch_assoc($data)) {
        $iddonhang = $row['iddonhang'];
    }

    if (!empty($iddonhang)) {
        $chitiet = json_decode($chitiet, true);
        $success_all = true;

        foreach ($chitiet as $key => $value) {
            $truyvan = 'INSERT INTO `chitietdonhang` (`iddonhang`, `idsp`, `soluong`, `gia`, `ngaymua`) 
            VALUES (' . $iddonhang . ',' . $value['idsp'] . ',' . $value['soluong'] . ',' . $value['giasp'] . ', NOW())';

            $insert = mysqli_query($conn, $truyvan);

            if (!$insert) {
                $success_all = false;
                break;
            }
        }

        if ($success_all) {
            $arr = [
                'success' => true,
                'message' => "thanh cong"
            ];
        } else {
            $arr = [
                'success' => false,
                'message' => "Lỗi khi thêm chi tiết đơn hàng"
            ];
        }
    } else {
        $arr = [
            'success' => false,
            'message' => "Không lấy được ID đơn hàng"
        ];
    }
} else {
    $arr = [
        'success' => false,
        'message' => "Lỗi khi tạo đơn hàng"
    ];
}

echo json_encode($arr);
?>
