<?php
require_once("PriceRules.php");
require_once("Checkout.php");
$postData = $_POST['data'];

$co = new Checkout();

$url = 'server/Products.json';
$data = file_get_contents($url); 
$data = json_decode($data, true);

 // print_r($data); 
foreach ($data["products"] as $key => $value) {
	if(!empty($value["sku"])) {
		if (empty($value["freeGiftSKU"])) {
			$value["freeGiftSKU"] = null;
		}
		if (empty($value["bulkSize"])) {
			$value["bulkSize"] = null;
		}
		if (empty($value["bulkDiscount"])) {
			$value["bulkDiscount"] = null;
		}
		$priceRules[$value["sku"]] = new PriceRules($value["sku"], $value["price"], $value["batchSize"], $value["batchPrice"], $value["freeGiftSKU"], $value["bulkSize"], $value["bulkDiscount"]);
	}
	

}
echo "<p>SKUs Scanned: ";
$i = 0;
foreach($postData as $key => $value) {
	if ($value == null) {
		continue;
	}
	$co->scan($value);
	if ($i == 0) {
		echo $value;
	} else {
		echo ", ".$value;
	}
	$i++;	
}
echo "</p>";
echo "<p>Total expected: $".number_format($co->total($priceRules), 2)."</p>";
?>