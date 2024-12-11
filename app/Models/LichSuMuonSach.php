<?php
require_once __DIR__ . '/../config/database.php';
class LichSuMuonSach
{
    private $conn;
    private $table = 'muon_tra';

    private $id;
    private $id_gio;
    public $id_user;
    private $ngay_muon;
    private $ngay_hen_tra;
    private $ngay_tra;
    private $tinh_trang;
    public function __construct()
    {
        $this->conn = DB::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT muon_tra.id, doc_gia.ten, sach.ten_sach, muon_tra.ngay_muon, muon_tra.ngay_hen_tra, muon_tra.ngay_tra, muon_tra.tinh_trang
                FROM muon_tra
                INNER JOIN users ON muon_tra.id_user = users.id
                INNER JOIN doc_gia ON users.id = doc_gia.user_id
                INNER JOIN gio_sach ON muon_tra.id_gio = gio_sach.id
                INNER JOIN sach ON gio_sach.id_sach = sach.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addBook($id_user, $id_gio, $ngay_muon, $ngay_hen_tra, $tinh_trang)
    {
        $query = "INSERT INTO muon_tra (id_user, id_gio, ngay_muon, ngay_hen_tra, tinh_trang) VALUES (:id_user, :id_gio, :ngay_muon, :ngay_hen_tra, :tinh_trang)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_gio', $id_gio);
        $stmt->bindParam(':ngay_muon', $ngay_muon);
        $stmt->bindParam(':ngay_hen_tra', $ngay_hen_tra);

        $stmt->bindParam(':tinh_trang', $tinh_trang);
        return $stmt->execute();
    }

    public function removeBook($id_gio, $id_user)
    {
        $query = "DELETE FROM $this->table WHERE id_gio = :id_gio AND id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_gio', $id_gio);
        $stmt->bindParam(':id_user', $id_user);
        return $stmt->execute();
    }

    public function getHistory()
    {
        $query = "SELECT sach.ten_sach, muon_tra.ngay_muon, muon_tra.ngay_tra 
                FROM muon_tra 
                INNER JOIN gio_sach ON muon_tra.id_gio = gio_sach.id
                INNER JOIN sach ON gio_sach.id_sach = sach.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getHistoryByReader($id_user)
    {
        $query = "SELECT sach.ten_sach, muon_tra.ngay_muon, muon_tra.ngay_tra 
                FROM muon_tra 
                INNER JOIN gio_sach ON muon_tra.id_gio = gio_sach.id
                INNER JOIN sach ON gio_sach.id_sach = sach.id
                WHERE muon_tra.id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Tra sach
    public function returnBook($id_gio) {
        $query = "UPDATE muon_tra SET ngay_tra = NOW() WHERE id_gio = :id_gio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_gio', $id_gio, PDO::PARAM_INT);

        return $stmt->execute();
    }
     
    public function checkExistingBorrow($id_user, $id_gio) {
        $query = "SELECT COUNT(*) as tontai FROM $this->table WHERE id_user = :id_user AND id_gio = :id_gio";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_gio', $id_gio);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['tontai'] > 0;
    }

    public function updateTrangThai($id, $tinh_trang)
    {
        $sql = "UPDATE muon_tra SET tinh_trang = :tinh_trang WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tinh_trang', $tinh_trang);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Điều kiện cập nhật trạng thái theo id

        return $stmt->execute();
    }
}
