<?php
session_start();
require_once '../../Controllers/BookController.php';

$bookController = new BookController();
$bookController->addToCart();