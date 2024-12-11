<?php

require_once __DIR__ . '/../config/BaseController.php';
class BookController extends BaseController
{
    private $bookModel;
    private $borrowModel;
    private $returnModel;
    public function __construct()
    {
        $this->bookModel = $this->model('Sach');
        $this->borrowModel = $this->model('GioSach');
        $this->returnModel = $this->model('LichSuMuonSach');
    }

    public function list()
    {
        $bookModel = $this->bookModel;
        $books = $bookModel->getAll();
        return $books;;
    }
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_by']) && isset($_GET['search_value'])) {
            $criteria = $_GET['search_by'];
            $value = $_GET['search_value'];
            return $this->bookModel->searchBooks($criteria, $value);
        } else {
            return [];
        }
    }
    public function showCart($user_id)
    {
        $gioSachModel = new GioSach();
        return $gioSachModel->getBooksInCart($user_id);
    }

    public function viewCart()
    {
        $cart = $_SESSION['borrow_cart'] ?? [];
        $this->view('Books/gio_sach', ['cart' => $cart]);
    }

    public function addToCart()
{
    try {
        session_start();
        $id_user = $_SESSION['user_id'];
        $id_sach = $_POST['id_sach']; // Lấy ID sách từ form

        if (isset($id_user) && isset($id_sach)) {
            $gioSachModel = new GioSach();
            $gioSachModel->addBook($id_user, $id_sach);

            $_SESSION['success'] = "Thêm sách vào giỏ thành công!";
            header('Location: ../doc_gia/dashboard.php');
        } else {
            throw new Exception("Thiếu thông tin người dùng hoặc sách.");
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage(); // Hiển thị lỗi nếu có
        header('Location: ../doc_gia/dashboard.php');
    }
}


    public function removeFromCart($id)
    {
        session_start();
        $gioSachModel = new GioSach();
        if ($gioSachModel->removeBook($id)) {
            $_SESSION['success'] = "Xóa sách khỏi giỏ thành công!";
            header('Location: ../doc_gia/gio_sach.php');
        } else {
            $_SESSION['error'] = "Xóa sách khỏi giỏ thất bại!";
            header('Location: ../doc_gia/gio_sach.php');
        }
    }

    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_sach' => $_POST['ten_sach'],
                'tac_gia' => $_POST['tac_gia'],
                'nha_xuat_ban' => $_POST['nha_xuat_ban'],
                'nam_xuat_ban' => $_POST['nam_xuat_ban'],
                'the_loai' => $_POST['the_loai'],
                'so_luong' => $_POST['so_luong'],
                'anh' => $_FILES['anh']['name']
            ];

            // Upload ảnh
            $target_dir = ROOT_PATH . "/public/images/";
            $target_file = $target_dir . basename($_FILES['anh']['name']);
            move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);

            // Gọi phương thức create từ lớp Book
            $result = $this->bookModel->create($data);

            if ($result) {
                session_start();
                $_SESSION['success'] = 'Thêm sách thành công';
                header('Location: ../thu_thu/quan_ly_sach.php');
            } else {
                $this->view('Books/them_sach', ['error' => 'Thêm sách thất bại']);
            }
        } else {
            $this->view('Books/them_sach');
        }
    }
    public function showAddBook()
    {
        $this->view('Books.them_sach');
    }

    public function updateBook($id, $ten_sach, $anh, $tac_gia, $nha_xuat_ban, $nam_xuat_ban, $the_loai, $so_luong)
    {
        $this->bookModel->update($id, $ten_sach, $anh, $tac_gia, $nha_xuat_ban, $nam_xuat_ban, $the_loai, $so_luong);
        session_start();
        $_SESSION['success'] = "Cập nhật sách thành công.";
        return true;
    }

    public function deleteBook($id)
    {
        session_start();
        if ($this->bookModel->checkBookInCart($id)) {
            $_SESSION['error'] = "Không thể xóa sách vì đang có trong giỏ hàng.";
        }
        $this->bookModel->delete($id);
        $_SESSION['success'] = "Xóa sách thành công.";
        return true;
    }

    public function getBooksByIds($ids)
    {
        $books = $this->borrowModel->getBooksById($ids);
        return $books;
    }
}
