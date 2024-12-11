<?php
session_start();
require_once '../../Controllers/TaiKhoanController.php';
require_once '../../Controllers/ReaderController.php';
require_once '../../Controllers/LibrarianController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin từ form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';
    $ten = $_POST['ten'] ?? '';
    $ngay_sinh = $_POST['ngay_sinh'] ?? '';
    $khoa_hoc = $_POST['khoa_hoc'] ?? '';
    $khoa_cn = $_POST['khoa_cn'] ?? '';
    $email = $_POST['email'] ?? '';
    $sdt = $_POST['sdt'] ?? '';
    $anh = $_POST['anh'] ?? '';
    // // Upload ảnh
    // $target_dir = "../../../public/images/";
    // $target_file = $target_dir . basename($_FILES['anh']['name']);
    // move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);

    // Khởi tạo controller
    $authController = new TaiKhoanController();
    $readerController = new ReaderController();
    $librarianController = new LibrarianController();


    if ($role == '1') {
        try {
            // 1. Thêm user vào bảng users
            $userId = $authController->createUser($username, $password, $email, $role);
            // 2. Thêm độc giả vào bảng docgia
            $readerController->addReader($userId, $ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    } elseif ($role == '2') {
        try {
            // 1. Thêm user vào bảng users
            $librarianId = $authController->createUser($username, $password, $email, $role);
            // 2. Thêm thủ thư vào bảng thuthu
            $librarianController->addLibrarian($librarianId, $ten, $ngay_sinh, $email, $sdt, $anh);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Quản lý người dùng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <style>
        .fade-out {
            opacity: 1;
            transition: opacity 1s ease-out;
            /* Thay đổi độ mờ trong 1 giây */
        }

        .fade-out-hidden {
            opacity: 0;
            /* Đặt độ mờ thành 0 để ẩn */
        }
    </style>
</head>

<body>
    <nav>
        <?php include 'navbar.php'; ?>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Quản Lý Người Dùng</h1>
        <h4>Độc Giả</h4>
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div id="sessionSuccess" class="alert alert-success fade-out" role="alert">' . "<strong>Thành công!</strong> " . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        <?php require_once 'quan_ly_doc_gia.php'; ?>
        <h4>Thủ Thư</h4>
        <?php require_once 'quan_ly_thu_thu.php'; ?>
    </div>
    <footer>
        <?php include_once '../Shared/footer.php' ?>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script>
        // Kiểm tra xem thông báo có tồn tại không
        const sessionSuccess = document.getElementById('sessionSuccess');
        if (sessionSuccess) {
            // Thiết lập thời gian 5 giây (5000 milliseconds)
            setTimeout(() => {
                sessionSuccess.classList.add('fade-out-hidden'); // Thêm lớp để bắt đầu hiệu ứng biến mất
                setTimeout(() => {
                    sessionSuccess.style.display = 'none'; // Ẩn thông báo sau khi hiệu ứng kết thúc
                }, 500); // Thời gian này nên bằng với thời gian trong transition CSS
            }, 2000);
        }
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>