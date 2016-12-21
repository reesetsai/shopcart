<?php
include("config.php");
//載入head
include("layout_head.php");

$query = "SELECT * FROM `goods` ORDER by datetime DESC";
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
			    echo  		'<a href ='.$rows["url"].'><p>'.$rows["name"].'</p></a>';
		      	echo	'</div>';
		      	echo '</li>';
			}		
}else{
	echo"沒有找到您要的商品";
}
	echo "</ul>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
$result->free_result();
$mysqli->close();

include("layout_footer.php");