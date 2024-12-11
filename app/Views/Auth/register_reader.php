<?php
session_start();
require_once '../../Controllers/ReaderController.php';
// Kiểm tra nếu user_id đã tồn tại trong session
if (!isset($_SESSION['user_id'])) {
    header('Location: register.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ho_ten = $_POST['ho_ten'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $khoa_hoc = $_POST['khoa_hoc'];
    $khoa_cn = $_POST['khoa_cn'];
    $anh = $_POST['anh'];
    $user_id = $_SESSION['user_id'];

    $readerController = new ReaderController();
    try {
        // Gọi hàm thêm độc giả
        $readerController->addReader($user_id, $ho_ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh);

        // Xóa session sau khi hoàn tất
        unset($_SESSION['user_id']);

        // Chuyển hướng đến trang đăng ký thành công
        header('Location: login.php');
        exit;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .register-container {
            width: 100%;
            max-width: 450px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Đăng Ký Tài Khoản</h1>
        </div>

        <?php echo $data['error'] ?? '';
        if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars((string)$error); ?>
            </div>
        <?php endif; ?>

        <form action="register_reader.php" method="POST">
            <div class="mb-3">
                <label for="ho_ten" class="form-label">Họ tên</label>
                <input type="text" class="form-control" id="ho_ten" name="ho_ten" required>
            </div>

            <div class="mb-3">
                <label for="ngay_sinh" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required>
            </div>

            <div class="mb-3">
                <label for="khoa_hoc" class="form-label">Khóa học</label>
                <input type="text" class="form-control" id="khoa_hoc" name="khoa_hoc" required>
            </div>

            <div class="mb-3">
                <label for="khoa_cn" class="form-label">Khoa chuyên ngành</label>
                <input type="text" class="form-control" id="khoa_cn" name="khoa_cn" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Ảnh cá nhân</label>
                <input type="file" class="form-control" name="anh" id="anh" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Đăng Ký</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
