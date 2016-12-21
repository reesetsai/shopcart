<?php
include("config.php");
include("product_head.php");
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
	echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th class='textAlignLeft'>商品名稱</th>";
    echo "<th>圖片</th>";
    echo "<th>金額($)</th>";
    echo "</tr>";
    $query = "SELECT * FROM `goods` WHERE id in (".$ids.") ORDER by  FIELD (id, ".$ids.")";
    $result = $mysqli->query($query);
    $total_price=0;
	    while($rows = $result->fetch_array(MYSQLI_ASSOC)){
	    	echo "<tr>";
	        echo '<td>'.$rows["name"].'</td>';
	        echo "<td><img src= ./pic/".$rows["pic"].'></td>';
	        echo "<td>&#36;".$rows["price"]."</td>";
	        echo "<td>";
	        echo "</td>";
	        echo "</tr>";
	        $total_price+=$rows["price"];
	    }
    echo "<tr>";
    echo "<td><b>Total</b></td>";
    echo "<td>&#36;{$total_price}</td>";
    echo "</tr>";
    echo "</table>";
}
$query = "SELECT * FROM `goods` WHERE id in (".$ids.") ORDER by  FIELD (id, ".$ids.")";
$result = $mysqli->query($query);
echo "<form action ='orderform.php' method='post'>";
while($rows = $result->fetch_array(MYSQLI_ASSOC)){
echo "<input name='c[]' type='hidden'  value='".$rows['name']."'>";
echo "<input name='c[]' type='hidden' value='".$rows["price"]."'>";
}
echo "<input name='totalprice' type='hidden' value='".$total_price."'>";
echo "<input name='buyer' type='hidden' value='".$_SESSION["user"]."'>";
echo "<input name='buyeraddress' type='hidden' value='".$_SESSION["user"]."'>";
echo "<td>";
echo "<button type = 'submit'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span> 確認結帳";
echo "</button>";
echo "</td>";
echo "</form>";

/*echo "<button type = 'submit'>";
echo "<a href ='testpay.php'><span class='glyphicon glyphicon-shopping-cart'></span> 確認結帳</a>";
echo "</button>";
*/
?>