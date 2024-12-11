<?php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once __DIR__ . '/../config/database.php';
class ThuThu
{
    private $db;
    private $table = 'thu_thu';

    public function __construct()
    {
        // Kết nối database
        $this->db = DB::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addLibrarian($user_id, $ten, $ngay_sinh, $email, $sdt, $anh)
    {
        $query = "INSERT INTO $this->table (user_id, ten, ngay_sinh, email, sdt, anh, created_at) 
                VALUES (:user_id, :ten, :ngay_sinh, :email, :sdt, :anh, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':anh', $anh);
        return $stmt->execute();
    }

    public function updateLibrarian($id, $ten, $ngay_sinh, $email, $sdt, $anh)
    {
        $query = "UPDATE $this->table SET ten = :ten, ngay_sinh = :ngay_sinh, email = :email, sdt = :sdt, anh = :anh WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sdt', $sdt);
        $stmt->bindParam(':anh', $anh);
        return $stmt->execute();
    }

    public function removeLibrarian($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
