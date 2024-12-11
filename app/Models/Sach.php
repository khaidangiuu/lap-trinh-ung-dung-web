<?php 

require_once __DIR__. '/../config/database.php';
class Sach {
    private $conn;
    private $table = 'sach';

    private $id;
    private $ten_sach;
    private $anh;
    private $tac_gia;
    private $nha_xuat_ban;
    private $nam_xuat_ban;
    private $the_loai;
    private $so_luong;
    private $created_at;
    private $db;
    public function __construct() {
        $this->db = DB::getInstance()->getConnection();
    }


    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findByTenSach($ten_sach) {
        $query = "SELECT * FROM $this->table WHERE ten_sach = :ten_sach";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ten_sach', $ten_sach);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findByTacgia($tac_gia) {
        $query = "SELECT * FROM $this->table WHERE tac_gia = :tac_gia";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tac_gia', $tac_gia);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchBooks($criteria, $value) {
        $query = "SELECT * FROM $this->table WHERE $criteria LIKE :value";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':value', "%$value%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByNhaxuatban($nha_xuat_ban) {
        $query = "SELECT * FROM $this->table WHERE nha_xuat_ban = :nha_xuat_ban";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nha_xuat_ban', $nha_xuat_ban);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $query = "INSERT INTO $this->table (ten_sach, anh, tac_gia, nha_xuat_ban, nam_xuat_ban, the_loai, so_luong, created_at) VALUES (:ten_sach, :anh, :tac_gia, :nha_xuat_ban, :nam_xuat_ban, :the_loai, :so_luong, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':ten_sach', $data['ten_sach']);
        $stmt->bindParam(':anh', $data['anh']);
        $stmt->bindParam(':tac_gia', $data['tac_gia']);
        $stmt->bindParam(':nha_xuat_ban', $data['nha_xuat_ban']);
        $stmt->bindParam(':nam_xuat_ban', $data['nam_xuat_ban']);
        $stmt->bindParam(':the_loai', $data['the_loai']);
        $stmt->bindParam(':so_luong', $data['so_luong']);
        return $stmt->execute();
    }

    public function update($id, $ten_sach, $anh, $tac_gia, $nha_xuat_ban, $nam_xuat_ban, $the_loai, $so_luong) {
        $query = "UPDATE $this->table SET ten_sach = :ten_sach, anh = :anh, tac_gia = :tac_gia, nha_xuat_ban = :nha_xuat_ban, nam_xuat_ban = :nam_xuat_ban, the_loai = :the_loai, so_luong = :so_luong, created_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ten_sach', $ten_sach);
        $stmt->bindParam(':anh', $anh);
        $stmt->bindParam(':tac_gia', $tac_gia);
        $stmt->bindParam(':nha_xuat_ban', $nha_xuat_ban);
        $stmt->bindParam(':nam_xuat_ban', $nam_xuat_ban);
        $stmt->bindParam(':the_loai', $the_loai);
        $stmt->bindParam(':so_luong', $so_luong);
        return $stmt->execute();
    }

    public function checkBookInCart($id) {
        $query = "SELECT COUNT(*) as total FROM gio_sach WHERE id_sach = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['total'] > 0;
    }
    
    public function deleteBookWithCheck($id) {
        if ($this->checkBookInCart($id)) {
            return "Không thể xóa sách vì đang có trong giỏ hàng.";
        }
    
        // Xóa sách
        $query = "DELETE FROM sach WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function delete($id) {
        try {
            $query = "DELETE FROM gio_sach WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $query = "DELETE FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

}

?>