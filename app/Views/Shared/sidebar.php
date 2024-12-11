<aside class="mt-4">
        <!-- place sidebar here -->

        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass" style="color: #63E6BE;"></i></button>
        </form>
        <select class="form-select me-2" aria-label="Search category">
            <option selected value="book">Tên sách</option>
            <option value="author">Tên tác giả</option>
        </select>
        <div class="category">
            <h5>Danh mục</h5>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <a href="./assets/views/monchung.php?id_the_loai=1" class="text-decoration-none" id="mon-chung">Giáo trình Môn chung</a>
                    <span class="badge bg-primary rounded-pill">
                        <?php
                        $id_the_loai = 1; // Môn chung
                        $sql_count = "SELECT COUNT(*) as total FROM sach WHERE id_the_loai = $id_the_loai";
                        $result_count = mysqli_query($conn, $sql_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        echo $row_count['total'];
                        ?>
                    </span>
                </li>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <a href="./assets/views/mon_toan_ly.php?id_the_loai=2" class="text-decoration-none" id="toan-ly">Giáo trình Toán - Lý</a>
                    <span class="badge bg-primary rounded-pill">
                        <?php
                        $id_the_loai = 2; // Môn Toán - Lý
                        $sql_count = "SELECT COUNT(*) as total FROM sach WHERE id_the_loai = $id_the_loai";
                        $result_count = mysqli_query($conn, $sql_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        echo $row_count['total'];
                        ?>
                    </span>
                </li>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <a href="./assets/views/mon_hoa_sinh.php?id_the_loai=3" class="text-decoration-none" id="hoa-sinh">Giáo trình Hóa - Sinh</a>
                    <span class="badge bg-primary rounded-pill">
                        <?php
                        $id_the_loai = 3; // Môn Hóa - Sinh
                        $sql_count = "SELECT COUNT(*) as total FROM sach WHERE id_the_loai = $id_the_loai";
                        $result_count = mysqli_query($conn, $sql_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        echo $row_count['total'];
                        ?>
                    </span>
                </li>
                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <a href="./assets/views/mon_tin.php?id_the_loai=4" class="text-decoration-none" id="tin-hoc">Giáo trình Tin học</a>
                    <span class="badge bg-primary rounded-pill">
                        <?php
                        $id_the_loai = 4; // Môn Tin học
                        $sql_count = "SELECT COUNT(*) as total FROM sach WHERE id_the_loai = $id_the_loai";
                        $result_count = mysqli_query($conn, $sql_count);
                        $row_count = mysqli_fetch_assoc($result_count);
                        echo $row_count['total'];
                        ?>
                    </span>
                </li>
            </ul>
        </div>
    </aside>