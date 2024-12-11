<?php 

require_once __DIR__ . '/../../Controllers/BookController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $bookController = new BookController();
        try {
            $bookController->removeFromCart($id);
            header('Location: ../doc_gia/gio_sach.php');
        } catch (Exception $e) {
           $_SESSION['error'] = "Sách đang trong quá trình chờ mượn.";
           header('Location: ../doc_gia/gio_sach.php');
        }
    } else {
        $_SESSION['error'] = "ID không hợp lệ.";
    }
} else {
    $_SESSION['error'] = "Phương thức không hợp lệ.";
}
?>