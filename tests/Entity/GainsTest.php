<?php
namespace App\Tests\Entity;

use App\Entity\Gains;
use PHPUnit\Framework\TestCase;
class GainTest extends TestCase
{
    public function testCurrency()
    {
        $purchase = new Gains;
        $value = "666";
        
        $purchase->setValue($value);
        $this->assertEquals("666", $purchase->getValue());
    }




}