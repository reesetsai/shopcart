<?php
session_start();
include("config.php");
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	$id ="";
}
$action = isset($_GET['action']) ?  $_GET['action'] : "";

if($_SESSION['user']){

	if(!isset($_SESSION["cart_items"])){
	    $_SESSION["cart_items"] = array();
	}

	if(array_key_exists($id, $_SESSION["cart_items"])){
	    // redirect to product list and tell the user it was added to cart
	    header('Location: product.php?action=exists&id=' . $id);
	}else{
		$_SESSION["cart_items"][$id]=$id;
		header('Location: product.php?action=add&id=' . $id);
	}
}else{
	header('Location: login.php?login=1');
}

