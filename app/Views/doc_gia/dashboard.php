<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../Auth/login.php');
    exit();
}
require_once __DIR__ . '/../../Controllers/BookController.php';
$bookController = new BookController();
$books = $bookController->search();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Độc Giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <?php include_once '../Shared/header.php' ?>
    </header>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard.php">
                                Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gio_sach.php">
                                Giỏ sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lich-su-muon.php">
                                Lịch sử mượn sách
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Auth/logout.php">
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Nội dung chính -->
            <main class="col-md-10 ms-sm-auto px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Trang chủ</h1>
                </div>
                <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> <?php echo $_SESSION['success']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php }
                if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Lỗi!</strong> <?php echo $_SESSION['error']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['error']);
                } ?>
                <form method="GET" action="dashboard.php" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="search_by" class="form-label">Tìm kiếm theo</label>
                            <select class="form-select" id="search_by" name="search_by">
                                <option value="ten_sach">Tên sách</option>
                                <option value="tac_gia">Tên tác giả</option>
                                <option value="nha_xuat_ban">Nhà xuất bản</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="search_value" class="form-label">Từ khóa</label>
                            <input type="text" class="form-control" id="search_value" name="search_value" placeholder="Nhập từ khóa">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label d-block">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                        </div>
                        <?php if (!empty($books)): ?>
                            <table class="table table-bordered mt-4">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sách</th>
                                        <th>Tác giả</th>
                                        <th>Nhà xuất bản</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($books as $index => $book): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><img src="../../../public/images/<?php echo $book['anh']; ?>" alt="Bìa sách" width="50"></td>
                                            <td><?php echo $book['ten_sach']; ?></td>
                                            <td><?php echo $book['tac_gia']; ?></td>
                                            <td><?php echo $book['nha_xuat_ban']; ?></td>
                                            <td>
                                                <form method="POST" action="../Books/sach.php" class="d-inline">
                                                    <input type="hidden" name="id_sach" value="<?php echo $book['id']; ?>">
                                                    <button type="submit" class="btn btn-success float-end">Thêm vào giỏ</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Thống kê sách mượn -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Sách đang mượn</h5>
                                <p class="card-text display-4">3</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Sách quá hạn</h5>
                                <p class="card-text display-4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Tổng lượt mượn</h5>
                                <p class="card-text display-4">15</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $books = $bookController->list();
                    require_once '../Books/sach.php' ?>
                </div>
            </main>
        </div>
    </div>
    <footer>
        <?php require_once '../Shared/footer.php' ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>