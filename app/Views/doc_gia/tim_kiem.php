<?php 
require_once __DIR__ . '/../../Controllers/BookController.php';
$bookController = new BookController();
$books = $bookController->search();
?>
<?php if (isset($error)): ?>
    <div class="alert alert-warning mt-4"><?php echo $error; ?></div>
<?php endif; ?>

<?php if (!empty($books)): ?>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Nhà xuất bản</th>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
