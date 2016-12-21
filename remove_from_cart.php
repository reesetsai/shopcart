<?php
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : "die";
//變數id存在的話將$_SESSION的值刪除
if($id = $_GET['id']){
	unset($_SESSION['cart_items'][$id]);
	header('Location: cart.php?page=product&action=removed');
}
