<?php 
class DB {
    private $host = 'localhost';
    private $db_name = 'qltv_mvc';
    private $username = 'root';
    private $password = '';
    private $conn;
    private static $instance = null;
    private $connection;

    private function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=qltv_mvc', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
    
}
?>