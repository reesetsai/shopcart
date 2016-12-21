<?php
ini_set('display_errors', '1');
require_once("config.php");
$mysqli = new mysqli($host, $username, $password, $db_name); 
if($mysqli->connect_error) {
		die('Connect Error: ' . $mysqli->connect_error);
	}
$mysqli->query("SET NAMES utf8");
//取得首頁傳遞過來的資訊
$salt = "iwantmore";
if(!empty($_POST['user_name']) && !empty($_POST['user_password']) && !empty($_POST['chk_password'])){
	$user = $_POST['user_name'];
	$user_password = hash('sha512', $_POST['user_password'] . $salt);
	$chk_password  = hash('sha512', $_POST['chk_password'] . $salt);
	$gender = $_POST['gender'];
	$roc_id = $_POST['roc_id'];
	$datetime=date("y-m-d h:i:s");
	//確定用戶輸入的密碼一致
		if (get_magic_quotes_gpc()) {
			$user = stripslashes($user);
			$user_password = stripslashes($user_password);
			$chk_password  = stripslashes($chk_password);
			$user = mysql_real_escape_string($user);
			$user_password = mysql_real_escape_string($user_password);
			$chk_password  = mysql_real_escape_string($chk_password);
		}

		if($user_password != $chk_password){
					echo "$user_password<br>$chk_password<br>";
					echo "密碼不一致";
					echo "<meta http-equiv=REFRESH CONTENT=20;url=index.html>";
		}
		$result = $mysqli->query("SELECT user FROM members WHERE user = '$user'");
		    $row_cnt = $result->num_rows;
		if ($row_cnt !== 0) {
			echo "帳號已有人使用";
		}else{  
				$sql="INSERT INTO members(user, user_password, gender, roc_id, datetime)VALUES(?,?,?,?,?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("sssss", $user, $user_password, $gender, $roc_id, $datetime);
				$stmt->execute();
				if($stmt){
				echo "<br>註冊成功";
				echo "<br>將為您轉到會員登錄頁面";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
				}
		}						
}else{
	echo "欄位不得為空";
	echo '<button><a href="register.php">回上一頁</a></button>';
}
$mysqli->close();
?>