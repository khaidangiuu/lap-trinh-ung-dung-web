<?php
session_start();
require_once '../../Controllers/BookController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $bookController = new BookController();
        try {
            $result = $bookController->deleteBook($id);
            header('Location: quan_ly_sach.php');
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "ID không hợp lệ.";
    }
} else {
    echo "Phương thức không hợp lệ.";
}
?>