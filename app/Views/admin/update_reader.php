<?php
require_once '../../Controllers/ReaderController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'] ?? '';
    $ho_ten = $_POST['ten'] ?? '';
    $ngay_sinh = $_POST['ngay_sinh'] ?? '';
    $khoa_hoc = $_POST['khoa_hoc'] ?? '';
    $khoa_cn = $_POST['khoa_cn'] ?? '';
    $anh = $_POST['anh'] ?? '';

    // Khởi tạo controller
    $readerController = new ReaderController();

    try {
        // Gọi hàm cập nhật thông tin độc giả
        $result = $readerController->updateProfileReader($id, $ho_ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh);
        header('Location: quan_ly_user.php');
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Phương thức không hợp lệ.";
}
?>