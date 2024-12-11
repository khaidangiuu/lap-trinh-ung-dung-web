<?php
// session_start();
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once ROOT_PATH . '/app/config/BaseController.php';
class LibrarianController extends BaseController
{
    private $bookModel;
    private $returnModel;
    private $thuThuModel;

    public function __construct()
    {
        $this->bookModel = $this->model('Sach');
        $this->thuThuModel = $this->model('ThuThu');
        $this->returnModel = $this->model('LichSuMuonSach');
    }

    public function showAll() {
        $thuThuModel = $this->thuThuModel;
        $librarians = $thuThuModel->getAll();
        return $librarians;
    }

    public function addLibrarian($user_id, $ten, $ngay_sinh, $email, $sdt, $anh) {
        $thuThuModel = $this->thuThuModel;
        $thuThuModel->addLibrarian($user_id, $ten, $ngay_sinh, $email, $sdt, $anh);
        
        $_SESSION['success'] = "Thêm thủ thư thành công.";
        return true;
    }

    public function updateLibrarian($id, $ten, $ngay_sinh, $email, $sdt, $anh) {
        $thuThuModel = $this->thuThuModel;
        $thuThuModel->updateLibrarian($id, $ten, $ngay_sinh, $email, $sdt, $anh);
        
        $_SESSION['success'] = "Cập nhật thông tin thủ thư thành công.";
        return true;
    }

    public function deleteLibrarian($id) {
        $thuThuModel = $this->thuThuModel;
        $thuThuModel->removeLibrarian($id);
        
        $_SESSION['success'] = "Xóa thủ thư thành công.";
        return true;
    }
    public function manageBooks()
    {
        $bookModel = $this->bookModel;
        $books = $bookModel->getAll();
        $this->view('thu_thu/quan_ly_sach', ['books' => $books]);
    }

    public function addBook()
    {
        $data = [
            'ten_sach' => $_POST['ten_sach'],
            'anh' => $_POST['anh'],
            'tac_gia' => $_POST['tac_gia'],
            'nha_xuat_ban' => $_POST['nha_xuat_ban'],
            'nam_xuat_ban' => $_POST['nam_xuat_ban'],
            'the_loai' => $_POST['the_loai'],
            'so_luong' => $_POST['so_luong'],
        ];
        $bookModel = $this->bookModel;
        $bookModel->create($data);
        header('Location: /thu_thu/quan_ly_sach');
    }

    public function deleteBook()
    {
        $bookId = $_POST['book_id'];
        $bookModel = $this->bookModel;
        $bookModel->delete($bookId);
        header('Location: /thu_thu/quan_ly_sach');
    }

    public function editBook()
    {
        $bookId = $_POST['book_id'];
        $bookModel = $this->bookModel;
        $book = $bookModel->findById($bookId);
        $this->view('thu_thu/sua_sach', ['book' => $book]);
    }

    public function updateBook()
    {
        $data = [
            'id' => $_POST['id'],
            'ten_sach' => $_POST['ten_sach'],
            'anh' => $_POST['anh'],
            'tac_gia' => $_POST['tac_gia'],
            'nha_xuat_ban' => $_POST['nha_xuat_ban'],
            'nam_xuat_ban' => $_POST['nam_xuat_ban'],
            'the_loai' => $_POST['the_loai'],
            'so_luong' => $_POST['so_luong'],
        ];
        $bookModel = $this->bookModel;
        $bookModel->update($data);
        header('Location: /thu_thu/quan_ly_sach');
    }
    public function quanLySach()
    {
        $bookModel = $this->model('Sach'); // Tạo instance của model Sach
        $books = $bookModel->getAll(); // Lấy tất cả sách từ cơ sở dữ liệu
        $this->view('thu_thu.quan_ly_sach', ['books' => $books]); // Truyền dữ liệu đến view
    }

    public function quanLyMuonTra()
    {
        $muonSach = $this->returnModel;
        $books = $muonSach->getAll(); // Lấy tất cả sách từ cơ sở dữ liệu
        $this->view('thu_thu.quan_ly_muon_tra', ['returns' => $books]); // Truyền dữ liệu đến view
        return $books;
    }

    // Xử lý mượn sách
    public function muonSach($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = $_POST['id'];
            $sachModel = new LichSuMuonSach();
            $sachModel->updateTrangThai($bookId, 'Đang mượn');
            header("Location: /quan-ly-muon-tra"); // Redirect lại trang quản lý mượn/trả
        }
        return true;
    }

    // Xử lý trả sách
    public function traSach($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookId = $_POST['id'];
            $sachModel = new LichSuMuonSach();
            $sachModel->returnBook($bookId);
            $sachModel->updateTrangThai($bookId, 'Đã trả');
            header("Location: /quan-ly-muon-tra"); // Redirect lại trang quản lý mượn/trả
        }
        return true;
    }
}
