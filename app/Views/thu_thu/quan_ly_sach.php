<?php
session_start();
require_once __DIR__ . '/../../Controllers/BookController.php';
$bookController = new BookController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? '';
    $ten_sach = $_POST['ten_sach'] ?? '';
    $tac_gia = $_POST['tac_gia'] ?? '';
    $nha_xuat_ban = $_POST['nha_xuat_ban'] ?? '';
    $nam_xuat_ban = $_POST['nam_xuat_ban'] ?? '';
    $the_loai = $_POST['the_loai'] ?? '';
    $so_luong = $_POST['so_luong'] ?? '';
    $anh = $_POST['anh'] ?? '';

    $target_dir = "../../../public/images/";
    $target_file = $target_dir . basename($_FILES['anh']['name']);
    move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);

    $bookController = new BookController();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <?php include_once 'navbar.php' ?>
    </nav>
    <div class="container mt-4">
        <h1 class="mb-4">Danh Sách Sách</h1>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<div id="sessionSuccess" class="alert alert-success fade-out" role="alert">' . "<strong>Thành công!</strong> " . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Năm Xuất Bản</th>
                    <th>Số Lượng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <a href="../Books/them_sach.php"><button class="btn btn-primary btn-sm ps-3 pe-3 mb-3 d-flex ms-auto">Thêm sách mới</button></a>
                <?php $books = $bookController->list();
                foreach ($books as $index => $book): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><img src="../../../public/images/<?php echo $book['anh']; ?>" style="width: 50px;height: auto;" alt="..."></td>
                        <td><?php echo htmlspecialchars($book['ten_sach']); ?></td>
                        <td><?php echo htmlspecialchars($book['tac_gia']); ?></td>
                        <td><?php echo htmlspecialchars($book['nha_xuat_ban']); ?></td>
                        <td><?php echo htmlspecialchars($book['nam_xuat_ban']); ?></td>
                        <td><?php echo htmlspecialchars($book['so_luong']); ?></td>

                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editBookModal<?php echo $book['id']; ?>">Sửa</button>
                            <!-- Modal Sửa Độc Giả -->
                            <div class="modal fade" id="editBookModal<?php echo $book['id']; ?>" tabindex="-1" aria-labelledby="editBookModalLabel<?php echo $book['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookrModalLabel<?php echo $book['id']; ?>">Sửa Sách</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update_book.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="ten_sach<?php echo $book['id']; ?>" class="form-label">Tên Sách</label>
                                                    <input type="text" class="form-control" name="ten_sach" id="ten_sach<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['ten_sach']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tac_gia<?php echo $book['id']; ?>" class="form-label">Tên Tác Giả</label>
                                                    <input type="text" class="form-control" name="tac_gia" id="tac_gia<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['tac_gia']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nha_xuat_ban<?php echo $book['id']; ?>" class="form-label">Tên Nhà Xuất Bản</label>
                                                    <input type="text" class="form-control" name="nha_xuat_ban" id="nha_xuat_ban<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['nha_xuat_ban']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nam_xuat_ban<?php echo $book['id']; ?>" class="form-label">Năm Xuất Bản</label>
                                                    <input type="text" class="form-control" name="nam_xuat_ban" id="nam_xuat_ban<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['nam_xuat_ban']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="the_loai<?php echo $book['id']; ?>" class="form-label">Thể Loại</label>
                                                    <input type="text" class="form-control" name="the_loai" id="the_loai<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['the_loai']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="so_luong<?php echo $book['id']; ?>" class="form-label">Số Lượng</label>
                                                    <input type="number" class="form-control" name="so_luong" id="so_luong<?php echo $book['id']; ?>" value="<?php echo htmlspecialchars($book['so_luong']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="anh<?php echo $book['id']; ?>" class="form-label">Ảnh</label>
                                                    <input type="file" class="form-control" name="anh" id="anh<?php echo $book['id']; ?>" value="<?php echo $book['anh']; ?>" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $book['id']; ?>)">Xóa</button>
                            <form id="deleteForm<?php echo $book['id']; ?>" action="deletebook.php" method="POST" style="display: none;">
                                <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                            </form>
                            <script>
                                function confirmDelete(id) {
                                    if (confirm("Bạn có chắc là muốn xóa không?")) {
                                        document.getElementById('deleteForm' + id).submit();
                                    }
                                }
                            </script>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <footer>
        <?php include_once '../Shared/footer.php' ?>
    </footer>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>