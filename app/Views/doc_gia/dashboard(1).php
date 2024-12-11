<?php
session_start();
require_once __DIR__ . '/../../Controllers/BookController.php';

$bookController = new BookController();
$books = $bookController->list();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="h2">Trang chủ</h1>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thành công!</strong> <?php echo $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <form method="GET" action="dashboard(1).php" class="mb-4">
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
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <img src="../../../public/images/<?php echo htmlspecialchars($book['anh']); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($book['ten_sach']); ?></h5>
                            <p class="card-text">Tác giả: <?php echo htmlspecialchars($book['tac_gia']); ?></p>
                            <p class="card-text">Nhà xuất bản: <?php echo htmlspecialchars($book['nha_xuat_ban']); ?></p>
                            <p class="card-text">Năm xuất bản: <?php echo htmlspecialchars($book['nam_xuat_ban']); ?></p>
                            <p class="card-text">Thể loại: <?php echo htmlspecialchars($book['the_loai']); ?></p>
                            <a href="chitietsach.php?id_sach=<?php echo $book['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                            <a href="sach_muon.php?id_sach=<?php echo $book['id']; ?>" class="btn btn-success float-end">Mượn</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>