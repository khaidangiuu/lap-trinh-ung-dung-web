<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sách</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Chi Tiết Sách</h3>
            </div>
            <div class="card-body">

                <body>
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-center"><?php echo $row['ten_sach']; ?></h1>
                            <img src="assets/images/<?php echo $row['anh']; ?>" class="img-fluid" alt="...">
                            <p>Tác giả: <?php echo $row['tac_gia']; ?></p>
                            <p>Nhà xuất bản: <?php echo $row['nha_xuat_ban']; ?></p>
                            <p>Số lượng: <?php echo $available_quantity; ?></p>
                            <p>Mô tả: <?php echo $row['noi_dung']; ?></p>
                        </div>
                    </div>
                </body>
            </div>
            <div class="card-footer">
                <a href="/qltv_mvc/app/Views/Books/index.php" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>