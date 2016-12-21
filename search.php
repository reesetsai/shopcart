<?php
require_once("config.php");
include("product_head.php");
$keyword = isset($_GET['search']) ? ($_GET['search']) : "";
//當前的分頁,若不指定則於第一頁
$page = isset($_GET['page']) ? ($_GET['page']) : 1;
$sql = "SELECT * FROM `goods` WHERE (name LIKE '%$keyword%') OR (price LIKE '%$keyword%') OR (type LIKE '%$keyword%')";
$res_query = $mysqli->query($sql);
$nums_cnt = $res_query->num_rows;
//每頁顯示的資料數
$num_per_page = 5;
//從哪一筆資料開始取得
$start = ($page-1)*$num_per_page;
//分頁總頁數
$totalpages = ceil($nums_cnt/$num_per_page);
if($page>$totalpages && $totalpages>=1) {
	$page = $totalpages;
	header('Location: search.php?search='.$keyword.'&page='.$totalpages);
}elseif($page<1){
	$page = 1;
	header('Location: search.php?search='.$keyword.'&page='.$page);
}

//若輸入不為空
function pages(){
	global $page;
	global $totalpages;
	global $keyword;
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
			$list.="<a href ='search.php?search=".$keyword."&page=".$prev."'>".$prev."</a>";
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
		$list.="<a href ='search.php?search=".$keyword."&page=".$next."'>".$next."</a>";
		}
		else{
			break;
		}
	}
	return $list;
}
if($keyword !== ""){
//從第$start開始查詢到$num_per_page條
$query = "SELECT * FROM `goods` WHERE (name LIKE '%$keyword%') OR (price LIKE '%$keyword%') OR (type LIKE '%$keyword%') LIMIT $start, $num_per_page";
$result = $mysqli->query($query);
$row_cnt = $result->num_rows;
if(!isset($row_cnt)){
	$row_cnt = 0;
}
}else{
	echo "<div class='alert alert-danger'>";
	echo "請輸入您要找的相關資訊";
	echo "</div>";
}
if($nums_cnt>0 && $row_cnt>0){	
	echo "<div class='alert alert-info'>";
	echo "共找到&nbsp".$nums_cnt."&nbsp條相關內容,本頁顯示&nbsp".$row_cnt."&nbsp條";
	echo "</div>";							
	while($rows = $result->fetch_array(MYSQLI_ASSOC)){
		echo "<div class='row'>";
		echo '<li style="list-style-type:none"><h3><a href ='.'product.php?id='.$rows["id"].'>'.$rows['name'].'</a></h3></li>';
		echo '<li style="list-style-type:none"><h4>'.$rows['pic']."</h4></li>";
		echo "</div>";
	}

}
if($keyword !== "" && $row_cnt == 0){
	echo "<div class='alert alert-danger'>";
	echo "沒有找到任何&nbsp".$keyword."&nbsp相關內容";
	echo "</div>";	
}
if($nums_cnt>5 && $row_cnt>0){
echo "<ul class='al pagination pagination-sm'>";
echo "<li>".pages()."</li>";
echo "</ul>";
}
include("layout_footer.php");