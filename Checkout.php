<?php

class Checkout {
    private $json_products, $skus, $total, $freeSKUS;
  

    public function __construct(){	
    }

    public function scan($SKU) {
        $this->skus[] = $SKU;
    }

    public function total($priceRules) {
        $array_count = array_count_values($this->skus);

        foreach ($array_count as $key => $value) {
            $freeGiftSKU = $priceRules[$key]->getfreeGiftSKU();
            if ($freeGiftSKU != null) {
                $this->freeSKUS[] = $freeGiftSKU;
            }
        }
        if ($this->freeSKUS != null) {
            $freeGiftArray = array_count_values($this->freeSKUS);
            //loop all free gift
            foreach ($freeGiftArray as $key => $value) {
                $quantity = $array_count[$key];
                $array_count[$key] = $quantity - $value;
                if ($array_count[$key] <= 0) {
                    unset($array_count[$key]);
                }
            }
        }
        
        foreach ($array_count as $key => $value) {
            $quantity = $value;
            $unitPrice = $priceRules[$key]->getunitPrice();
            $batchSize = $priceRules[$key]->getBatchSize();
            $batchPrice = $priceRules[$key]->getBatchPrice();
            $freeGiftSKU = $priceRules[$key]->getfreeGiftSKU();

            $batchCount = $quantity / $batchSize;
            $remainder = $quantity % $batchSize;

            $bulkSize = $priceRules[$key]->getBulkSize();
            $bulkDiscount = $priceRules[$key]->getBulkDiscount();

            if (isset($bulkSize) && $bulkSize != null && $quantity > $bulkSize) {
                $this->total += $quantity * $bulkDiscount;
            } else if ($quantity < $batchSize) {
                $this->total += $quantity * $unitPrice;
            } else {
                $this->total += $batchCount * $batchPrice + $remainder * $unitPrice;
            }
        }
        return $this->total;
    }
}


?>