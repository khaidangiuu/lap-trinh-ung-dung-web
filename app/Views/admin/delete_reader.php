<?php
session_start();
require_once '../../Controllers/ReaderController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $readerController = new ReaderController();
        try {
            $result = $readerController->deleteReader($id);
            header('Location: quan_ly_user.php');
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