<?php
// session_start();
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once ROOT_PATH . '/app/config/BaseController.php';

class ReaderController extends BaseController {
    private $docGiaModel;
    private $muonSachModel;

    public function __construct()
    {
        $this->docGiaModel = $this->model('DocGia');
        $this->muonSachModel = $this->model('LichSuMuonSach');
    }
    
    // Trang Dashboard của Độc giả
    public function dashboard() {
        $borrowHistory = $this->muonSachModel->getHistoryByReader($_SESSION['user']['id']);
        $this->view('Reader/dashboard', ['borrowHistory' => $borrowHistory]);
    }

    // Xem thông tin cá nhân của độc giả
    public function profile($id) {
        $reader = $this->docGiaModel->findByUserId($id);
        if ($reader) {
            $this->view('doc_gia/profile', ['reader' => $reader]);
        } else {
            // Xử lý khi không tìm thấy độc giả
            echo "Không tìm thấy thông tin độc giả";
            exit();
        }
        return $reader;
    }

    // Cập nhật thông tin cá nhân
    public function updateProfileReader($id, $ho_ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh) {
        $this->docGiaModel->updateReader($id, $ho_ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh);
        
        $_SESSION['success'] = "Cập nhật thông tin độc giả thành công.";
        return true;
    }

    // Xóa thông tin độc giả
    public function deleteReader($id) {
        $this->docGiaModel->removeReader($id);
        
        $_SESSION['success'] = "Xóa độc giả thành công.";
        return true;
    }

    // Xem lịch sử mượn sách
    public function borrowHistory() {
        $borrowModel = $this->muonSachModel;
        $history = $borrowModel->getHistoryByReader($_SESSION['user']['id']);
        $this->view('doc_gia/lich_su_muon_sach', ['history' => $history]);
    }

    public function list() {
        $readerModel = $this->docGiaModel;
        $readers = $readerModel->getAll();
        return $readers;
    }

    public function addReader($user_id, $ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh) {
        $this->docGiaModel->addReader1($user_id, $ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh);
        
        $_SESSION['success'] = "Thêm độc giả thành công.";
        return true;
    }

    public function yeuCauMuon() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy danh sách ID sách được chọn từ POST
            $selectedBooks = isset($_POST['chon']) ? $_POST['chon'] : [];
    
            // Kiểm tra nếu không có sách nào được chọn
            if (empty($selectedBooks)) {
                echo "Bạn chưa chọn sách nào để mượn!";
                exit;
            }
            // Lặp qua từng ID sách được chọn và thêm vào bảng muon_tra
            foreach ($selectedBooks as $id_gio) {
                // Kiểm tra xem sách đã được mượn bởi người dùng này chưa
                if (!empty($this->muonSachModel->checkExistingBorrow($_SESSION['user']['id'], $id_gio))) {
                    $_SESSION['error'] = "Bạn đã gửi yêu cầu mượn này rồi!";
                    header('Location: ../doc_gia/gio_sach.php');
                    exit;
                }
                // Lấy thông tin người dùng từ session
                $id_user = $_SESSION['user_id'];
                // Lấy ngày hiện tại
                $ngay_muon = date('Y-m-d');
                // Tính toán ngày hẹn trả (ngày mượn + 7 ngày)
                $ngay_hen_tra = date('Y-m-d', strtotime($ngay_muon . ' + 15 days'));
                $tinh_trang = 'Đang chờ duyệt'; // Tình trạng
    
                // Thêm thông tin vào bảng muon_tra
                $this->muonSachModel->addBook($id_user, $id_gio, $ngay_muon, $ngay_hen_tra, $tinh_trang);
            }
    
            $_SESSION['success'] = "Yêu cầu đã được gửi đi!";
            header('Location: ../doc_gia/gio_sach.php');
        } else {
            echo "Phương thức không hợp lệ.";
            exit;
        }
    }
    
}
