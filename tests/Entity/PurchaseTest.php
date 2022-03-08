<?php
namespace App\Tests\Entity;

use App\Entity\Purchase;
use PHPUnit\Framework\TestCase;
class PurchaseTest extends TestCase
{
    public function testCurrency()
    {
        $purchase = new Purchase;
        $currency = "Bitcoin";
        
        $purchase->setCurrency($currency);
        $this->assertEquals("Bitcoin", $purchase->getCurrency());
    }

    public function testQuantity()
    {
        $purchase = new Purchase;
        $quantity = "3";
        
        $purchase->setQuantity($quantity);
        $this->assertEquals("3", $purchase->getQuantity());
    }

    public function testPrice()
    {
        $purchase = new Purchase;
        $price = "300";
        
        $purchase->setPrice($price);
        $this->assertEquals("300", $purchase->getprice());
    }


}