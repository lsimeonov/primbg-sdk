<?php
declare(strict_types=1);

namespace Stellion\Tests\Models\Traits;


use Stellion\Primbg\Models\Address;
use Stellion\Primbg\Models\Item;
use Stellion\Primbg\Models\Item\Type;
use Stellion\Primbg\Models\Order;

class ArrayableTraitTest extends \PHPUnit\Framework\TestCase
{

    public function testAllowNullId(){
        $address = new Address();
        $address->setEmail('test@example.com');

        $row = new Order\Row();
        $order = new Order();
        $order->setRows([$row]);
        $order->setDeliveryAddress($address);

        $result = $order->toArray();

        $this->assertEquals('test@example.com', $result['delivery_address']['email']);
    }

}
