<?php
// app/Controllers/BaseController.php

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(dirname(dirname(__FILE__))));
}

abstract class BaseController {
    protected function view($viewPath, $data = []) {
        // Trích xuất dữ liệu để sử dụng trong view
        extract($data);
        
        // Đường dẫn đầy đủ tới view
        $fullViewPath = ROOT_PATH . '/app/Views/' . str_replace('.', '/', $viewPath) . '.php';
        //require_once ROOT_PATH . "/app/Views/{$viewPath}.php";
        
        if (file_exists($fullViewPath)) {
            // Nhúng header nếu cần
            //require_once ROOT_PATH . '/app/Views/Shared/header.php';
            
            // Hiển thị view chính
            require_once $fullViewPath;
            
            // Nhúng footer nếu cần
           // require_once ROOT_PATH . '/app/Views/Shared/footer.php';
        } else {
            // Xử lý lỗi nếu view không tồn tại
            die("View not found: " . $fullViewPath);
        }
    }

    protected function model($modelName) {
        $modelPath = ROOT_PATH . '/app/Models/' . $modelName . '.php';
        
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $modelName();
        }
        
        die("Model not found: " . $modelName);
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }

    protected function checkAuth($requiredRole = null) {
        session_start();
        
        if (!isset($_SESSION['user'])) {
            $this->redirect('/login');
        }
        
        if ($requiredRole && $_SESSION['user']['role'] !== $requiredRole) {
            // Chuyển hướng hoặc báo lỗi quyền truy cập
            $this->redirect('/');
        }
    }
}