<?php
$dashboardLink; // Đường dẫn mặc định
if (isset($_SESSION['role'])) {
    // Kiểm tra role để xác định đường dẫn
    $dashboardLink = ($_SESSION['role'] == 1) ? 'dashboard.php' : 'dashboard.php';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $dashboardLink; ?>">
            <img src="/QuanLyThuVien/assets/images/logo.png" alt="Logo Trường Đại học Tây Bắc" width="30" height="30" class="d-inline-block align-text-top">
            UTB Library
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $dashboardLink; ?>">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../doc_gia/book.php">Sách</a>
                </li>
                <li class="nav-item dropdown">
                    <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Người dùng
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Danh sách độc giả</a></li>
                        <li><a class="dropdown-item" href="#">Danh sách thủ thư</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Thêm mới người dùng</a></li>
                    </ul>
                </li>
            </ul>
            <div class="d-flex ms-auto">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<span>Xin chào ' . htmlspecialchars($_SESSION['username']) . '</span>';
                    echo '<a href="../Auth/logout.php">[ Đăng xuất ]</a>';
                } else {
                    echo '<a href="../Auth/login.php" class="btn btn-primary">Đăng nhập</a>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>