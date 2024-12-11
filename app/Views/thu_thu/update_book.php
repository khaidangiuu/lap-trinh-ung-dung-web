<?php
require_once '../../Controllers/BookController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $ten_sach = $_POST['ten_sach'] ?? '';
    $tac_gia = $_POST['tac_gia'] ?? '';
    $nha_xuat_ban = $_POST['nha_xuat_ban'] ?? '';
    $nam_xuat_ban = $_POST['nam_xuat_ban'] ?? '';
    $the_loai = $_POST['the_loai'] ?? '';
    $so_luong = $_POST['so_luong'] ?? '';
    $anh = $_POST['anh'] ?? '';

    $bookController = new BookController();

    try {
        $result = $bookController->updateBook($id, $ten_sach, $anh, $tac_gia, $nha_xuat_ban, $nam_xuat_ban, $the_loai, $so_luong);
        header('Location: quan_ly_sach.php');
        exit;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Phương thức không hợp lệ.";
}
?>