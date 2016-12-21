<?php
header("Content-Type:text/html; charset=utf-8");
require_once("config.php");
include_once('./AllPay.Payment.Integration.php');
$array = $_POST["c"];
$length = count($array);
$itemnum = rand();
$date = date("y-m-d h:i:s");
$buyer = $_POST["buyer"];
$buyeraddress = $_POST["buyeraddress"];
$totalprice = $_POST["totalprice"];

//function itname($array){
	for($i =0;$i<$length;$i++){
	$name = $array[$i].",";
	$itemname = $itemname .$name;
	$i = $i+1;
	}
	$itemname = rtrim($itemname, ',');
	$itemname =explode(",", $itemname);

	for($i =1;$i<$length;$i++){
	$price = $array[$i].",";
	$itemprice = $itemprice .$price;
	$i = $i+1;
	}
	$itemprice = rtrim($itemprice, ',');
	$itemprice =explode(",", $itemprice);
	$loo = count($itemprice);
	for($i=0;$i<$loo;$i++){
		$merge = $itemname[$i].' '.$itemprice[$i].'元x1'.'#';
		$item = $item.$merge;
	}
	$item = rtrim($item, '#');


/*if($array != ""){
	$itemname ="";
	$nn = "";
	$query = "INSERT INTO itemnum(itemnum,name,totalprice,datetime)VALUES(?,?,?,?)";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("ssss",$itemnum, $buyer,$totalprice,$date);
	$stmt->execute();
		for($i=0;$i<$length;$i++){
			$name = $array[$i];
			$price = $array[$i+1];
			/*$query = "INSERT INTO itemform(itemnum, name, price, datetime, buyer, buyeraddress) 
			VALUES(?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("ssssss",$itemnum, $name, $price, $date, $buyer,$buyeraddress);
			$stmt->execute();
		}
}*/

try
	{	
	    $oPayment = new AllInOne();
	    /* 服務參數 */
	    $oPayment->ServiceURL ="https://payment-stage.allpay.com.tw/Cashier/AioCheckOut";
	    $oPayment->HashKey = "5294y06JbISpM5x9";
	    $oPayment->HashIV = "v77hoKGq4kWxNNIS";
	    $oPayment->MerchantID ="2000132";
	    /* 基本參數 */
	    $oPayment->Send['ReturnURL'] = "http://192.168.1.87/test/pay.php";
	    $oPayment->Send['ClientBackURL'] = "http://192.168.1.87/test/checkout.php";
	   // $oPayment->Send['OrderResultURL'] = "[您要收到付款完成通知的瀏覽器端網址]";
	    $oPayment->Send['MerchantTradeNo'] = $itemnum;
	    $oPayment->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
	    $oPayment->Send['TotalAmount'] = $totalprice;
	    $oPayment->Send['TradeDesc'] = "金流測試";
	    $oPayment->Send['ChoosePayment'] = PaymentMethod::ALL;
	    //$oPayment->Send['Remark'] = "[您要填寫的其他備註]";
	    $oPayment->Send['ChooseSubPayment'] = PaymentMethodItem::None;
	    $oPayment->Send['NeedExtraPaidInfo'] = ExtraPaymentInfo::No;
	    $oPayment->Send['DeviceSource'] = DeviceType::PC;
	   // $oPayment->Send['ItemName'] = $item;
	    for($i=0;$i<$loo;$i++){
			array_push($oPayment->Send['Items'], array('Name' => $itemname[$i], 'Price' => (int)"$itemprice[$i]",'Currency' => "元", 'Quantity' => (int) "1"));
    	}
    /* 產生訂單 */
	    $oPayment->CheckOut();
	    /* 產生產生訂單 Html Code 的方法 */
	    $szHtml = $oPayment->CheckOutString();
	}
	catch (Exception $e)
	{
	    // 例外錯誤處理。
	    throw $e;
	}


?>