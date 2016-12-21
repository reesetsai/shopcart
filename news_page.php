<?php
include("config.php");
include("product_head.php");
$news_id=(isset($_GET['news_id'])) ? $_GET['news_id'] : "";
$query = "SELECT * FROM `news` WHERE id ='$news_id'";
$result = $mysqli->query($query);
$row_cnt = $result->num_rows;
$row = $result->fetch_array(MYSQLI_ASSOC);
echo "<div class = 'row'>";
echo "<div class='col-md-12'>";
if($row_cnt ==0 || empty($row['content'])){
	echo "<div class='alert alert-danger'>";
	echo "沒有找到此頁面";
	echo "</div>";
}elseif($row_cnt ==1 ){
	echo "<div class='col-md-7' >";
	echo "<div class='page-header'><h2>".$row['name']."</h2></div>";
	echo "<p>".$row['content']."</p>";
	echo "</div>";
	echo "<div class='col-md-5' style = 'float:right'>";
	if($row['video_url'] !==""){
	echo "<iframe width='420' height='345' src='".$row['video_url']."'></iframe>";
	}
	echo "</div>";
}
echo "</div>";
echo "</div>";
include("layout_footer.php");