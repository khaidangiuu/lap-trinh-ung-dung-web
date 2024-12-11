<?php
session_start();
require_once '../../Controllers/BookController.php';

$id_doc_gia = $_SESSION['user_id'];
$gioSachController = new BookController();
$books = $gioSachController->showCart($id_doc_gia); // Lấy sách trong giỏ

?>

<h1>Giỏ sách của bạn</h1>
<?php if (!empty($books)):
    if (isset($_SESSION['success'])) { ?>
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
    <form method="POST" action="../Books/sach_muon.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Chọn</th>
                    <th>Ảnh</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Nhà xuất bản</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><input type="checkbox" name="chon[]" value="<?php echo $book['id']; ?>"></td>
                        <td><img src="../../../public/images/<?php echo htmlspecialchars($book['anh']); ?>" style="width: 50px; height: auto;" alt="Ảnh"></td>
                        <td><?php echo htmlspecialchars($book['ten_sach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tac_gia']); ?></td>
                        <td><?php echo htmlspecialchars($book['nha_xuat_ban']); ?></td>
                        <td>
                            <form id="deleteForm<?php echo $book['id']; ?>" action="../Books/xoa_khoi_gio.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc là muốn xóa không?')">Xóa</button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Mượn</button>

    </form>
<?php else: ?>
    <p>Giỏ sách của bạn trống.</p>
<?php endif; ?>