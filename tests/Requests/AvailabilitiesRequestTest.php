<?php
declare(strict_types=1);

namespace Tests\Stellion\Primbg\Requests;

use PHPUnit\Framework\TestCase;
use Stellion\Primbg\Requests\AvailabilitiesRequest;

class AvailabilitiesRequestTest extends TestCase
{
    public function testRequestPayload()
    {
        $request = new AvailabilitiesRequest(
            ['CIMEX - Склад', 'BITTEL - Бител Пловдив'],
            ['SCH 5906205901', 'PLM4120']
        );

        $expectedPayload = [
            ['stores_names' => 'CIMEX - Склад'],
            ['stores_names' => 'BITTEL - Бител Пловдив'],
            ['skus_codes' => 'SCH 5906205901'],
            ['skus_codes' => 'PLM4120']
        ];

        $this->assertEquals($expectedPayload, $request->getPayload());
    }

    public function testEmptyRequest()
    {
        $request = new AvailabilitiesRequest();
        $this->assertEquals([], $request->getPayload());
    }

    public function testFluentInterface()
    {
        $request = new AvailabilitiesRequest();
        $result = $request
            ->addStoreName('Store 1')
            ->addSkuCode('SKU1')
            ->addStoreName('Store 2')
            ->addSkuCode('SKU2');

        $this->assertSame($request, $result);

        $expectedPayload = [
            ['stores_names' => 'Store 1'],
            ['stores_names' => 'Store 2'],
            ['skus_codes' => 'SKU1'],
            ['skus_codes' => 'SKU2']
        ];

        $this->assertEquals($expectedPayload, $request->getPayload());
    }
}
