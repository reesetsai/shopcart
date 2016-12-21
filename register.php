<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title> 會員註冊 </title>
</head>
<body>
<script type= "text/javascript">
$(document).ready(function (){
			var validator = 
				$("#register").
					bootstrapValidator({
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
						phone : {
							validators: {
								notEmpty : {
										message: '請輸入電話'
								},
							regexp: {
									regexp:  /^[09]{2}[0-9]{8}$/,
									message: '為無效的手機號碼'
							}
						}
					},
						roc_id : {
							validators: {
								notEmpty: {
									message: '身分證字號不得空白'
								},
								callback: {
									callback: function (value, validator, $field) {
										
										var value = value.toUpperCase();
										var weight = [8,7,6,5,4,3,2,1,1];
												
										var ide = "ABCDEFGHJKLMNPQRXTUVXYWZIO"
												
										var head = 10 + ide.indexOf(value[0]);
												
										var result = Math.floor(head/10)+ (head%10)*9;
												
									for(var i = 1;i <10;i++){
												result += value[i]*weight[i-1];
									}
								
							if (value === ''){ 
											return true;
							}
								if(value.length !== 10){
									return{
											valid: false,
											message: '身分證為10碼'
									}
								}
									if(result %10 !== 0){
										return{
											valid: false,
											message: '不正確的身分證請在檢查一次'
										}
								}
									if(result %10 === 0 && value[0] == 'V' || value[0] == 'U'){
										return{
											valid: true,
											message: '花東鄉親填問券送優惠'
										}
								}
									if(result %10 === 0 ){
										return{
											valid: true,
											message: ' '
										}
								}
							}
                        }
                    }
                },
							gender :{
								validators: {
									notEmpty: {
												message: '至少勾選一個'
									}
								}
							},
				}	
		})
});	
</script>
<div class="container">
	<form class="form-horizontal" id = "register" action ="chk.php" method="post">
		<h2>會員註冊</h2>
		<div class="form-group">
			<label class="col-sm-2 control-label">使用者名稱:</label>
				<div class="col-sm-4">
					<input class="form-control" id="user_name" type="text" name="user_name">
      			</div>
    	</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">密碼:</label>
				<div class="col-sm-4">
					<input class="form-control" id="user_password" type="password" name="user_password">
      			</div>
    	</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">重複密碼:</label>
				<div class="col-sm-4">
					<input class="form-control" id="chk_password" type="password" name="chk_password">
      			</div>
    	</div>
    	<div class="form-group">
			<label class="col-sm-2 control-label">性別:</label>
			<label class="col-sm-1 control-label">男</label>
				<div class="col-sm-1">
					<input class="form-control" id="male" type="checkbox" name="gender">
      			</div>
      		<label class="col-sm-1 control-label">女</label>
      			<div class="col-sm-1">
					<input class="form-control" id="female" type="checkbox" name="gender">
      			</div>
    	</div>
    	<div class="form-group">
			<label class="col-sm-2 control-label">身分證字號</label>
				<div class="col-sm-4">
					<input class="form-control" id="roc_id" type="text" name="roc_id" style="text-transform:uppercase";>
      			</div>
    	</div>
			<button type="submit" class="btn btn-info">註冊</button>
			<button type="reset" class="btn btn-info">取消</button>
	</form>
			<button type="buttons" class="btn btn-info"><a href="login.php">回上一頁</a></button>
</div>
</body>
</html>