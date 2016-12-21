<?php
session_start();
ini_set('display_errors', '1');
require_once("config.php");
$mysqli = new mysqli($host, $username, $password, $db_name); 
if($mysqli->connect_error) {
		die('Connect Error: ' . $mysqli->connect_error);
	}
$mysqli->query("SET NAMES utf8");
//前台會員登錄
$salt = "iwantmore"; //加密字串iwantmore
//若user,user_password不為空
if(!empty($_POST['user_name']) && !empty($_POST['user_password'])){
	$user = $_POST['user_name'];
	$user_password = hash('sha512',$_POST['user_password'].$salt);
//user,user_password拿掉符號和空格
	if (get_magic_quotes_gpc()) {
			$user = stripslashes($user);
			$user_password = stripslashes($user_password);
			$user = mysql_real_escape_string($user);
			$user_password = mysql_real_escape_string($user_password);
		}
	if($stmt = $mysqli->prepare("SELECT id, user, user_password FROM members WHERE user = ? and user_password = ?")){
		 	$stmt->bind_param('ss', $user, $user_password);
		    $stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $user, $user_password);
			$stmt->fetch();
	}
	if ($stmt->num_rows == 1) {
		$_SESSION['user'] = $user;
		header('Location: index.php');
		}else {
		echo "<meta http-equiv=REFRESH CONTENT=15;url=login.php>";
		}
}else{
	    echo "欄位不得為空";
		echo '<button><a href="login.html">回上一頁</a></button>';
}
