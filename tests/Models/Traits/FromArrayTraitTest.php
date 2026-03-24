<?php
declare(strict_types=1);

namespace Stellion\Tests\Models\Traits;


use Stellion\Primbg\Models\Address;
use Stellion\Primbg\Models\Item\Type;
use Stellion\Primbg\Models\Order;
use Stellion\Primbg\Models\Partner;
use Stellion\Primbg\Models\RelationalTransport;

class FromArrayTraitTest extends \PHPUnit\Framework\TestCase
{

    public function testValueObjectSetter()
    {
        $model = new \Stellion\Primbg\Models\Item([
            'tp' => Type::TYPE_ITEM
        ]);

        $this->assertEquals(Type::TYPE_ITEM, $model->getTp()->getType());
    }

    public function testDDSNumSetter()
    {
        $model = new Partner([
            'dds_num' => 1234
        ]);

        $this->assertEquals('1234', $model->getDdsNum());
    }

    public function testAllowNullId()
    {
        $order = new Order([
            'delivery_address' => new Address([
                'email' => 'test@example.com'
            ])
        ]);

        $this->assertEquals('test@example.com', $order->getDeliveryAddress()->getEmail());
    }

    public function testRelationalTransportAcceptsStringIds()
    {
        $model = new RelationalTransport([
            'trans_id' => '123',
            'rel_trans_id' => '456',
            'num' => 789
        ]);

        $this->assertSame(123, $model->getTransId());
        $this->assertSame(456, $model->getRelTransId());
        $this->assertSame('789', $model->getNum());
    }

}
