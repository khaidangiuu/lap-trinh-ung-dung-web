<!doctype html>
<html lang="en">

<head>
    <title>Contact</title>
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
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container mt-5">
            <h2>Liên hệ chúng tôi</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>Thời gian mở cửa</h4>
                    <p>Thứ 2 - Thứ 6: 7:30 AM - 5:30 PM</p>
                    <p>Thứ 7: 10:00 AM - 4:00 PM</p>
                    <p>Chủ nhật: Đóng cửa</p>
                </div>
                <div class="col-md-4">
                    <h4>Mạng xã hội</h4>
                    <ul class="list-unstyled">
                        <li><a href="https://facebook.com" target="_blank">Facebook</a></li>
                        <li><a href="https://twitter.com" target="_blank">Twitter</a></li>
                        <li><a href="https://instagram.com" target="_blank">Instagram</a></li>
                        <li><a href="https://linkedin.com" target="_blank">LinkedIn</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Địa chỉ</h4>
                    <address>
                        <strong>TT TT-TV Trường ĐH Tây Bắc</strong><br>
                        Đ. Chu Văn An<br>
                        Tổ 2, P. Quyết Tâm, TP. Sơn La, Sơn La<br>
                        <abbr title="Phone">Điện thoại:</abbr> (+84) 123-4567-890<br>
                        <abbr title="Email">Email:</abbr> <a href="mailto:info@library.com">info@library.com</a>
                    </address>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
        <?php if (isset($data["hiden"]) == false) { ?>
            <div class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nhóm 1 - K62 ĐH CNTT A - Trường ĐH Tây Bắc</span>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sẵn sàng đăng xuất</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Chọn đăng xuất để đăng xuất tài khoản khỏi trang website này</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                        <?php if (isset($_SESSION["dangnhap"][2])) { ?>
                            <a class="btn btn-primary" href="#">Đăng xuất</a>
                        <?php } else { ?>
                            <a class="btn btn-primary" href="#">Đăng xuất</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
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