<?php
require_once("config.php");
include("product_head.php");
$query = "SELECT * FROM `news` WHERE type = 'news_title' ";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$row_cnt = $result->num_rows;
if($row_cnt == 1){
	echo "<div class ='title col-md-12'>";
	echo	"<img src='./pic/".$row['name']."'>";
	echo  "</div>";
}
echo "</div>";
echo "<div class ='col-md-8'>";
echo "<h3>最新news</h3>";
echo "</div>";
echo "<div class ='col-md-8'>";
echo "<table class='table table-hover'>";
$sql = "SELECT * FROM `news` WHERE type = 'news' ORDER by datetime DESC ";
$res = $mysqli->query($sql);

while($rows = $res->fetch_array(MYSQLI_ASSOC)){
echo "<tbody>";
echo "<td>".$rows['datetime']."</td>";
echo "<td><a href='news_page.php?news_id=".$rows['id']."'>".$rows['name']."</td></a>";
echo "</tbody>";
}
echo "</table>";
echo "</div>";
echo "<div class ='col-md-4'>";
echo	"<img src='./pic/".$row['name']."' style='width: 100%;'>";
echo "</div>";
echo "</div>";

include("layout_footer.php");
