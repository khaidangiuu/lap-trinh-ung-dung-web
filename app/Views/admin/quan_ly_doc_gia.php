<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addReaderModal">Thêm Độc Giả</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Độc Giả</th>
                    <th>Ngày Sinh</th>
                    <th>Khóa học</th>
                    <th>Khoa</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu độc giả sẽ được hiển thị ở đây -->
                <?php
                // require '../../Controllers/ReaderController.php';
                $readerController = new ReaderController();
                $readers = $readerController->list();
                foreach ($readers as $index => $reader): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><img src="../../../public/images/<?php echo $reader['anh']; ?>" style="width: 50px;height: auto;" alt="..."></td>
                        <td><?php echo htmlspecialchars($reader['ten']); ?></td>
                        <td><?php echo (new DateTime($reader['ngay_sinh']))->format('d/m/Y'); ?></td>
                        <td><?php echo htmlspecialchars($reader['khoa_hoc']); ?></td>
                        <td><?php echo htmlspecialchars($reader['khoa_cn']); ?></td>

                        <td>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editReaderModal<?php echo $reader['id']; ?>">Sửa</button>
                            <!-- Modal Sửa Độc Giả -->
                            <div class="modal fade" id="editReaderModal<?php echo $reader['id']; ?>" tabindex="-1" aria-labelledby="editReaderModalLabel<?php echo $reader['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editReaderModalLabel<?php echo $reader['id']; ?>">Sửa Độc Giả</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="update_reader.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $reader['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="ten<?php echo $reader['id']; ?>" class="form-label">Tên Độc Giả</label>
                                                    <input type="text" class="form-control" name="ten" id="ten<?php echo $reader['id']; ?>" value="<?php echo htmlspecialchars($reader['ten']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ngay_sinh<?php echo $reader['id']; ?>" class="form-label">Ngày Sinh</label>
                                                    <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh<?php echo $reader['id']; ?>" value="<?php echo htmlspecialchars($reader['ngay_sinh']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="khoa_hoc<?php echo $reader['id']; ?>" class="form-label">Khóa Học</label>
                                                    <input type="text" class="form-control" name="khoa_hoc" id="khoa_hoc<?php echo $reader['id']; ?>" value="<?php echo htmlspecialchars($reader['khoa_hoc']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="khoa_cn<?php echo $reader['id']; ?>" class="form-label">Khoa Chuyên Ngành</label>
                                                    <input type="text" class="form-control" name="khoa_cn" id="khoa_cn<?php echo $reader['id']; ?>" value="<?php echo htmlspecialchars($reader['khoa_cn']); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="anh<?php echo $reader['id']; ?>" class="form-label">Ảnh Cá Nhân</label>
                                                    <input type="file" class="form-control" name="anh" id="anh<?php echo $reader['id']; ?>" value="<?php echo htmlspecialchars($reader['anh']); ?>" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $reader['id']; ?>)">Xóa</button>
                            <form id="deleteForm<?php echo $reader['id']; ?>" action="delete_reader.php" method="POST" style="display: none;">
                                <input type="hidden" name="id" value="<?php echo $reader['id']; ?>">
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
<div class="modal fade" id="addReaderModal" tabindex="-1" aria-labelledby="addReaderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReaderModalLabel">Thêm Độc Giả</h5>
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
                        <input type="number" class="form-control" name="role" id="role" value="1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="ten" class="form-label">Tên Người Dùng</label>
                        <input type="text" class="form-control" name="ten" id="ten" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngay_sinh" class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control" name="ngay_sinh" id="ngay_sinh" required>
                    </div>
                    <div class="mb-3">
                        <label for="khoa_hoc" class="form-label">Khóa Học</label>
                        <input type="text" class="form-control" name="khoa_hoc" id="khoa_hoc" required>
                    </div>
                    <div class="mb-3">
                        <label for="khoa_cn" class="form-label">Khoa Chuyên Ngành</label>
                        <input type="text" class="form-control" name="khoa_cn" id="khoa_cn" required>
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