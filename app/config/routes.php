<?php
// routes.php
require_once 'app.php';
$app = new App();
$router = $app->getRouter();

$router->get('/', 'TaiKhoanController@showLoginForm');
//$router->get('/', 'TaiKhoanController@showLoginForm');

// Routes cho xác thực (Authentication)
$router->get('/login', 'TaiKhoanController@showLoginForm');
$router->post('/login', 'TaiKhoanController@login');
$router->get('/register', 'TaiKhoanController@showRegisterForm');
$router->post('/register', 'TaiKhoanController@register');
$router->get('/logout', 'TaiKhoanController@logout');

// Routes cho sách
$router->get('/sach', 'BookController@index');
$router->get('/sach/chi-tiet/{id}', 'BookController@chiTiet');
$router->get('/gio-sach', 'BookController@gioSach');
$router->post('/gio-sach/them', 'BookController@themVaoGio');
$router->post('/gio-sach/xoa', 'BookController@xoaKhoiGio');

// Routes cho độc giả
$router->get('/doc-gia/dashboard', 'ReaderController@dashboard');
$router->get('/doc-gia/lich-su-muon', 'ReaderController@lichSuMuon');
$router->get('/doc-gia/profile', 'ReaderController@profile');
$router->post('/doc-gia/profile/update', 'ReaderController@updateProfile');

// Routes cho thủ thư
$router->get('/thu-thu/dashboard', 'LibrarianController@dashboard');
$router->get('/thu-thu/quan-ly-sach', 'LibrarianController@quanLySach');
$router->get('/thu-thu/quan-ly-doc-gia', 'LibrarianController@quanLyDocGia');
$router->get('/thu-thu/quan-ly-muon-tra', 'LibrarianController@quanLyMuonTra');

// Routes cho thay đổi mật khẩu
$router->get('/change-password', 'TaiKhoanController@showChangePasswordForm');
$router->post('/change-password', 'TaiKhoanController@changePassword');