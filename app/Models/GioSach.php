<?php
require_once __DIR__ . '/../config/database.php';
class GioSach
{
    private $conn;
    private $db;
    private $table = 'gio_sach';

    public $id;
    public $id_sach;
    public $id_nguoi_muon;
    public $trang_thai;

    public function __construct()
    {
        $this->db = DB::getInstance()->getConnection();
    }

    public function getBooksInCart($user_id)
    {
        $query = "
            SELECT gio_sach.id, sach.ten_sach, sach.tac_gia, sach.nha_xuat_ban, sach.anh, gio_sach.id_sach
            FROM gio_sach
            INNER JOIN sach ON gio_sach.id_sach = sach.id
            WHERE gio_sach.id_user = :id_user
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng chứa thông tin sách
    }

    public function addBook($id_user, $id_sach)
    {
        // Kiểm tra nếu sách đã có trong giỏ
        $query = "SELECT COUNT(*) FROM $this->table WHERE id_user = :id_user AND id_sach = :id_sach";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sach', $id_sach);
        $stmt->execute();
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            // Nếu sách đã có trong giỏ
            throw new Exception("Sách này đã có trong giỏ của bạn.");
        }

        // Thêm sách vào giỏ
        $query = "INSERT INTO $this->table (id_user, id_sach) VALUES (:id_user, :id_sach)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sach', $id_sach);
        return $stmt->execute();
    }


    public function removeBook($id)
    {
        $query = "DELETE FROM $this->table WHERE gio_sach.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getBooksById($id)
    {
        // Lấy thông tin độc giả và sách từ giỏ sách
        $sql = "SELECT doc_gia.ten, sach.ten_sach, sach.tac_gia, sach.nha_xuat_ban
            FROM gio_sach
            INNER JOIN users ON gio_sach.id_user = users.id
            INNER JOIN doc_gia ON users.id = doc_gia.user_id
            INNER JOIN sach ON gio_sach.id_sach = sach.id
            WHERE gio_sach.id_sach = :id"; // Điều kiện lấy sách của độc giả theo user_id

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về tất cả các kết quả từ truy vấn
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
