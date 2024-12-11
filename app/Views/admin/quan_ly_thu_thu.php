<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addlibrianModal">Thêm Thủ Thư</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Thủ Thư</th>
                    <th>Ngày Sinh</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu độc giả sẽ được hiển thị ở đây -->
                <?php
                //require '../../Controllers/LibrarianController.php';
                $thuThuController = new LibrarianController();
                $librarians = $thuThuController->showAll();
                foreach ($librarians as $index => $librian): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><img src="../../../public/images/<?php echo $librian['anh']; ?>" style="width: 50px;height: auto;" alt="..."></td>
                        <td><?php echo htmlspecialchars($librian['ten']); ?></td>
                        <td><?php echo (new DateTime($librian['ngay_sinh']))->format('d/m/Y'); ?></td>
                        <td><?php echo htmlspecialchars($librian['email']); ?></td>
                        <td><?php echo htmlspecialchars($librian['sdt']); ?></td>

                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editlibrianModal<?php echo $librian['id']; ?>">Sửa</button>
                            <!-- Modal Sửa Độc Giả -->
                            <div class="modal fade" id="editlibrianModal<?php echo $librian['id']; ?>" tabindex="-1" aria-labelledby="editlibrianModalLabel<?php echo $librian['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editlibrianModalLabel<?php echo $librian['id']; ?>">Sửa Thủ Thư</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update_librarian.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $librian['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="ten<?php echo $librian['id']; ?>" class="form-label">Tên Thủ Thư</label>
                                                    <input type="text" class="form-control" name="ten" id="ten<?php echo $librian['id']; ?>" value="<?php echo htmlspecialchars($librian['ten']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ngay_sinh<?php echo $librian['id']; ?>" class="form-label">Ngày Sinh</label>
                                                    <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh<?php echo $librian['id']; ?>" value="<?php echo htmlspecialchars($librian['ngay_sinh']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email<?php echo $librian['id']; ?>" class="form-label">Email</label>
                                                    <input type="text" class="form-control" name="email" id="email<?php echo $librian['id']; ?>" value="<?php echo htmlspecialchars($librian['email']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sdt<?php echo $librian['id']; ?>" class="form-label">Số Điện Thoại</label>
                                                    <input type="text" class="form-control" name="sdt" id="sdt<?php echo $librian['id']; ?>" value="<?php echo htmlspecialchars($librian['sdt']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="anh<?php echo $librian['id']; ?>" class="form-label">Ảnh Cá Nhân</label>
                                                    <input type="file" class="form-control" name="anh" id="anh<?php echo $librian['id']; ?>" value="<?php echo htmlspecialchars($librian['anh']); ?>" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $librian['id']; ?>)">Xóa</button>
                            <form id="deleteForm<?php echo $librian['id']; ?>" action="delete_librarian.php" method="POST" style="display: none;">
                                <input type="hidden" name="id" value="<?php echo $librian['id']; ?>">
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
</div>
<!-- Modal Thêm Độc Giả -->
<div class="modal fade" id="addlibrianModal" tabindex="-1" aria-labelledby="addlibrianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addlibrianModalLabel">Thêm Thủ Thư</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Đăng Nhập</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Quyền</label>
                        <input type="number" class="form-control" name="role" id="role" value="2" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên Thủ Thư</label>
                        <input type="text" class="form-control" name="ten" id="ten" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngay_sinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" name="sdt" id="sdt" required>
                    </div>
                    <div class="mb-3">
                        <label for="anh" class="form-label">Ảnh Cá Nhân</label>
                        <input type="file" class="form-control" name="anh" id="anh" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>