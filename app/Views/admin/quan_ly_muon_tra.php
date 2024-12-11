<?php
// session_start();
require_once __DIR__ . '/../../Controllers/LibrarianController.php';

$librarianController = new LibrarianController();
$borrowRequests = $librarianController->quanLyMuonTra();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Quản lý mượn trả</title>
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
    <nav>
        <?php include 'navbar.php' ?>
    </nav>
    <div class="container">
        <h2>Các yêu cầu mượn</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người mượn</th>
                            <th>Sách</th>
                            <th>Ngày mượn</th>
                            <th>Ngày hẹn trả</th>
                            <th>Ngày trả</th>
                            <th>Tình trạng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($borrowRequests as $key => $borrowRequest) : ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $borrowRequest['ten']; ?></td>
                                <td><?php echo $borrowRequest['ten_sach']; ?></td>
                                <td><?php echo (new DateTime($borrowRequest['ngay_muon']))->format('d/m/Y'); ?></td>
                                <td><?php echo (new DateTime($borrowRequest['ngay_hen_tra']))->format('d/m/Y'); ?></td>
                                <td><?php echo (new DateTime($borrowRequest['ngay_tra']))->format('d/m/Y'); ?></td>
                                <td><?php echo $borrowRequest['tinh_trang']; ?></td>
                                <td>
                                    <form id="deleteForm<?php echo $borrowRequest['id']; ?>" action="muon.php" method="POST"">
                                        <input type=" hidden" name="id" value="<?php echo $borrowRequest['id']; ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Cho mượn</button>
                                    </form>
                                    <form id="deleteForm<?php echo $borrowRequest['id']; ?>" action="tu_choi.php" method="POST"">
                                        <input type=" hidden" name="id" value="<?php echo $borrowRequest['id']; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Từ chối</button>
                                    </form>
                                    <form id="deleteForm<?php echo $borrowRequest['id']; ?>" action="tra.php" method="POST"">
                                        <input type=" hidden" name="id" value="<?php echo $borrowRequest['id']; ?>">
                                        <button type="submit" class="btn btn-info btn-sm">Trả sách</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require_once '../Shared/footer.php'; ?>

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