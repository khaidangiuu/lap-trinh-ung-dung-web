<?php
require_once __DIR__. '/../../Controllers/TaiKhoanController.php';

$authController = new TaiKhoanController();
$authController->logout();

header('Location: login.php');
?>
