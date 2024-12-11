<ul class="nav nav-tabs">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <a class="navbar-brand" href="#">
        <img src="../../../public/images/logo.png" alt="Logo Trường Đại học Tây Bắc" width="30" height="30" class="d-inline-block align-text-top">
        UTB Library
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <li class="nav-item"><a class="nav-link <?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>" aria-current="page" href="dashboard.php">Trang chủ</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $current_page == 'quan_ly_sach.php' ? 'active' : ''; ?>" href="quan_ly_sach.php">Quản lý sách</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $current_page == 'quan_ly_muon_tra.php' ? 'active' : ''; ?>" href="quan_ly_muon_tra.php">Quản lý mượn/trả sách</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $current_page == 'quan_ly_user.php' ? 'active' : ''; ?>" href="quan_ly_user.php">Quản lý người dùng</a></li>
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
</ul>
<br>
<img src="../../../public/images/banner.png" width="100%" height="auto" alt="">