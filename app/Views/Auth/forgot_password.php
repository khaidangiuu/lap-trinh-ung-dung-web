<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
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
            <p>Đặt lại mật khẩu</p>
        </div>
        <form action="/login" method="POST" class="form-group">
            
        <?php if(isset($message)): ?>
                <div class="alert <?php echo isset($error) ? 'alert-danger' : 'alert-success'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Nhập email của bạn</label>
                <input class="form-control" type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Gửi mã đặt lại</button>
            <div class="text-center mt-3 mb-3">
                Quay lại trang <a href="login.php">đăng nhập.</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
           