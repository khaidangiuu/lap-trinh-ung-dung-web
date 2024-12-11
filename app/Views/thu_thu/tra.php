<?php 
require_once '../../Controllers/LibrarianController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';

    if (!empty($id)) {
        $traSach = new LibrarianController();
        try {
            $result = $traSach->traSach($id);
            header('Location: quan_ly_muon_tra.php');
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } else {
        echo "ID không hợp lệ.";
    }
} else {
    echo "Phương thức không hợp lệ.";
}