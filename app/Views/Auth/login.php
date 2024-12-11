<?php
require_once __DIR__ . '/../../Controllers/TaiKhoanController.php';

// Sử dụng phương thức xử lý đăng ký từ controller
$taiKhoanController = new TaiKhoanController();

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $loginResult = $taiKhoanController->login($_POST);

    // Kiểm tra kết quả đăng nhập
    if ($loginResult === true) {
        // Đăng nhập thành công
        $_SESSION['user_id'] = $taiKhoanController->getUserId();
        $_SESSION['username'] = $taiKhoanController->getUsername();
        $_SESSION['role'] = $taiKhoanController->getRole();
        header('Location: dashboard.php');
        exit();
    } else {
        // Đăng nhập thất bại, lưu lỗi để hiển thị
        $error = $loginResult;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header h1 {
            font-size: 2.5rem;
            color: #1877f2;
        }

        .login-header p {
            color: #606770;
        }

        .btn-facebook {
            background-color: #1877f2;
            color: white;
            border: none;
        }

        .btn-facebook:hover {
            background-color: #165dbb;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h1>Trung tâm TT-TV</h1>
            <p>Vui lòng đăng nhập</p>
        </div>
        <?php if (isset($_SESSION['error'])){ ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Lỗi!</strong> <?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); 
           } ?>
        
        <form action="login.php" method="POST" class="form-group">

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Tên Đăng Nhập</label>
                <input class="form-control" type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input class="form-control" type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            <div class="text-center mt-3 mb-3">
                <a href="forgot_password.php">Bạn quên mật khẩu ư?</a>
            </div>
            <a href="register.php"><button type="button" class="btn btn-facebook btn-block">Tạo tài khoản mới</button></a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>