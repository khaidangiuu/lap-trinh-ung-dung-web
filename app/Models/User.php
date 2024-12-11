<?php
// app/Models/User.php
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__, 2));
}
require_once __DIR__. '/../config/database.php';

class User {
    private $db;

    public function __construct() {
        // Kết nối database
        $this->db = DB::getInstance()->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy người dùng theo email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy người dùng theo username
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo người dùng mới
    public function createUser($userData) {
        $sql = "INSERT INTO users (username, email, password, role, created_at) VALUES (:username, :email, :password, :role, NOW())";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':username' => $userData['username'],
            ':email' => $userData['email'],
            ':password' => $userData['password'],
            ':role' => $userData['role']
        ]);
    }

    // Lưu token đặt lại mật khẩu
    public function saveResetToken($userId, $token, $expiry) {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET reset_token = :token, 
                reset_token_expiry = :expiry 
            WHERE id = :user_id
        ");

        return $stmt->execute([
            ':token' => $token,
            ':expiry' => $expiry,
            ':user_id' => $userId
        ]);
    }

    // Lấy người dùng theo token đặt lại mật khẩu
    public function getUserByResetToken($token) {
        $stmt = $this->db->prepare("
            SELECT * FROM users 
            WHERE reset_token = :token 
            AND reset_token_expiry > NOW()
        ");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật mật khẩu mới
    public function updatePassword($userId, $newPassword) {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET password = :password, 
                reset_token = NULL, 
                reset_token_expiry = NULL 
            WHERE id = :user_id
        ");

        return $stmt->execute([
            ':password' => $newPassword,
            ':user_id' => $userId
        ]);
    }

    // Xóa token đặt lại mật khẩu
    public function clearResetToken($userId) {
        $stmt = $this->db->prepare("
            UPDATE users 
            SET reset_token = NULL, 
                reset_token_expiry = NULL 
            WHERE id = :user_id
        ");

        return $stmt->execute([
            ':user_id' => $userId
        ]);
    }

    // Cập nhật thông tin hồ sơ
    public function updateProfile($userId, $profileData) {
        $allowedFields = ['full_name', 'phone', 'address'];
        $updateFields = [];
        $params = [':user_id' => $userId];

        foreach ($allowedFields as $field) {
            if (isset($profileData[$field])) {
                $updateFields[] = "{$field} = :{$field}";
                $params[":{$field}"] = $profileData[$field];
            }
        }

        if (empty($updateFields)) {
            return false;
        }

        $stmt = $this->db->prepare("
            UPDATE users 
            SET " . implode(', ', $updateFields) . " 
            WHERE id = :user_id
        ");

        return $stmt->execute($params);
    }

    // Lấy thông tin chi tiết người dùng
    public function getUserDetails($userId) {
        $stmt = $this->db->prepare("
            SELECT id, username, email, role, full_name, 
                   phone, address, created_at 
            FROM users 
            WHERE id = :user_id
        ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra mật khẩu cũ
    public function verifyCurrentPassword($userId, $currentPassword) {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? password_verify($currentPassword, $user['password']) : false;
    }

    // Thay đổi mật khẩu
    public function changePassword($userId, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("
            UPDATE users 
            SET password = :password 
            WHERE id = :user_id
        ");

        return $stmt->execute([
            ':password' => $hashedPassword,
            ':user_id' => $userId
        ]);
    }
    public function addUser($username, $password, $email, $role) {
        $query = "INSERT INTO users (username, password, email, role, created_at) VALUES (:username, :password, :email, :role, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    
        return $this->db->lastInsertId(); // Trả về ID của user vừa thêm
    }
    
}