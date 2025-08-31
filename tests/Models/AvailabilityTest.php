<?php
declare(strict_types=1);

namespace Tests\Stellion\Primbg\Models;

use PHPUnit\Framework\TestCase;
use Stellion\Primbg\Models\Availability;

class AvailabilityTest extends TestCase
{
    public function testAvailabilityModel()
    {
        $data = [
            'store_name' => 'CIMEX - Склад',
            'item_id' => 16415527,
            'quantity' => '5.00000000000000000000',
            'item_name' => 'Акумулаторна батерия CIMEX, 18V, 2Ah',
            'quantity_on_stock' => '10.00000000000000000000',
            'sku' => 'CDB18-2AH',
            'store_id' => 16302310,
            'quantity_blocked' => '2.00000000000000000000'
        ];

        $availability = new Availability($data);

        $this->assertEquals('CIMEX - Склад', $availability->getStoreName());
        $this->assertEquals(16415527, $availability->getItemId());
        $this->assertEquals('5.00000000000000000000', $availability->getQuantity());
        $this->assertEquals('Акумулаторна батерия CIMEX, 18V, 2Ah', $availability->getItemName());
        $this->assertEquals('10.00000000000000000000', $availability->getQuantityOnStock());
        $this->assertEquals('CDB18-2AH', $availability->getSku());
        $this->assertEquals(16302310, $availability->getStoreId());
        $this->assertEquals('2.00000000000000000000', $availability->getQuantityBlocked());
        
        // Available quantity should be on_stock - blocked = 10 - 2 = 8
        $this->assertEquals(8.0, $availability->getAvailableQuantity());
    }

    public function testAvailableQuantityWithZeroValues()
    {
        $availability = new Availability([
            'quantity_on_stock' => '0.00000000000000000000',
            'quantity_blocked' => '0.00000000000000000000'
        ]);

        $this->assertEquals(0.0, $availability->getAvailableQuantity());
    }

    public function testAvailableQuantityWithNegativeResult()
    {
        $availability = new Availability([
            'quantity_on_stock' => '5.00000000000000000000',
            'quantity_blocked' => '10.00000000000000000000'
        ]);

        // Should not go below 0
        $this->assertEquals(0.0, $availability->getAvailableQuantity());
    }
}
