<?php
session_start();
include("index_head.php");
include("layout_container.php");
?>	      	 
    	<div class="col-md-6">
			<div id="imagecarousel" class="carousel slide" data-interval="2000" data-ride="carousel">
				<div class =carousel-inner>
				<?php 
					$query = "SELECT * FROM `goods` ORDER by id DESC LIMIT 4";
					$result = $mysqli->query($query);
					$counter = 1;
					while($rows = $result->fetch_array(MYSQLI_ASSOC)){
				?>
					<div class="item<?php if($counter <= 1){echo " active"; }?>">
					<?php	if($rows['pic'] !==""){
							echo "<a href='product.php?&id=".$rows["id"]."'><img id ='carouselpic' src='./pic/".$rows['pic']."' class='img-responsive'></a>";
						}
					?>
					</div>
				<?php
				$counter++;
				}
				$result->free_result();
				?>
				</div>
			</div>
		</div>
		<?php  
			if($_SESSION['user']) {
				echo "welcome &nbsp".$_SESSION['user'];
			}
			else{
				echo <<<EOT
			<div class="hidden-xs col-sm-4">
				<label class="control-label col-sm-12"><h2>會員登入</h2></label>
				<form class="form-horizontal" action ="login_chk.php" method="post">
					<div class="form-group">
		      			<label class="control-label col-sm-3">帳號:</label>
		      				<div class="col-sm-8">
		        				<input class="form-control" id="user_name" type="text" name="user_name">
		      				</div>
		    		</div>
		    		<div class="form-group">
		      			<label class="control-label col-sm-3">密碼:</label>
		      			<div class="col-sm-8">
		        			<input class="form-control" id="user_password" type="password" name="user_password">
		      			</div>
		    		</div>
		    		<div class="form-group">        
	      				<div class="col-sm-offset-4 col-sm-6">
	        			<button type="submit" class="btn btn-default">登入</button> <button type="reset" class="btn btn-default">重新輸入</button>
	        			</div>
	        		</div>
	        		<div class="col-sm-offset-9 col-sm-2"><a href="register.html">註冊</a></div>
	        		<div class="col-sm-offset-8 col-sm-3"><a href="">忘記密碼</a></div>
				</form>
			</div>
EOT;
}
?>
	</div>
		<div class="row">
			<div class="col-sm-2">
				<h3>最新上架</h3>
			</div>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">最新上架</a></li>
			    <li><a data-toggle="tab" href="#menu1">電影</a></li>
			    <li><a data-toggle="tab" href="#menu2">電視劇</a></li>
			    <li><a data-toggle="tab" href="#menu3">小說</a></li>
			    <li><a data-toggle="tab" href="#menu4">音樂</a></li>
		 	</ul>
		</div>
	<div class="tab-content">
	    <div id="home" class="cool tab-pane fade in active" >
	    <?php
	    $query = "SELECT * FROM `goods` ORDER by datetime DESC LIMIT 4";
	    $result = $mysqli->query($query);
	    $row_cnt = $result->num_rows;
	    while($rows = $result->fetch_array(MYSQLI_ASSOC))
	    {	
	    ?>	
		    <div class="col-xs-12 col-sm-3">
		      <tr>
		      <?php if($rows['pic'] !==""){
		      			echo "<a href='product.php?&id=".$rows["id"]."'><th><img src='./pic/".$rows['pic']."' class='img-thumbnail' style='width:300px;height:300px;'></th></a>";
		      		}
		      ?>
		      </tr>
		    </div>
			<?php
			}
			if($row_cnt ==0){
				echo '<div class="cow col-xs-12 col-sm-3"></div>';
			}elseif($row_cnt==4){
				echo '<div class="col-sm-offset-11 col-sm-2"><a href="./goods.php?type=all">更多圖片</a></div>';
			}
			$result->free_result();
			?>		    
		</div>
	    <div id="menu1" class="tab-pane fade">
	    <?php
	    	$query = "SELECT * FROM `goods` WHERE type ='movie' ORDER by datetime DESC LIMIT 4";
	    	$result = $mysqli->query($query);
	    	$row_cnt = $result->num_rows;
	    	while($rows = $result->fetch_array(MYSQLI_ASSOC))
	    	{
	    ?>
		    <div class="col-xs-12 col-sm-3">
		      <tr>
		      <?php if($rows['pic'] !==""){
		      			echo "<a href='product.php?&id=".$rows["id"]."'><th><img src='./pic/".$rows['pic']."' class='img-thumbnail' style='width:300px;height:300px;'></th></a>";
		      		}
		      ?>
		      </tr>
		    </div>
			<?php
			}
			if($row_cnt ==0){
				echo '<div class="cow col-xs-12 col-sm-3"></div>';
			}elseif($row_cnt==4){
				echo '<div class="col-sm-offset-11 col-sm-2"><a href="./goods.php?type=movie">更多圖片</a></div>';
			}
			$result->free_result();
			?>
	    </div>
	    <div id="menu2" class="tab-pane fade">
	    <?php
	    	$query = "SELECT * FROM `goods` WHERE type ='series' ORDER by datetime DESC LIMIT 4";
	    	$result = $mysqli->query($query);
	    	$row_cnt = $result->num_rows;
	    	while($rows = $result->fetch_array(MYSQLI_ASSOC))
	    	{
	    ?>
	     	<div class="col-xs-12 col-sm-3">
		      <tr>
		      <?php if($rows['pic'] !==""){
		      			echo "<a href='product.php?&id=".$rows["id"]."'><th><img src='./pic/".$rows['pic']."' class='img-thumbnail' style='width:300px;height:300px;'></th></a>";
		      		}
		      ?>
		      </tr>
		    </div>
			<?php
			}
			if($row_cnt ==0){
				echo '<div class="cow col-xs-12 col-sm-3"></div>';
			}elseif($row_cnt==4){
				echo '<div class="col-sm-offset-11 col-sm-2"><a href="./goods.php?type=series">更多圖片</a></div>';
			}
			$result->free_result();
			?>
	    </div>
	    	    <div id="menu3" class="tab-pane fade">   	    
	    <?php
	    	$query = "SELECT * FROM `goods` WHERE type ='novel' ORDER by datetime DESC LIMIT 4";
	    	$result = $mysqli->query($query);
	    	$row_cnt = $result->num_rows;
	    	while($rows = $result->fetch_array(MYSQLI_ASSOC))
	    	{
	    ?>
	     	<div class="col-xs-12 col-sm-3">
		      <tr>
		      <?php if($rows['pic'] !==""){
		      			echo "<a href='product.php?&id=".$rows["id"]."'><th><img src='./pic/".$rows['pic']."' class='img-thumbnail' style='width:300px;height:300px;'></th></a>";
		      		}
		      ?>
		      </tr>
		    </div>
			<?php
			}
			if($row_cnt ==0){
				echo '<div class="cow col-xs-12 col-sm-3"></div>';
			}elseif($row_cnt==4){
				echo '<div class="col-sm-offset-11 col-sm-2"><a href="./goods.php?type=novel">更多圖片</a></div>';
			}
			$result->free_result();
			?>
	    </div>
	    <div id="menu4" class="tab-pane fade">
