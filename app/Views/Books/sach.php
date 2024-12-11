<?php

require_once __DIR__ . '/../../Controllers/BookController.php';

$bookController = new BookController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_sach'])) {
    $bookController->addToCart();
}

$books = $bookController->list();
?>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
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
                    <a href="chi_tiet_sach.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                    <form method="POST" action="../Books/sach.php" class="d-inline">
                        <input type="hidden" name="id_sach" value="<?php echo $book['id']; ?>">
                        <button type="submit" class="btn btn-success float-end">Thêm vào giỏ</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>