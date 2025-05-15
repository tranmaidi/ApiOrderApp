<?php
include "connect.php";

$id = $_POST['id'];           
$username = $_POST['username'];
$mobile = $_POST['mobile'];

// Câu lệnh update user
$query = 'UPDATE `user` SET `username`="'.$username.'",`mobile`="'.$mobile.'" WHERE `id`=' .$id;
$data = mysqli_query($conn, $query);
if ($data) {
    $arr = [
        'success' => true,
        'message' => 'Cập nhật thành công',
    ];
    
} else {
    $arr = [
        'success' => false,
        'message' => 'Cập nhật thất bại',
    ];
}


print_r(json_encode($arr));
?>