<?php
	    	$query = "SELECT * FROM `goods` WHERE type ='music' ORDER by datetime DESC LIMIT 4";
	    	$result = $mysqli->query($query);
	    	$row_cnt = $result->num_rows;
	    	while($rows = $result->fetch_array(MYSQLI_ASSOC))
	    	{
	    ?>
	     	<div class="col-xs-12 col-sm-3">
		      <tr>
		      <?php if($rows['pic'] !==""){
		      			echo "<a href='product.php?&id=".$rows["id"]."'><th><img src='./pic/".$rows['pic']."' class='img-thumbnail' style='width:300px;height:300px;'></th></a>";
		      		}
		      ?>
		      </tr>
		    </div>
			<?php
			}
			if($row_cnt ==0){
				echo '<div class="cow col-xs-12 col-sm-3"></div>';
			}elseif($row_cnt==4){
				echo '<div class="col-sm-offset-11 col-sm-2"><a href="./goods.php?type=music">更多圖片</a></div>';
			}
			$result->free_result();
			?>
		</div>
		<div class="row down">
			<div class="col-sm-2">
				<h3>人氣商品</h3>
			</div>
		</div>
		<div class="tab-content">
		    <div id="home" class="tab-pane fade in active">

			    <div class="col-xs-12 col-sm-3">
			      <tr>
			      	<th><img src="./pic/beauty2.jpg" class="img-thumbnail" style="width:300px;height:300px;"></th>
			      </tr>
			    </div>
			    <div class="col-xs-12 col-sm-3">
			      <tr>
			      	<th><img src="./pic/beauty2.jpg" class="img-thumbnail" style="width:300px;height:300px;"></th>
			      </tr>
			    </div>
			    <div class="col-xs-12 col-sm-3">
			      <tr>
			      	<th><img src="./pic/beauty2.jpg" class="img-thumbnail" style="width:300px;height:300px;"></th>
			      </tr>
			    </div>
			      <div class="col-xs-12 col-sm-3">
			      <tr>
			      	<th><img src="./pic/beauty2.jpg" class="img-thumbnail" style="width:300px;height:300px;"></th>
			      </tr>
			    </div>		    
			</div>
			<div class="col-sm-offset-11 col-sm-2"><a href="">更多圖片</a></div>
		</div>
	</div>
</div>
<?php include("layout_footer.php"); ?>
