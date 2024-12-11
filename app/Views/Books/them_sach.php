<?php
// app/Views/Books/them_sach.php
session_start();
require_once __DIR__ . '/../../Controllers/BookController.php';

$bookController = new BookController();
$bookController->addBook();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Thêm sách</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ten_sach" class="form-label">Tên sách</label>
                <input type="text" class="form-control" id="ten_sach" name="ten_sach" required>
            </div>
            <div class="mb-3">
                <label for="tac_gia" class="form-label">Tác giả</label>
                <input type="text" class="form-control" id="tac_gia" name="tac_gia" required>
            </div>
            <div class="mb-3">
                <label for="nha_xuat_ban" class="form-label">Nhà xuất bản</label>
                <input type="text" class="form-control" id="nha_xuat_ban" name="nha_xuat_ban" required>
            </div>
            <div class="mb-3">
                <label for="nam_xuat_ban" class="form-label">Năm xuất bản</label>
                <input type="number" class="form-control" id="nam_xuat_ban" name="nam_xuat_ban" required>
            </div>
            <div class="mb-3">
                <label for="the_loai" class="form-label">Thể loại</label>
                <input type="text" class="form-control" id="the_loai" name="the_loai" required>
            </div>
            <div class="mb-3">
                <label for="so_luong" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="so_luong" name="so_luong" required>
            </div>
            <div class="mb-3">
                <label for="anh" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="anh" name="anh" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sách</button>
        </form>
    </div>
</body>
</html>