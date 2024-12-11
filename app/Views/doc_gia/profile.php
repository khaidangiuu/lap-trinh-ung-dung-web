<?php
session_start();
require_once __DIR__ . '/../../Controllers/ReaderController.php';

if (isset($_SESSION['user']['id'])) {
    $profile = new ReaderController();
    $reader = $profile->profile($_SESSION['user']['id']);

    if (!empty($reader)) {
?>

        <!doctype html>
        <html lang="en">

        <head>
            <title>Title</title>
            <!-- Required meta tags -->
            <meta charset="utf-8" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1, shrink-to-fit=no" />

            <!-- Bootstrap CSS v5.2.1 -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
                crossorigin="anonymous" />
        </head>

        <body>
            <header>
                <?php include_once '../Shared/header.php' ?>
            </header>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Trường Đại học Tây Bắc</h3>
                        <h5>Trung tâm TT - TV</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="../../../public/images/<?php echo $reader['anh']; ?>" class="img-fluid rounded" style="width: 150px; height: auto;" alt="Profile Picture">
                                <p><i>Ngày hết hạn:
                                        <?php
                                        $expirationDate = (new DateTime($reader['created_at']))->modify('+5 years');
                                        echo $expirationDate->format('d/m/Y');
                                        ?>
                                    </i></p>
                            </div>
                            <div class="col-md-8">
                                <h4>Thông tin độc giả</h4>
                                <p><strong>Tên:</strong> <?php echo htmlspecialchars($reader['ten']) ?></p>
                                <p><strong>Ngày sinh:</strong> <?php echo (new DateTime($reader['ngay_sinh']))->format('d/m/Y'); ?></p>
                                <p><strong>Khóa học:</strong> <?php echo htmlspecialchars($reader['khoa_hoc']) ?></p>
                                <p><strong>Khoa:</strong> <?php echo htmlspecialchars($reader['khoa_cn']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center mt-4"></div>
                <a href="/edit_profile.php" class="btn btn-primary">Sửa thông tin</a>
            </div>
            </div>
            <footer>
                <?php include_once '../Shared/footer.php' ?>
            </footer>

            <!-- Bootstrap JavaScript Libraries -->
            <script
                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"></script>

            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"></script>
        </body>

        </html>
<?php
    } else {
        echo "Không tìm thấy thông tin độc giả";
        exit();
    }
} else {
    header('Location: /login.php');
}
