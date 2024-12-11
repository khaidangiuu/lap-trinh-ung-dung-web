<?php
session_start();
require_once '../../Controllers/LibrarianController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $librarianController = new LibrarianController();
        try {
            $result = $librarianController->deleteLibrarian($id);
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