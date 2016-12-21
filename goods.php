<?php
include("config.php");
//載入head
include("layout_head.php");
include("layout_container.php");
$type = (isset($_GET['type'])) ? $_GET['type'] : 'all';
//當前的分頁,若不指定則於第一頁
$page = isset($_GET['page']) ? ($_GET['page']) : 1;
if($type == 'all'){
	//搜尋資料庫
	$sql = "SELECT * FROM `goods`";
	$res = $mysqli->query($sql);
	//資料庫所有資料
	$row_cnt = $res->num_rows;
	//每頁顯示的資料數
	$num_per_page = 9;
	$start = ($page-1)*$num_per_page;
	//分頁總頁數
	$totalpages = ceil($row_cnt/$num_per_page);
}else{
	$sql = "SELECT * FROM `goods` WHERE type = '$type'";
	$res = $mysqli->query($sql);
	//資料庫所有資料
	$row_cnt = $res->num_rows;
	//每頁顯示的資料數
	$num_per_page = 9;
	$start = ($page-1)*$num_per_page;
	//分頁總頁數
	$totalpages = ceil($row_cnt/$num_per_page);
}
if($page>$totalpages && $totalpages>=1) {
$page = $totalpages;
	header('Location: goods.php?type='.$type.'&page='.$totalpages);
}elseif($page<1){
	$page = 1;
	header('Location: goods.php?type='.$type.'&page='.$page);
}
function pages(){
	global $page;
	global $totalpages;
	global $type;
	$list ="";
	$next ="";
	$prev ="";
	$num = 2;
	//當前頁之前
	for($i=$num;$i>=1;$i--){
			//如果當前為2, 第一次循環 $prev = 2-2 =0, 第二次循環 $prev = 2-1 =1 
			$prev = $page -$i;
			//檢查上一頁是否大於=1,避免上一頁為負數
			if($prev >=1){
			$list.="<a href ='goods.php?type=".$type."&page=".$prev."'>".$prev."</a>";
			}
	}
	//當前頁
	if($page >1){
		//如當前頁$page存在則
		$list .= "<a href ='#'>".$page.'</a>';
	}
	//當前頁之後
	for($i=1;$i<=$num;$i++){
		//ex $page =3, 1:$next = 3+1 =4 2: $next =3+2 =5
		$next = $page +$i;
		//若$next <= totalpages 才執行避免 下一頁大於末頁
		if($next<=$totalpages){
		$list.="<a href ='goods.php?type=".$type."&page=".$next."'>".$next."</a>";
		}
		else{
			break;
		}
	}
	return $list;
}
	if($type == 'all'){
		echo '<div class="col-md-10">';
		echo '<ul id = "fs1">';
		$query = "SELECT * FROM `goods` ORDER by datetime DESC LIMIT $start, $num_per_page ";
		$result = $mysqli->query($query);
			if($row_cnt>0){
		      	while($rows = $result->fetch_array(MYSQLI_ASSOC))
				{
			      	echo '<li>';
			      	echo	 '<div>';
			      		if($rows['pic'] !==""){
			      			$pic=$rows['pic'];
			      			echo "<img src= './pic/$pic'>";
			      		}		      		
				    echo  		'<a href ='.'product.php?&id='.$rows["id"].'><p>'.$rows["name"].'</p></a>';
			      	echo	'</div>';
			      	echo '</li>';
				}		
			}else{
				echo "<div class='alert alert-danger'>";
				echo "沒有找到您要的商品";
				echo "</div>";
			}
	}else{
			echo '<div class="col-md-10">';
			echo '<ul id = "fs1">';
			$query = "SELECT * FROM `goods` WHERE type = '$type' ORDER by datetime DESC LIMIT $start, $num_per_page ";
			$result = $mysqli->query($query);
			$row_cnt = $result->num_rows;
			if($row_cnt>0){
		      	while($rows = $result->fetch_array(MYSQLI_ASSOC))
				{
			      	echo '<li>';
			      	echo	 '<div>';
			      		if($rows['pic'] !==""){
			      			$pic=$rows['pic'];
			      			echo "<img src= './pic/$pic'>";
			      		}		      		
				    echo  		'<a href ='.'product.php?&id='.$rows["id"].'><p>'.$rows["name"].'</p></a>';
			      	echo	'</div>';
			      	echo '</li>';
				}		
			}else{
				echo "<div class='alert alert-danger'>";
				echo "沒有找到您要的商品";
				echo "</div>";
			}
	}
	echo "</ul>";
	echo "</div>";
	echo "</div>";
	if($row_cnt>9){
		echo "<div class = 'col-sm-offset-7'>";
		echo "<ul class='al pagination pagination-sm'>";
		echo "<li>".pages()."</li>";
		echo "</ul>";
		echo "</div>";
	}
	echo "</div>";

$result->free_result();
$mysqli->close();

include("layout_footer.php");