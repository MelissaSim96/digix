<?php
class PriceRules {
	private $unitPrice, $sku, $batchSize, $batchPrice, $freeGiftSKU, $bulkSize, $bulkDiscount;
	public function __construct($sku, $unitPrice, $batchSize, $batchPrice, $freeGiftSKU, $bulkSize, $bulkDiscount) {
		$this->sku = $sku;
		$this->unitPrice = $unitPrice;
		$this->batchSize = $batchSize;
		$this->batchPrice = $batchPrice;
		$this->freeGiftSKU = $freeGiftSKU;
		$this->bulkSize = $bulkSize;
		$this->bulkDiscount = $bulkDiscount;
	}

	public function getUnitPrice() {
		return $this->unitPrice;
	}

	public function getBatchSize() {
		return $this->batchSize;
	}

	public function getBatchPrice() {
		return $this->batchPrice;
	}

	public function getBulkSize() {
		return $this->bulkSize;
	}

	public function getBulkDiscount() {
		return $this->bulkDiscount;
	}

	public function getfreeGiftSKU() {
		return $this->freeGiftSKU;
	}
}

?>