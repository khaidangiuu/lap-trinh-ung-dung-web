<?php
require_once '../../Controllers/LibrarianController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'] ?? '';
    $ho_ten = $_POST['ten'] ?? '';
    $ngay_sinh = $_POST['ngay_sinh'] ?? '';
    $email = $_POST['email'] ?? '';
    $sdt = $_POST['sdt'] ?? '';
    $anh = $_POST['anh'] ?? '';

    // Khởi tạo controller
    $readerController = new LibrarianController();

    try {
        // Gọi hàm cập nhật thông tin độc giả
        $result = $readerController->updateLibrarian($id, $ho_ten, $ngay_sinh, $email, $sdt, $anh);
        header('Location: quan_ly_user.php');
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "Phương thức không hợp lệ.";
}
?>