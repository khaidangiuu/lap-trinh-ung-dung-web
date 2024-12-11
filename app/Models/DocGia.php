<?php 

require_once __DIR__. '/../config/database.php';
class DocGia {
    private $conn;
    private $table = 'doc_gia';

    private $id;
    private $ten;
    private $ngay_sinh;
    private $khoa_hoc;
    private $khoa_cn;
    private $anh;

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

    // public function addReader($readerData) {
    //     $query = "INSERT INTO $this->table (ten, ngay_sinh, khoa_hoc, khoa_cn, anh, created_at) VALUES (:ten, :ngay_sinh, :khoa_hoc, :khoa_cn, :anh, NOW())";
    //     $stmt = $this->conn->prepare($query);
    //     return $stmt->execute([
    //             ':ten' => $readerData['ten'],
    //             ':ngay_sinh' => $readerData['ngay_sinh'],
    //             ':khoa_hoc' => $readerData['khoa_hoc'],
    //             ':khoa_cn' => $readerData['khoa_cn'],
    //             ':anh' => $readerData['anh']
    //         ]);
    // }

    public function updateReader($id, $ho_ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh) {
        $query = "UPDATE $this->table SET ten = :ho_ten, ngay_sinh = :ngay_sinh, khoa_hoc = :khoa_hoc, khoa_cn = :khoa_cn, anh = :anh WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':ho_ten', $ho_ten);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':khoa_hoc', $khoa_hoc);
        $stmt->bindParam(':khoa_cn', $khoa_cn);
        $stmt->bindParam(':anh', $anh);
        return $stmt->execute();
    }

    public function removeReader($id) {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function findByUserId($user_id) {
        try {
            $query = "SELECT * FROM doc_gia WHERE user_id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            
            // // In ra số lượng bản ghi
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // // Nếu không tìm thấy
            // if (!$result) {
            //     echo "Không tìm thấy độc giả với user_id: $user_id";
            //     return null;
            // }
            
            // // In ra thông tin độc giả để kiểm tra
            // var_dump($result);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // In ra lỗi chi tiết
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function addReader1($user_id, $ten, $ngay_sinh, $khoa_hoc, $khoa_cn, $anh) {
        $query = "INSERT INTO doc_gia (user_id, ten, ngay_sinh, khoa_hoc, khoa_cn, anh, created_at) 
                  VALUES (:user_id, :ten, :ngay_sinh, :khoa_hoc, :khoa_cn, :anh, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':ten', $ten);
        $stmt->bindParam(':ngay_sinh', $ngay_sinh);
        $stmt->bindParam(':khoa_hoc', $khoa_hoc);
        $stmt->bindParam(':khoa_cn', $khoa_cn);
        $stmt->bindParam(':anh', $anh);
        return $stmt->execute();
    }
    

}

?>