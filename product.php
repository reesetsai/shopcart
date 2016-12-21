<?php
session_start();
include("config.php");
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = "SELECT * FROM `goods` WHERE id = '$id' ";
}
$action = isset($_GET['action']) ?  $_GET['action'] : "";

include("product_head.php");
include("layout_container.php");
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
$row_cnt = $result->num_rows;
if($row_cnt == 1){
		$url = $row["url"];
		echo "<div class='col-md-10'>";
        echo "<div class='col-md-5'>";
		echo '<th>';
		echo '<img src=./pic/'.$row["pic"].' '."class='img-thumbnail' style='width:600px;height:300px;'>";
		echo '</th>';
		echo '</div>';
		echo '<div class="col-md-5">';
		echo '<h3>'.$row["name"].'</h3><br>';
		echo '<p>金額：'.$row["price"].'</p><br>';
		echo "<a href ='add_to_cart.php?id=$id'>";
		echo "<button class='btn btn-primary add-to-cart'>";
		echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
		echo "</button>";
		echo '</a>';
		echo "</div>";
		echo "</div>";
		echo '<div class="col-md-offset-2 col-md-10">';
		echo '<div class ="col-md-2">';
		echo '<h3>內容簡介</h3>';
		echo '</div>';
		echo '<div class ="col-md-12">';
		echo "<p>".$row['content']."</p>";
		echo '</div>';
		echo '</div>';
}else{
	echo"沒有找到您要的商品";
}
	echo "</div>";

$result->free_result();
$mysqli->close();

if($action =='exists'){
	echo "<div class='alert alert-danger'>";
    echo "<strong>".$row["name"]."</strong> 已經選過了!";
    echo "</div>";
}elseif($action =='add'){
	echo "<div class='alert alert-info'>";
    echo "<strong>".$row["name"]."</strong> 成功加入購物車!";
    echo "</div>";
}
include("layout_footer.php");