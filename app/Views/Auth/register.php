
<?php
session_start();
require_once '../../Controllers/TaiKhoanController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';

    $authController = new TaiKhoanController();
    try {
        // Gọi hàm tạo user trong AuthController
        $userId = $authController->createUser($username, $password, $email, $role);

        // Lưu user_id vào session để sử dụng ở bước tiếp theo
        $_SESSION['user_id'] = $userId;

        // Chuyển hướng đến trang thứ 2
        header('Location: register_reader.php');
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

        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên Đăng Nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật Khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Xác Nhận Mật Khẩu</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Loại Tài Khoản</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Chọn loại tài khoản</option>
                    <option value="1">Độc Giả</option>
                    <option value="2">Thủ Thư</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Tiếp Theo</button>

            <div class="text-center">
                <p>Bạn đã có tài khoản? <a href="login.php" class="text-primary">Đăng nhập</a></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>