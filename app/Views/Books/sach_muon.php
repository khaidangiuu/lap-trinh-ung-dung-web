<?php
session_start();
require_once '../../Controllers/ReaderController.php';

$id_doc_gia = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy danh sách ID sách được chọn từ POST
    $selectedBooks = isset($_POST['chon']) ? $_POST['chon'] : [];

    // Kiểm tra nếu không có sách nào được chọn
    if (empty($selectedBooks)) {
        echo "Bạn chưa chọn sách nào để mượn!";
        exit;
    }

    // Lấy thông tin sách từ BookController
    $bookController = new ReaderController();
    $bookController->yeuCauMuon(); // Hàm mới để lấy thông tin sách theo danh sách ID
} else {
    echo "Phương thức không hợp lệ.";
    exit;
}
?>
