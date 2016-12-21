<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.js"></script>
<title> 會員登錄 </title>
</head>
<style type="text/css">
 	label{
		display:inline;
	}


</style>
<script type= "text/javascript">
$(document).ready(function (){
			var validator = 
				$("#login").bootstrapValidator({
					fields : {
						user_name :{
							validators: {
								notEmpty: {
									message: '請輸入帳號'
							},
							stringLength: {
									min: 2,
									max: 10,
									message: '帳號最少有兩個字元'
							},
							regexp: {		
									regexp: /^[a-zA-Z0-9_\.]+$/,
									message: '帳號不得有符號'
							}
						}
					},
					user_password :{
							validators: {
								notEmpty: {
									message: '密碼不得空白'
							},
							stringLength: {
									min: 2,
									max: 10,
									message: '帳號最少有兩個字元'
							},
							regexp: {		
									regexp: /^[a-zA-Z0-9_\.]+$/,
									message: '帳號不得有符號'
							}
						}
					},
				}	
		})
});	
</script>
<body>
	<?php 
			$login = ($_GET['login']) ? $_GET['login'] : "";
			if($login == 1){
		  	echo "<div class='alert alert-info'>";
        	echo "<strong>請先登錄後才能下單</strong>";
    		echo "</div>";
			} 
	?>
	<div class="container">
		<form class="form-horizontal" action ="login_chk.php" method="post" id = "login">
			<div class="">
			<h2 style="text-align:center;">會員登錄  帳號 : root 密碼 : 123456</h2>
			<div class="form-group">
				<label class="col-sm-offset-2 control-label col-sm-2">帳號:</label>
					<div class="col-sm-4">
						<input class="form-control" id="user_name" type="text" name="user_name">
	      			</div>
	    	</div>
			<div class="form-group">
				<label class="col-sm-offset-2 control-label col-sm-2">密碼:</label>
					<div class="col-sm-4">
						<input class="form-control" id="user_password" type="password" name="user_password">
	      			</div>
	    	</div>
	    	<div class="form-group">  
	    		<div class="col-sm-offset-6 col-sm-2">
					<button type="submit" class="btn btn-default">登入</button> <button type="reset" class="btn btn-default">重新輸入</button>
				</div>
			</div>
			<div class="col-sm-offset-7 col-sm-2"><a href="register.php">註冊</a></div>
        	<div class="col-sm-offset-7 col-sm-2"><a href="#">忘記密碼</a></div>
		</form>		
	</div>
</body>
</html>