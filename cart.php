<?php
//連接mysql
require_once("config.php");
include("product_head.php");

//接收GET值,用於操作新增或移除
$action = isset($_GET['action']) ? $_GET['action'] : "";
//對購物車進行操作
if($action=='removed'){
    echo "<div class='alert alert-info'>";
        echo "<strong>".$rows["name"]."</strong> 已經從您的購物車中取消";
    echo "</div>";
}else if($action=='quantity_updated'){
    echo "<div class='alert alert-info'>";
        echo "<strong>".$rows["name"]."</strong> 數量已更新!";
    echo "</div>";
}
//SESSION['cart_items']值>0筆,
if(count($_SESSION['cart_items'])>0){
	$ids = "";
	foreach($_SESSION['cart_items'] as $id=>$value){
		$ids =$ids.$id.",";
		//因迴圈外只會有一個ids值,故用 .= 為了易懂$ids =$ids.$id.",";
	}
	//將$ids值
	$ids = rtrim($ids, ',');
	//將最右邊一位的','刪掉
    echo "<form action ='cart.php' method='post'>";
	echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th class='textAlignLeft'>商品名稱</th>";
    echo "<th>金額$</th>";
    echo "<th>取消</th>";
    echo "</tr>";
    $query = "SELECT * FROM `goods` WHERE id in (".$ids.") ORDER by  FIELD (id, ".$ids.")";
    $result = $mysqli->query($query);
    $total_price=0;
	    while($rows = $result->fetch_array(MYSQLI_ASSOC)){
	    	echo "<tr>";
	        echo '<td><a href ='.'product.php?id='.$rows["id"].'>'.$rows["name"].'</td></a>';
	        echo "<td>&#36;".$rows["price"]."</td>";
	        echo "<td>";
	        echo "<a href='remove_from_cart.php?id=".$rows["id"]."' class='btn btn-danger'>";
	        echo "<span class='glyphicon glyphicon-remove'></span>取消購買";
	        echo "</a>";
	        echo "</td>";
	        echo "</tr>";
	        $total_price+=$rows["price"];
	    }
    echo "<tr>";
    echo "<td><b>Total</b></td>";
    echo "<td>&#36;{$total_price}</td>";
    echo "<td>";
    echo "<a href='checkout.php' class='btn btn-success'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'></span> 前往結帳";
    echo "</a>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
}
elseif($action !=='removed'){
    echo "<div class='alert alert-danger'>";
    echo "<strong>您尚未選擇商品!!</strong>";
    echo "</div>";
}
$result->free_result();
$mysqli->close();
include("layout_footer.php");